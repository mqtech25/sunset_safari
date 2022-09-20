<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\UserAddress;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function saveAddress(Request $request){

		if($request->update_id == 0)
		{
			$address = new UserAddress([
				'user_id' => $request['add_shipping_user_id'],
				'first_name' => $request['add_shipping_first_name'],
				'last_name' => $request['add_shipping_last_name'],
				'phone' => $request['add_shipping_phone_number'],
				'address' => $request['add_shipping_address'],
				'addressline2' => $request['add_shipping_addressline2'],
				'city' => $request['add_shipping_city'],
				'state' => $request['add_shipping_state'],
				'zip_code' => $request['add_shipping_post_code'],
				'country' => $request['add_shipping_country'],
				'is_primary' => 0,
			]);

			if($address->save())
			{
				return redirect()->back()->with('message', 'Address created successfully');
			}
		}else{
			$address = UserAddress::findOrFail($request->update_id);
			$address->first_name = $request['add_shipping_first_name'];
			$address->last_name = $request['add_shipping_last_name'];
			$address->phone = $request['add_shipping_phone_number'];
			$address->address = $request['add_shipping_address'];
			$address->addressline2 = $request['add_shipping_addressline2'];
			$address->city = $request['add_shipping_city'];
			$address->state = $request['add_shipping_state'];
			$address->zip_code = $request['add_shipping_post_code'];
			$address->country = $request['add_shipping_country'];
			if($address->save())
			{
				return redirect()->back()->with('message', 'Address Updated successfully');
			}
		}
		return redirect()->back()->with('Error', 'Something went wrong.');
    }
}
