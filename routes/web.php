<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require 'admin.php';
	Route::get('/', 'Site\SiteController@homePage')->name('site.home');
Route::get('/view_detail', 'Site\SiteController@offerDetail')->name('site.detail');

// Route::get('/', 'Site\SiteController@homePage')->name('home');
Route::get('/blog', 'Site\SiteController@blogPage')->name('blog');
Route::get('/blog/{slug}', 'Site\SiteController@postPage')->name('blog.post');
Route::get('/contact', 'Site\SiteController@contactPage')->name('contact');
Route::post('/contactemail', 'Email\EmailsController@contactEmail')->name('contact.email');
Route::get('/search', 'Site\SiteController@search')->name('search');
Auth::routes(['verify' => true]);
Route::post('fetchstates', 'Auth\RegisterController@fetechCountryStates')->name('fetchstates');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::group(['prefix' => 'user','middleware' => ['auth','verified']], function () {

    Route::get('/profile', 'Site\UserController@showProfile')->name('site.customer.profile');
    Route::post('/profile/update', 'Site\UserController@updateProfile')->name('update.customer.profile');
    Route::post('/profile/passupdate', 'Site\UserController@updatePassword')->name('update.customer.password');
    Route::get('/orders', 'Site\UserController@customerOrders')->name('customer.orders');
    Route::get('/addresses', 'Site\UserController@customerAddresses')->name('customer.addresses');
	Route::get('/addresses/remove/{id}', 'Site\UserController@removeAddress')->name('customer.addresses.remove');
	Route::post('/addresses/getaddress', 'Site\UserController@getUserAddress')->name('get.user.address');

});


Route::get('/sorting', 'Site\CategoryController@sorting')->name('category.sorting');
Route::get('/filter', 'Site\CategoryController@filterProducts')->name('category.filter');

Route::get('/category/{slug}', 'Site\CategoryController@show')->name('category.show');
Route::get('/brand/{slug}', 'Site\CategoryController@showBrand')->name('brand.show');
Route::get('/product/{slug}', 'Site\ProductController@show')->name('product.show');
Route::post('/product/add/cart', 'Site\ProductController@addToCart')->name('product.add.cart');
Route::get('/product/addto/cart/{id}', 'Site\ProductController@directAddToCart')->name('direct.add.cart');
Route::get('/cart', 'Site\CartController@getCart')->name('checkout.cart');
Route::get('/page/{slug}', 'Admin\PageController@show')->name('pages.show');

Route::get('/cart/item/{slug}/remove', 'Site\CartController@removeItem')->name('checkout.cart.remove');
Route::post('/cart/update', 'Site\CartController@updateCart')->name('checkout.cart.update');
Route::get('/cart/clear', 'Site\CartController@clearCart')->name('checkout.cart.clear');
Route::post('/cart/addcoupon', 'Site\CartController@addCouponDiscount')->name('checkout.cart.addcoupon');

Route::group(['middleware' => ['auth','verified']], function(){
	Route::post('/product', 'Site\ProductController@storeProductRatting')->name('product.addratting');
	Route::get('/checkout', 'Site\CheckoutController@getCheckout')->name('checkout.index');
	Route::post('/checkout/states', 'Site\CheckoutController@getCountryStates')->name('getstates');
	Route::get('/checkout-completed', 'Site\CheckoutController@checkoutCompleted')->name('checkout.completed');
	Route::post('/checkout/order', 'Site\CheckoutController@placeOrder')->name('checkout.place.order');

	// WISH LIST
	Route::get('/wishlist', 'Site\WishlistController@index')->name('wishlist.index');
	Route::get('/wishlist/addtowishlist/{id}', 'Site\WishlistController@addToWishList')->name('wishlist.add');
	Route::get('/wishlist/remove/{id}', 'Site\WishlistController@removeFromWishlist')->name('wishlist.remove');
	Route::get('/wishlist/clear', 'Site\WishlistController@clearWishlist')->name('wishlist.clear');


	//Address
	Route::post('/address', 'Site\AddressController@saveAddress')->name('save.address');

	//Shipping
});
Route::post('/shipping', 'Site\ShippingController@calculateShipping')->name('shipping.cart.calculate');


Route::post('/subscription/subscribe', 'Site\SubscriptionsController@create')->name('subscription.subscribe');
Route::get('/subscription/unsubscribe/{key}', 'Site\SubscriptionsController@delete')->name('subscription.unsubscribe');


Route::get('paypal/express-checkout', 'PaypalController@expressCheckout')->name('paypal.express-checkout');
Route::get('paypal/express-checkout-success', 'PaypalController@expressCheckoutSuccess');
Route::post('paypal/notify', 'PaypalController@notify');


Route::get('/forgot-password', 'Auth\ResetPasswordController@forgotPasswordShow')->middleware(['guest'])->name('password.request');
Route::post('/forgot-password', 'Auth\ResetPasswordController@sendResetPasswordLink')->middleware(['guest'])->name('password.email');
Route::get('/reset-password/{token}', 'Auth\ResetPasswordController@showResetForm')->middleware(['guest'])->name('password.reset');
Route::post('/reset-password', 'Auth\ResetPasswordController@resetPassword')->middleware(['guest'])->name('password.update');