<?php
namespace App\Contracts;

interface CouponContract{

	/**
	* @param string order
	* @param string $sort
	* @param array $column
	* @return mixed
	*/
	public function listCoupons(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

	/**
	* @param array $params
	*/
	public function createCoupon();

	/**
	 * @param int $id
	 */
	public function deleteCoupon(int $id);

	/**
	 * @param array $params
	 */
	public function updateCoupon(array $params);

	/**
	* @param $id
	* @return mixed
	*/
	public function findCouponById($id);
	
}