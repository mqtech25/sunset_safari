<?php
namespace App\Repositories;

use App\Contracts\BannerContract;
use App\Models\Banner;
use Illuminate\Database\QueryException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\UploadAble;


class BannerRepository extends BaseRepository implements BannerContract{
	use UploadAble;
	/**
	* BannerRepository Constructor
	* @param Banner $model
	*/
	public function __construct(Banner $model){
		\Log::info("Req=BannerRepository@__construct called");
		parent::__construct($model);
		$this->model = $model;
	}
	

	/**
	* @param string $order
	* @param string $sort
	* @param array $columns
	* @return mixed
	*/
	public function listBanners(string $order = 'id', string $sort = 'desc', array $columns = ['*']){
		\Log::info("Req=BannnerRepository@listBanners called");
		return $this->all($columns, $order, $sort);	
	}

	
	/**
	* @param array $params
	* @return banners|mixed
	*/
	public function createBanner(){
		\Log::info("Req=BannerRepository@createBanner called");

		try {
				$banner = new Banner();
				$banner->banner_title = "Draft";
				$banner->banner_subtitle="";
				$banner->banner_status=0;
				$banner->banner_order=99999;
				$banner->banner_image=null;
				$banner->save();
				return $banner;
			
		} catch (QueryException $e) {
			throw new InvalidArgumentException($e->getMessage());
		}
	}

	/**
	 * @param int $id
	 * @return mixed
	 * @throws ModelNotFoundException
	 */
	public function findBannerById($id){
		\Log::info("Req=BannerRepository@findBannerById called");
		try{
			return $this->findOneOrFail($id);
		}catch(ModelNotFoundException $e){
			throw new ModelNotFoundException($e);
		}
	}


	/**
	 * @param array $params
	 * @return mixed
	 */
	public function updateBanner($params){
		\Log::info("Req=BannerRepository@updateBanner called");

		$banner = $this->findBannerById($params['id']);
		$colleciton = collect($params)->except('_token');

		$banner_status = $colleciton->has('banner_status') ? 1 : 0;

		$merge = $colleciton->merge(compact('banner_status'));
		$banner->update($merge->all());

		return $banner;
	}
	
	/**
	 * @param int id
	 */
	public function deleteBanner($id){
		\Log::info("Req=BannerRepository@deleteBanner called");

		$banner = $this->findBannerById($id);
		if ($banner->banner_image != null) {
			$this->deleteOne($banner->banner_image);
		}

		$banner->delete();
		return $banner;
	}

	
}
