<?php
namespace App\Repositories;

use App\Contracts\OrderContract;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use Cart;

class OrderRepository extends BaseRepository implements OrderContract{


	public function __construct(Order $model){
		\Log::info("Req=Repositories/OrderRepository@findBySlug Called");
		parent::__construct($model);
		$this->model = $model;
	}


		/**
	* @param string $order
	* @param string $sort
	* @param array $columns
	* @return mixed
	*/
	public function listOrders(string $order = 'id', string $sort = 'desc', array $columns = ['*']){
		\Log::info("Req=OrderRepository@listOrders called");
		return $this->all($columns, $order, $sort);	
	}


	/**
	 * @param int $id
	 * @return mixed
	 * @throws ModelNotFoundException
	 */
	public function findOrderById($id){
		\Log::info("Req=OrderRepository@findOrderById called");

		try{
			return $this->findOneOrFail($id);
		}catch(ModelNotFoundException $e){
			throw new ModelNotFoundException($e);
		}
	}


	/**
	 * @param int id
	 */
	public function deleteOrder($id){
		\Log::info("Req=OrderRepository@deleteOrder called");

		$order = $this->findOrderById($id);
		$order->delete();
		return $order;
	}

	public function storeOrderDetails($params){
		\Log::info("Req=Repositories/OrderRepository@storeOrderDetails Called");

		$shippingAddress = [];
		$discount =0;
		$shipping = 0;
		if(session()->get("cart_total_discount")!=null){
			$discount = session()->get("cart_total_discount");
		}

		if(session()->get("shipping_amount")!=null){
			$shipping = session()->get("shipping_amount");
		}

		if(array_key_exists('ship_different_chk', $params))
		{
			$shippingAddress = array('first_name'=> $params['shipping_first_name'],
			'last_name'=> $params['shipping_last_name'],
			'address'=> $params['shipping_address'],
			'addressline2'=> $params['shipping_addressline2'],
			'post_code'=> $params['shipping_post_code'],
			'phone_number'=> $params['shipping_phone_number'],
			'country'=> $params['shipping_country'],
			'city'=> $params['shipping_city'],
			'state'=> $params['shipping_state']);
		}else{
			$shippingAddress = array('first_name'=> $params['first_name'],
			'last_name'=> $params['last_name'],
			'address'=> $params['address'],
			'addressline2'=> $params['addressline2'],
			'post_code'=> $params['post_code'],
			'phone_number'=> $params['phone_number'],
			'country'=> $params['country'],
			'state'=> $params['state'],
			'city'=> $params['city']);
		}

		$shippingAddress = json_encode($shippingAddress);

		$order = Order::create([
			'order_number' 		=>	'ORD-'.strtoupper(uniqid()),
			'user_id'			=>	Auth()->user()->id,
			'status'			=>	'pending',
			'sub_total'			=> 	Cart::getSubTotal(),
			'discount'			=> 	$discount,
			'shipping'			=> 	$shipping,
			'grand_total'		=> 	(Cart::getSubTotal()-$discount)+$shipping,
			'item_count'		=>	Cart::getTotalQuantity(),
			'payment_status'	=>	0,
			'payment_method'	=> 	$params['payment_method'],
			'first_name'		=>	$params['first_name'],
			'last_name'			=>	$params['last_name'],
			'email'				=>	$params['email'],
			'address'			=> 	$params['address'],
			'addressline2'			=> 	$params['addressline2'],
			'city'				=> 	$params['city'],
			'state'				=> 	$params['state'],
			'country'			=> 	$params['country'],
			'post_code'			=> 	$params['post_code'],
			'phone_number'		=>	$params['phone_number'],
			'shipping_address'		=>	$shippingAddress,
			'notes'				=>	$params['notes']
		]);

		if($order){
			$order->order_number = 'ORD-'.date('Ymd').$order->id;
			$order->save();
			$items = Cart::getContent();

			foreach($items as $item){
				$product = Product::where('name', $item->name)->first();

				$orderItem = new orderItem([
					'product_id'	=> 	$product->id,
					'quantity'		=>	$item->quantity,
					'price'			=> 	$item->getPriceSum(),
					'product_details'	=>	json_encode($item->attributes)
				]);

				$product->quantity = $product->quantity-$item->quantity;
				$product->save();

				$order->items()->save($orderItem);
			}

			$orderStatus = new OrderStatus([
				'order_id' => $order->id,
				'status' => 'pending',
				'comments' => 'Payment Pending'
			]);

			$order->orderStatus()->save($orderStatus);
		}

		return $order;
	}
}