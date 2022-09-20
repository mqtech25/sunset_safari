<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAddress;
use \App\Models\Order;
use \App\Models\Country;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showProfile()
    {
        \Log::info("Req=UserController@showProfile called");
        $countries = Country::all();
        return view('site.pages.customer.profile',compact('countries'));
    }

    public function updateProfile(Request $request)
    {
        \Log::info("Req=UserController@updateProfile called");
        $request->validate([
            'mail'=> ['required', 'string', 'email', 'max:255'],
            'first_name'=> ['required', 'string', 'max:255'],
            'last_name'=> ['required', 'string', 'max:255'],
            'phone'=> ['required', 'max:20'],
            'address'=> ['required', 'max:255'],
            'addressline2'=> ['max:255'],
            'zip_code'=> ['required', 'max:20'],
            'country'=> ['required', 'max:20'],
            'state'=> ['required'],
            'city'=> ['required']
        ]);

        $user = User::findOrFail(\Auth::user()->id);
        if($user)
        {
            $user->email = $request->mail;
            $user->save();
            $address = UserAddress::where([['user_id',\Auth::user()->id],['is_primary',1]])->first();
            $address->first_name = $request->first_name;
            $address->last_name = $request->last_name;
            $address->phone = $request->phone;
            $address->address = $request->address;
            $address->addressline2 = $request->addressline2;
            $address->zip_code = $request->zip_code;
            $address->country = $request->country;
            $address->state = $request->state;
            $address->city = $request->city;
            $address->save();
            return redirect()->back()->with('message', 'Profile updated');
        }
        return redirect()->back()->with('error', 'something went wrong.');
    }

    public function updatePassword(Request $request)
    {
        \Log::info("Req=UserController@updatePassword called");
        $user = User::findOrFail(\Auth::user()->id);
        if(Hash::check($request->current_password, $user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('message', 'Password updated');
        }
        return redirect()->back()->with('error', 'Current password mismatch!');
    }

    public function customerOrders()
    {
        $orders = Order::where('user_id',\Auth::user()->id)->get();
        return view('site.pages.customer.orders',compact('orders'));
    }

    public function customerAddresses()
    {
        $countries = Country::all();
        return view('site.pages.customer.addresses',compact('countries'));
    }

    public function removeAddress($id)
    {
        $address = UserAddress::findOrFail($id);
        if($address->delete()){
            return redirect()->back()->with('message', 'Address deleted');
        }
        return redirect()->back()->with('error', 'something went wrong!');
    }

    public function getUserAddress(Request $request)
    {
        $address = UserAddress::findOrFail($request->id);
        return json_encode($address);
    }
}
