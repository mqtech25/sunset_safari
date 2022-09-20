<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Banner;
use App\Repositories\BannerRespository;
use App\Contracts\BannerContract;
use Illuminate\Http\Request;
use App\Traits\UploadAble;


class BannerController extends BaseController
{
    use UploadAble;
    protected $bannerRepository;


    public function __construct(BannerContract $bannerRepository){
		\Log::info("Req=BannerController@__construct called");
		$this->bannerRepository = $bannerRepository;
	}



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Log::info("Req=BannerController@index called");
        $banners = $this->bannerRepository->listBanners();
        $this->setPageTitle('Banner', 'List All Banners');
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \Log::info("Req=BannerController@create called");
        $this->setPageTitle('Banner', 'Create Banner');

        $banner = $this->bannerRepository->createbanner();

        if (!$banner) {
            return $this->responseRedirectBack('Error occured while creating banner', 'error', true, true);
        }
		return view('admin.banners.form',compact('banner'));
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
	public function uploadImage(Request $request){ 
        \Log::info("Req=BannerController@uploadImage called");
        $banner = $this->bannerRepository->findBannerById($request->banner_id);
        
        //deleting previous image
        if($banner->banner_image!=null){
            $this->deleteOne($banner->banner_image);
        }

		if($request->has('image')){
			
            $image = $this->uploadOne($request->image, 'banners');
            // dd($image);
            $banner->banner_image = $image;
            $banner->save();
        }
		return response()->json(['status' => 'success']);
		
	}


    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        \Log::info("Req=BannerController@edit called");
		$this->setPageTitle('Banner', 'Edit Banner');

		$banner = $this->bannerRepository->findBannerById($id);
		
		return view('admin.banners.form', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $params = $request->except('_token');
		$updateBanner = $this->bannerRepository->updateBanner($params);

		if(!$updateBanner){
			return $this->responseRedirectBack('Error occurred while updating banner', 'error', true, true);
		}

		return $this->responseRedirect('admin.banners.index', 'Banner has been updated successfully', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Log::info("Req=BannerController@destroy called");
		$deleteBanner = $this->bannerRepository->deleteBanner($id);

		if(!$deleteBanner){
			return $this->responseRedirectBack('Error occured while deleting Banner', 'error', true, true);
		}

		return $this->responseRedirect('admin.banners.index', 'Banner has been deleted successfully', 'success');
    }
}
