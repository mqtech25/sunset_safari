<?php
namespace App\Contracts;

interface ItemContract{

	/**
	* @param string order
	* @param string $sort
	* @param array $column
	* @return mixed
	*/
	public function listItem(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

	/**
	* @param array $params
	*/
	public function createItem(array $params);

	/**
	 * @param int $id
	 */
	public function deleteItem(int $id);

	/**
	 * @param array $params
	 */
	public function updateItem(array $params);

	/**
	* @param $id
	* @return mixed
	*/
	public function findItemById($id);
	
}