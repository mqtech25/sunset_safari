<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Country;
use Cart;


class CartController extends Controller{

	public function getCart(){
		\Log::info("Req=CartController@getCart called");
		$countries = Country::all();
		return view('site.pages.cart',compact('countries'));
	}


	public function updateCart(Request $request){
		foreach($request->qty as $productId => $quantity){
			Cart::update($productId, [
				'quantity' => array(
					'relative' => false,
					'value' => $quantity,
				),
			]);
		}
		return redirect()->back()->with('message', 'Cart updated successfully.');
	}

	public function removeItem($slug){
		// dd($slug);
		\Log::info("Req=CartController@removeItem called");
		Cart::remove($slug);
		if(Cart::isEmpty()){
			return redirect('/');
		}
		return redirect()->back()->with('message', 'Item removed from cart successfully.');
	}

	public function clearCart(){
		\Log::info("Req=CartController@clearCart called");
		Cart::clear();
		return redirect('/');
	}


	public function addCouponDiscount(Request $request){
		$response = array('status'=>'success','message'=>'Coupon Applied.', 'discount'=>'val', 'total'=>0);
		$coupon_code =$request->coupon_code;
		$coupon = Coupon::where('code',$coupon_code)->first();
		$discount;
		if($coupon){
			$today = time();
			if($today >= $coupon->start_date && $today <= $coupon->end_date){
				$details = json_decode($coupon['details'], true);
				$couponType = $coupon["type"];

				if ($couponType == "cart_base") {
					if (\Cart::getSubTotal() >= $details["min_buy"]) {
						if ($coupon["discount_type"] == "amount") {
							$discount = $coupon["discount"];
						} else {
							$discount = \Cart::getSubTotal() * ($coupon["discount"] / 100);
							if ($discount > $details["max_discount"]) {
								$discount = $details["max_discount"];
							}
						}
					} else {
						$discount = 0;
						$response["message"] = "Cart total is less then required.";
					}
					$response["discount"] = $discount;

				} else {
					$discount = 0;
					// $products = DB::table('products')->whereIn('id',$details)->get();
					foreach (\Cart::getContent() as $item) {
						if (in_array($item->id, $details)) {
							$discount += ($item->price * ($coupon["discount"] / 100)) * $item->quantity;
						}
					}
					$response["discount"] = $discount;
				}
			}else{
				$response["discount"] = 0;
				$response["message"] = "Coupon Expired.";
			}
		}else{
			$response["discount"] = 0;
			$response["message"] = "Coupon not available.";
		}
		$response["discount"] = round($response["discount"],2);
		$response["total"] = \Cart::getSubTotal()-$response["discount"];
		if(session()->get("shipping_amount") != null){
			$response["total"] = $response["total"]+session()->get("shipping_amount");
		}
		$request->session()->put("cart_total_after_discount",$response["total"]);
		$request->session()->put("cart_total_discount",$response["discount"]);
		$request->session()->put("discount_code",$request->coupon_code);
		$response = json_encode($response);
		
		return $response;
	}

}