<?php
namespace App\Contracts;

interface BannerContract{

	/**
	* @param string order
	* @param string $sort
	* @param array $column
	* @return mixed
	*/
	public function listBanners(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

	/**
	* @param array $params
	*/
	public function createBanner();

	/**
	 * @param int $id
	 */
	public function deleteBanner(int $id);

	/**
	 * @param array $params
	 */
	public function updateBanner(array $params);

	/**
	* @param $id
	* @return mixed
	*/
	public function findBannerById($id);
	
}