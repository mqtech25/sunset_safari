<?php
namespace App\Contracts;

interface PageContract{

	/**
	* @param string order
	* @param string $sort
	* @param array $column
	* @return mixed
	*/
	public function listPages(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

	/**
	* @param array $params
	*/
	public function createPage();

	/**
	 * @param int $id
	 */
	public function deletePage(int $id);

	/**
	 * @param array $params
	 */
	public function updatePage(array $params);

	/**
	* @param $id
	* @return mixed
	*/
	public function findPageById($id);
	
}