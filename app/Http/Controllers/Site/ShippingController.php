<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingCountry;
use App\Models\ShippingRule;
use Illuminate\Support\Facades\DB;

class ShippingController extends Controller
{
    public function calculateShipping(Request $request){
        session()->put("shipping_amount",0);
        $cartWeight = $request->cart_weight;
        $shippingCountry = ShippingCountry::where([['name','=',$request->name],['shipping_status','=',1]])->first();
        if(!\Auth::check())
        {
            return json_encode(['request_status'=>'fail','message'=> 'Please login to calculate shipping.']);
        }
        if($cartWeight<=0)
        {
            return json_encode(['request_status'=>'fail','message'=> 'Your cart is empty.']);
        }
        if($shippingCountry != null){
            $shippingCost = ShippingRule::select('shipping_amount')
            ->where([['shipping_country_id','=', $shippingCountry->id],['status','=',1],
            ['min_weight','<=', $cartWeight],['max_weight', '>=', $cartWeight]])->first();
            if($shippingCost != null){
                $shippingCost = $shippingCost->shipping_amount;
                session()->put("shipping_amount",$shippingCost);
                $cart_total = \Cart::getSubTotal()+$shippingCost;
                if(session()->get("cart_total_discount") != null){
                    $cart_total = $cart_total-session()->get("cart_total_discount");
                }
                return json_encode(['request_status'=>'success','cost'=> $shippingCost,'cart_total'=>$cart_total]);
            }
            return json_encode(['request_status'=>'fail','message'=> 'Sorry! No shipping method available.']);
        }
        return json_encode(['request_status'=>'fail','message'=> 'Sorry! No shipping method available for '.$request->name]);
    }
}
