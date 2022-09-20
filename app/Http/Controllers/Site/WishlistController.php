<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\User;



class WishlistController extends Controller{

	public function index(){
		$wishlist = \Auth::user()->wishlist();
		return view('site.pages.wishlist',compact('wishlist'));
	}

	public function addToWishList($id){
		if(\Auth::user()->wishlist()->count()>= config('settings.wishlist-items-limit'))
		{
			return redirect()->back()->with('error', 'You already have maximum product allowed in your wishlist.');
		}
		$listItem = new Wishlist();
		$listItem->user_id = \Auth::user()->id;
		$listItem->product_id = $id;
		$listItem->save();
		return redirect()->back()->with('message', 'Product added to your wish list.');
	}
	
	public function removeFromWishlist($id){
		$listItem = Wishlist::findOrFail($id);
		if($listItem->delete())
		{
			return redirect()->back()->with('message', 'Product deleted from your wish list.');

		}
		return redirect()->back()->with('error', 'something went wrong.');

	}

	public function clearWishlist(){
		$deleteAll = Wishlist::where('user_id', \Auth::user()->id)->delete();
		if($deleteAll){
			return redirect()->back()->with('message', 'All products has been deleted from your wishlist.');
		}
		return redirect()->back()->with('error', 'something went wrong.');
	}

}