<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Coupon;
use App\Models\Product;

use App\Repositories\CouponRespository;
use App\Contracts\CouponContract;
use Illuminate\Http\Request;
use App\Traits\UploadAble;

class CouponController extends BaseController
{
    use UploadAble;
    protected $couponRepository;

    public function __construct(CouponContract $couponRepository)
    {
        \Log::info("Req=CouponController@__construct called");
        $this->couponRepository = $couponRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Log::info("Req=CouponController@create called");
        $coupons = $this->couponRepository->listCoupons();
        $this->setPageTitle('Coupons', 'List All Coupons');
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \Log::info("Req=CouponController@create called");
        $this->setPageTitle('Create Coupon', 'Create Coupon');

        $coupon = $this->couponRepository->createCoupon();
        if (!$coupon) {
            return $this->responseRedirectBack('Error occured while creating coupon', 'error', true, true);
        }

        $products = Product::select('id','name')->get();
        return view('admin.coupons.create', compact('products','coupon'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd($request);
    }

    /**
     * product image upload
     * @param Request $request
     */
    public function uploadImage(Request $request)
    {
        \Log::info("Req=PageController@uploadImage called");
        echo "upload";

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $Page
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        \Log::info("Req=PageController@show called");
        $page = $this->couponRepository->findPageBySlug($slug);
        return view('site.pages.cmspage',compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $Page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        \Log::info("Req=CouponController@edit called");
        $this->setPageTitle('Coupon', 'Edit Coupon');

        $coupon = $this->couponRepository->findCouponById($id);
        $products = Product::select('id', 'name')->get();
		return view('admin.coupons.create', compact('coupon','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $Page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        \Log::info("Req=CouponController@update called");
        $this->setPageTitle('Coupon', 'Update Coupon');
        $params = $request->except('_token');
		$updateCoupon = $this->couponRepository->updateCoupon($params);

		if(!$updateCoupon){
			return $this->responseRedirectBack('Error occurred while updating coupon', 'error', true, true);
		}

		return $this->responseRedirect('admin.coupons.index', 'Coupon has been updated successfully', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $Page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Log::info("Req=CouponController@destroy called");
        $deleteCoupon = $this->couponRepository->deleteCoupon($id);
		if(!$deleteCoupon){
			return $this->responseRedirectBack('Error occured while deleting Coupon', 'error', true, true);
		}
		return $this->responseRedirect('admin.coupons.index', 'Coupon has been deleted successfully', 'success');
    }



    public function getSubCategories(Request $request){
        $subCategories = \App\Models\Category::where('parent_id',$request->category_id)->get();
        return $subCategories;
    }
}
