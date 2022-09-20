<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Cart;
use Srmklive\PayPal\Services\ExpressCheckout;



class PayPalController extends Controller{

    protected $provider;


    public function __construct() {
        $this->provider = new ExpressCheckout();
    }


    public function expressCheckout(Order $order) {
        // check if payment is recurring
        $recurring = false;
            
        // Get the cart data
        $cart = $this->getCart($order);
        $response = $this->provider->setExpressCheckout($cart, $recurring);
        if (!$response['paypal_link']) {
            echo 'Something went wrong with PayPal';
        }
        return $response['paypal_link'];
    }


    private function getCart(Order $order)
    {
        $items = []; $i = 0; $lastIndex=0;
        foreach(\Cart::getContent() as $oItem){
            $items['items'][$i]["name"] = $oItem->name;
            $items['items'][$i]["price"] = $oItem->price;
            $items['items'][$i]["qty"] = $oItem->quantity;
            $i++;
            $lastIndex=$i;
        }

        if(session()->get('cart_total_discount')){
            $items['items'][$lastIndex]["name"] = "Discount Code: ".session()->get('discount_code');
            $items['items'][$lastIndex]["price"] = -session()->get('cart_total_discount');
            $items['items'][$lastIndex]["qty"] = 1;
        }

        if(session()->get('shipping_amount') && session()->get('shipping_amount')>0){
            $items['items'][$lastIndex+1]["name"] = "Shipping Cost";
            $items['items'][$lastIndex+1]["price"] = session()->get('shipping_amount');
            $items['items'][$lastIndex+1]["qty"] = 1;
        }

        $items['return_url'] = route('checkout.completed',['order_id'=> $order->id]);
        $items['invoice_id'] = config('paypal.invoice_prefix') . '_' . $order->order_number;
        $items['invoice_description'] = "Order # " . $order->order_number . " ";
        $items['cancel_url'] = url('/');
        $items['total'] = $order->grand_total;
        return $items;
    }

}

?>