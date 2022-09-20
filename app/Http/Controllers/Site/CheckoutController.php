<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Contracts\OrderContract;
use App\Models\Order;
use App\Models\Country;
use App\Models\OrderStatus;
use App\Models\Product;
use Redirect;
use App\Http\Controllers\Site\ShippingController;
use Illuminate\Http\Request;

// Square payment
use Square\Models\CreateOrderRequest;
use Square\Models\CreateCheckoutRequest;
// use Square\Models\Order;
use Square\Models\OrderLineItem;
use Square\Models\Money;
use Square\Exceptions\ApiException;
use Square\SquareClient;
use Cart;

//paypal
use Srmklive\PayPal\Services\ExpressCheckout;

use App\Http\Controllers\Email\OrderEmailsController;




class CheckoutController extends Controller{

    protected $orderRepository;
    protected $emailSender;

	public function __construct(OrderContract $orderRepository, OrderEmailsController $emailSender){
		\Log::info("Req=CheckoutController@__construct called");
		$this->orderRepository = $orderRepository;
		$this->emailSender = $emailSender;
	}

	public function getCheckout(){
        \Log::info("Req=CheckoutController@getCheckout called");
        $countries = Country::all();

        $shippingRequest = new \Illuminate\Http\Request();
        $shippingRequest->setMethod('POST');
        $shippingRequest->request->add([
            'cart_weight' => session()->get('cart_weight'),
            'name'=> \Auth::user()->primaryAddress->country,
        ]);
        $shipping = new ShippingController();
        $shipping = $shipping->calculateShipping($shippingRequest);
        $shippingData =json_decode($shipping);
		return view('site.pages.checkout', compact('countries', 'shippingData'));
	}

	public function placeOrder(Request $request){
        \Log::info("Req=CheckoutController@placeOrder called");
        if(session()->get("shipping_amount") != null && session()->get("shipping_amount") > 0){
            $items = Cart::getContent()->toArray();
            $itemIds = array_keys($items);
            array_walk($itemIds, function (&$item, $key) {
                return $item = explode("-", $item)[1];
            });

            // \DB::unprepared('LOCK TABLES products WRITE');
                $cartProducts = Product::select('id','name', 'quantity')->whereIn('id', $itemIds)->get()->groupBy('id')->toArray();
                $message = '<strong>!LOW STOCK ALERT</strong><br>';
                $itemsNotAvailable = false;
                foreach($items as $key=>$item){
                    $itemId = explode('-',$key)[1];
                    if($cartProducts[$itemId][0]['quantity'] < $item['quantity']){
                        $itemsNotAvailable = true;
                        $message .= $item['name'].' available stock quantity is: '.$cartProducts[$itemId][0]['quantity'].'.<br>';
                    }
                }
                if ($itemsNotAvailable) {
                    return redirect()->route('checkout.cart')->with('Error', $message);
                }
                $order = $this->orderRepository->storeOrderDetails($request->all());
            // \DB::unprepared('UNLOCK TABLES');
            if($order && $order->payment_method == 'Paypal Payment'){
                $this->paypalPayment($order);
            }else if($order && $order->payment_method == 'Square Payment'){
                $this->squarePayment($order);
            }
        }
        else{
            return redirect()->back()->with('Error', 'No Shipping method found, Please change country name or contact support.');
        }
	}


