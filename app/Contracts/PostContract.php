<?php
namespace App\Contracts;

interface PostContract{

	/**
	* @param string order
	* @param string $sort
	* @param array $column
	* @return mixed
	*/
	public function listPosts(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

	/**
	* @param array $params
	*/
	public function createPost();

	/**
	 * @param int $id
	 */
	public function deletePost(int $id);

	/**
	 * @param array $params
	 */
	public function updatePost(array $params);

	/**
	* @param $id
	* @return mixed
	*/
	public function findPostById($id);
	
}