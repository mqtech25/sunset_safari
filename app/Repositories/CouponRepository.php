<?php
namespace App\Repositories;

use App\Contracts\CouponContract;
use App\Models\Coupon;
use Illuminate\Database\QueryException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\UploadAble;


class CouponRepository extends BaseRepository implements CouponContract{
	use UploadAble;
	/**
	* CouponRepository Constructor
	* @param Coupon $model
	*/
	public function __construct(Coupon $model){
		\Log::info("Req=CouponRepository@__construct called");
		parent::__construct($model);
		$this->model = $model;
	}
	

	/**
	* @param string $order
	* @param string $sort
	* @param array $columns
	* @return mixed
	*/
	public function listCoupons(string $order = 'id', string $sort = 'desc', array $columns = ['*']){
		\Log::info("Req=CouponsRepository@listCoupons called");
		return $this->all($columns, $order, $sort);	
	}

	
	/**
	* @param array $params
	* @return Coupon|mixed
	*/
	public function createCoupon(){
		\Log::info("Req=CouponRepository@createCoupon called");
		try {
				$randomId = rand(10,100);
				$coupon = new Coupon();
				$coupon->type = "cart_base";
				$coupon->code = "UnDefined";
				$coupon->details = "UnDefined";
				$coupon->discount = 0.0;
				$coupon->discount_type = "percent";
				$coupon->start_date = 123;
				$coupon->end_date = 123;
				$coupon->save();
				return $coupon;
			
		} catch (QueryException $e) {
			throw new InvalidArgumentException($e->getMessage());
		}
	}

	/**
	 * @param int $id
	 * @return mixed
	 * @throws ModelNotFoundException
	 */
	public function findCouponById($id){
		\Log::info("Req=couponRepository@findcouponById called");
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
	public function updateCoupon($params){
		\Log::info("Req=CouponRepository@updateCoupon called");

		$coupon = $this->findCouponById($params['id']);
		$colleciton = collect($params)->except('_token');

		$details = array();
		if($colleciton['type']=="cart_base"){
			$details['min_buy']=$colleciton['min_buy'];
			$details['max_discount']=$colleciton['max_discount'];
		}else{
			$details = $colleciton['products'];
		}
		$details = json_encode($details);

		$colleciton['start_date'] = strtotime($colleciton['start_date']);
		$colleciton['end_date'] = strtotime($colleciton['end_date']);


		$merge = $colleciton->merge(compact('details','details'));
		$coupon->update($merge->all());

		return $coupon;

	}
	
	/**
	 * @param int id
	 */
	public function deleteCoupon($id){
		\Log::info("Req=CouponRepository@deleteCoupon called");

		$coupon = $this->findCouponById($id);
		$coupon->delete();
		return $coupon;
	}

	
}
