<?php
namespace App\Contracts;

/**
* Interface MenuContract
* @package App\Contracts
*/
interface MenuContract{
	
	/**
	* @param array $columns
	* @param string $order
	* @param string $sort
	* @return mixed
	*/
	public function listMenu(string $order = 'id', string $sort = 'desc',array $columns = ['*']);
	/**
	* @param int $id
	* @return mixed
	*/
	public function findMenuById(int $id);

	/**
	* @param array $params
	*/
	public function createMenu(array $params);

	/**
	* @param array $params
	*/
	public function updateMenu(array $params);
	
	/**
	* @param int $id
	*/
	public function deleteCategory($id);

	/**
	* @return mixed
	*/
	public function treeList();

	/**
	* @param $slug
	* @return mixed
	*/
	public function findBySlug($slug);


}