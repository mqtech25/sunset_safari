<?php
namespace App\Contracts;

interface MenuContract{

	/**
	* @param string order
	* @param string $sort
	* @param array $column
	* @return mixed
	*/
	public function listMenu(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

	/**
	* @param array $params
	*/
	public function createMenu(array $params);

	/**
	 * @param int $id
	 */
	public function deleteMenu(int $id);

	/**
	 * @param array $params
	 */
	public function updateMenu(array $params);

	/**
	* @param $id
	* @return mixed
	*/
	public function findMenuById($id);
	
}