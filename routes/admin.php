<?php

Route::group(['prefix'  =>  'admin'], function () {

	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
	Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

	Route::group(['middleware' => ['auth:admin']], function () {

		Route::get('/', function () {
			return view('admin.dashboard.index');
		})->name('admin.dashboard');

		Route::get('/profile', 'Admin\AdminController@showProfile')->name('admin.profile');
		Route::post('/updateprofile', 'Admin\AdminController@updateProfile')->name('admin.updateprofile');

		Route::get('/settings', 'Admin\SettingController@index')->name('admin.settings');
		Route::post('/settings', 'Admin\SettingController@update')->name('admin.settings.update');

		Route::group(['prefix'  =>   'categories'], function() {

			Route::get('/', 'Admin\CategoryController@index')->name('admin.categories.index');
			Route::get('/create', 'Admin\CategoryController@create')->name('admin.categories.create');
			Route::post('/store', 'Admin\CategoryController@store')->name('admin.categories.store');
			Route::get('/{id}/edit', 'Admin\CategoryController@edit')->name('admin.categories.edit');
			Route::post('/update', 'Admin\CategoryController@update')->name('admin.categories.update');
			Route::get('/{id}/delete', 'Admin\CategoryController@delete')->name('admin.categories.delete');

		});

		Route::group(['prefix' => 'orders'], function () {

			Route::get('/', 'Admin\OrderController@index')->name('admin.orders.index');
			Route::get('/{id}/delete', 'Admin\OrderController@destroy')->name('admin.order.delete');
			Route::get('/{id}/show', 'Admin\OrderController@show')->name('admin.order.show');
			Route::post('/updatestatus', 'Admin\OrderController@updateStatus')->name('admin.order.updatestatus');

		});

		Route::group(['prefix' => 'subscriptions'], function () {

			Route::get('/', 'Admin\SubscriptionController@index')->name('admin.subscriptions.index');
			Route::get('/{id}/delete', 'Admin\SubscriptionController@destroy')->name('admin.subscriptions.delete');

		});

		Route::group(['prefix' => 'shipping'], function () {
			Route::get('/', 'Admin\ShippingController@index')->name('admin.shipping.index');
			Route::post('/create', 'Admin\ShippingController@addCountry')->name('admin.shipping.addcountry');
			Route::post('/rule/create', 'Admin\ShippingController@addRule')->name('admin.shipping.addrule');
			Route::post('/update', 'Admin\ShippingController@upadeCountryStatus')->name('admin.shipping.countrystatus');
			Route::get('/{id}/delete', 'Admin\ShippingController@deleteShippingCountry')->name('admin.shippingcountry.delete');
			Route::get('/{id}/rules', 'Admin\ShippingController@shippinRules')->name('admin.shippingrules.index');
			Route::get('/{id}/rules/delete', 'Admin\ShippingController@deleteShippingRule')->name('admin.shippingrule.delete');
			Route::post('/rules/update', 'Admin\ShippingController@upadeRuleStatus')->name('admin.shipping.rulestatus');
			Route::post('/ruleupdate', 'Admin\ShippingController@getRuleData')->name('admin.shipping.getruleedit');
			Route::post('/updateruledata', 'Admin\ShippingController@updateRuleData')->name('admin.shipping.updateruledata');
		});


		Route::group(['prefix'  =>   'attributes'], function() {

			Route::get('/', 'Admin\AttributeController@index')->name('admin.attributes.index');
			Route::get('/create', 'Admin\AttributeController@create')->name('admin.attributes.create');
			Route::post('/store', 'Admin\AttributeController@store')->name('admin.attributes.store');
			Route::get('/{id}/edit', 'Admin\AttributeController@edit')->name('admin.attributes.edit');
			Route::post('/update', 'Admin\AttributeController@update')->name('admin.attributes.update');
			Route::get('/{id}/delete', 'Admin\AttributeController@delete')->name('admin.attributes.delete');

			Route::post('/get-values', 'Admin\AttributeValueController@getValues');
			Route::post('/add-values', 'Admin\AttributeValueController@addValues');
			Route::post('/update-values', 'Admin\AttributeValueController@updateValues');
			Route::post('/delete-values', 'Admin\AttributeValueController@deleteValues');
		});


		Route::group(['prefix' => 'brands'], function(){
			Route::get('/', 'Admin\BrandController@index')->name('admin.brands.index');
			Route::get('/create', 'Admin\BrandController@create')->name('admin.brands.create');
			Route::post('/store', 'Admin\BrandController@store')->name('admin.brands.store');
			Route::get('/{id}/edit', 'Admin\BrandController@edit')->name('admin.brands.edit');
			Route::post('/update', 'Admin\BrandController@update')->name('admin.brands.update');
			Route::get('/{id}/delete', 'Admin\BrandController@delete')->name('admin.brands.delete');
		});


		Route::group(['prefix' => 'banners'], function(){
			Route::get('/', 'Admin\BannerController@index')->name('admin.banners.index');
			Route::get('/create', 'Admin\BannerController@create')->name('admin.banners.create');
			Route::post('/store', 'Admin\BannerController@store')->name('admin.banners.store');
			Route::post('/update', 'Admin\BannerController@update')->name('admin.banners.update');
			Route::post('images/upload', 'Admin\BannerController@uploadImage')->name('admin.banners.images.upload');
			Route::get('/{id}/edit', 'Admin\BannerController@edit')->name('admin.banners.edit');
			Route::get('/{id}/delete', 'Admin\BannerController@destroy')->name('admin.banners.delete');
		});

		Route::group(['prefix' => 'coupons'], function(){
			Route::get('/', 'Admin\CouponController@index')->name('admin.coupons.index');
			Route::get('/create', 'Admin\CouponController@create')->name('admin.coupons.create');
			Route::get('/{id}/edit', 'Admin\CouponController@edit')->name('admin.coupons.edit');
			Route::post('/store', 'Admin\CouponController@store')->name('admin.coupons.store');
			Route::post('/update', 'Admin\CouponController@update')->name('admin.coupons.update');
			Route::get('/{id}/delete', 'Admin\CouponController@destroy')->name('admin.coupons.delete');
			Route::post('/search', 'Admin\CouponController@getSubCategories')->name('admin.coupons.search');
		});


		Route::group(['prefix' => 'pages'], function(){
			Route::get('/', 'Admin\PageController@index')->name('admin.pages.index');
			Route::get('/create', 'Admin\PageController@create')->name('admin.pages.create');
			Route::post('/store', 'Admin\PageController@store')->name('admin.pages.store');
			Route::post('/update', 'Admin\PageController@update')->name('admin.pages.update');
			Route::get('/{id}/edit', 'Admin\PageController@edit')->name('admin.pages.edit');
			Route::get('/{id}/delete', 'Admin\PageController@destroy')->name('admin.pages.delete');
		});

		Route::group(['prefix' => 'posts'], function(){
			Route::get('/', 'Admin\PostsController@index')->name('admin.posts.index');
			Route::get('/create', 'Admin\PostsController@create')->name('admin.posts.create');
			Route::post('/update', 'Admin\PostsController@update')->name('admin.posts.update');
			Route::get('/{id}/edit', 'Admin\PostsController@edit')->name('admin.posts.edit');
			Route::post('images/upload', 'Admin\PostsController@uploadImage')->name('admin.posts.images.upload');
			Route::get('images/{id}/deletebulk', 'Admin\PostsController@deleteBulkImages')->name('admin.posts.images.deletebulk');
			Route::get('/{id}/delete', 'Admin\PostsController@destroy')->name('admin.posts.delete');
		});

		Route::group(['prefix' => 'contactmails'], function(){
			Route::get('/', 'Email\EmailsController@index')->name('admin.contactmails.index');
			Route::post('/update', 'Email\EmailsController@updateStatus')->name('admin.contactmails.update');
			Route::get('/{id}/delete', 'Email\EmailsController@delete')->name('admin.contactmails.delete');
		});


		Route::group(['prefix' => 'products'], function(){
			Route::get('/', 'Admin\ProductController@index')->name('admin.products.index');
			Route::get('/create', 'Admin\ProductController@create')->name('admin.products.create');
			Route::post('/store', 'Admin\ProductController@store')->name('admin.products.store');
			Route::get('/{id}/edit', 'Admin\ProductController@edit')->name('admin.products.edit');
			Route::post('/update', 'Admin\ProductController@update')->name('admin.products.update');
			Route::get('/{id}/delete', 'Admin\ProductController@delete')->name('admin.products.delete');

			Route::post('images/featured', 'Admin\ProductController@setFeaturedImage')->name('admin.products.featured.image');

			Route::post('images/upload', 'Admin\ProductController@uploadImage')->name('admin.products.images.upload');
			Route::get('images/{id}/delete', 'Admin\ProductController@deleteImage')->name('admin.products.images.delete');
			Route::get('images/{id}/deletebulk', 'Admin\ProductController@deleteBulkImages')->name('admin.products.images.deletebulk');

			// Load attributes on the page load
			Route::get('attributes/load', 'Admin\ProductAttributeController@loadAttributes');
			// Load product attributes on the page load
			Route::post('attributes', 'Admin\ProductAttributeController@productAttributes');
			// Load option values for a attribute
			Route::post('attributes/values', 'Admin\ProductAttributeController@loadValues');
			// Add product attribute to the current product
			Route::post('attributes/add', 'Admin\ProductAttributeController@addAttribute');
			// Delete product attribute from the current product
			Route::post('attributes/delete', 'Admin\ProductAttributeController@deleteAttribute');
			
		});
	});
});