	private function squarePayment(Order $order)
    {
		\Log::info("Req=CheckoutController@squarePayment called");
        $location_id = config('settings.square-location-id');
        $client = new SquareClient([
            'accessToken' => config('settings.square-access-token'),
            'environment' => config('settings.square-mode')
        ]);

        // make sure we actually are on a POST with an amount
        // This example assumes the order information is retrieved and hard coded
        // You can find different ways to retrieve order information and fill in the following lineItems object.
        try {
			
            $checkout_api = $client->getCheckoutApi();
			$cart_items = \Cart::getContent();
			// dd($cart_items);
            $products = array();
            foreach($cart_items as $key => $productRoot)
            {
                $money = new Money();
                $money->setCurrency('USD');
                $money->setAmount($productRoot->price*100);

                $item = new OrderLineItem($productRoot->quantity);
                $item->setName($productRoot->name);
                $item->setBasePriceMoney($money);

                $products[] = $item;
            }
            // Monetary amounts are specified in the smallest unit of the applicable currency.
            // This amount is in cents. It's also hard-coded for $1.00, which isn't very useful.
            // dd($products);
            if(session()->get("shipping_amount")!=null && session()->get("shipping_amount")>0){
                $money = new Money();
                $money->setCurrency('USD');
                $money->setAmount($order->shipping*100);

                $item = new OrderLineItem(1);
                $item->setName('Shipping Cost');
                $item->setBasePriceMoney($money);
                $products[] = $item;
            }

            // Create a new order and add the line items as necessary.
            $squareOrder = new  \Square\Models\Order($location_id);
            $squareOrder->setLineItems($products);
            
            //setting discount
            $coupon_discounts =[];
            $coupon_discounts[0] = new \Square\Models\OrderLineItemDiscount;
            
            if(session()->get("cart_total_discount")!=null){
                $coupon_discounts[0]->setName('Coupon Discount');
                $coupon_discounts[0]->setAmountMoney(new \Square\Models\Money);
                $coupon_discounts[0]->getAmountMoney()->setAmount(session()->get("cart_total_discount")*100);
                $coupon_discounts[0]->getAmountMoney()->setCurrency(\Square\Models\Currency::USD);

                $squareOrder->setDiscounts($coupon_discounts);
            }

            $create_order_request = new CreateOrderRequest();
            $create_order_request->setOrder($squareOrder);
            // Similar to payments you must have a unique idempotency key.
			$checkout_request = new CreateCheckoutRequest(uniqid(), $create_order_request);
			$order_id = $order->id;
			$checkout_request->setredirectUrl(route('checkout.completed',compact('order_id')));
			
            $response = $checkout_api->createCheckout($location_id, $checkout_request);

        } catch (ApiException $e) {
            // If an error occurs, output the message
            echo 'Caught exception!<br/>';
            echo '<strong>Response body:</strong><br/>';
            echo '<pre>'; var_dump($e->getResponseBody()); echo '</pre>';
            echo '<br/><strong>Context:</strong><br/>';
            echo '<pre>'; var_dump($e->getContext()); echo '</pre>';
            exit();
        }

        // If there was an error with the request we will
        // print them to the browser screen here
        if ($response->isError()) {
            echo 'Api response has Errors';
            $errors = $response->getErrors();
            echo '<ul>';
            foreach ($errors as $error) {
                echo '<li>❌ ' . $error->getDetail() . '</li>';
            }
            echo '</ul>';
            exit();
        }
        $redirect_url = $response->getResult()->getCheckout()->getCheckoutPageUrl();
        header('Location: '.$redirect_url);
        exit;
    }
    

    private function paypalPayment(Order $order){
        $paypal = new \App\Http\Controllers\PayPalController;
        $redirect_url = $paypal->expressCheckout($order);
        header('Location: ' . $redirect_url);
        exit;
    }

    public function getCountryStates(Request $request){
		$country = Country::findOrFail($request->id);
		return json_encode($country->states);
	}
	

	public function checkoutCompleted(){
		\Log::info("Req=CheckoutController@checkoutCompleted called");
        $o_id;
        
		if(isset($_GET['order_id']))
		{
			$o_id=$_GET['order_id'];
			$order = Order::findOrFail($o_id);
		}
        $order = Order::findOrFail($o_id);
        $order->payment_status =1;
        $order->status ='processing';

        $orderStatus = new OrderStatus([
            'order_id' => $order->id,
            'status' => 'processing',
            'comments' => 'Payment Successfull'
        ]);

        $order->orderStatus()->save($orderStatus);

        $order->save();

        $this->emailSender->customerOrderReceipt($order);
        $this->emailSender->adminOrderReceipt($order);

        session()->forget("cart_total_after_discount");
		session()->forget("cart_total_discount");
        session()->forget("discount_code");
        session()->forget("shipping_amount");
        Cart::clear();

        return view('site.pages.thankyoupage',compact('o_id','order'));
	}
}