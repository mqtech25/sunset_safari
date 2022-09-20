<?php
namespace App\Repositories;

use App\Contracts\PageContract;
use App\Models\Page;
use Illuminate\Database\QueryException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\UploadAble;


class PageRepository extends BaseRepository implements PageContract{
	use UploadAble;
	/**
	* PageRepository Constructor
	* @param Page $model
	*/
	public function __construct(Page $model){
		\Log::info("Req=PageRepository@__construct called");
		parent::__construct($model);
		$this->model = $model;
	}
	

	/**
	* @param string $order
	* @param string $sort
	* @param array $columns
	* @return mixed
	*/
	public function listPages(string $order = 'id', string $sort = 'desc', array $columns = ['*']){
		\Log::info("Req=PagesRepository@listPages called");
		return $this->all($columns, $order, $sort);	
	}

	
	/**
	* @param array $params
	* @return Pages|mixed
	*/
	public function createPage(){
		\Log::info("Req=PageRepository@createPage called");
		try {
				$randomId = rand(10,100);
				$page = new Page();
				$page->page_title = "Untitled Page";
				$page->page_slug="untitled-page".$randomId;
				$page->save();
				return $page;
			
		} catch (QueryException $e) {
			throw new InvalidArgumentException($e->getMessage());
		}
	}

	/**
	 * @param int $id
	 * @return mixed
	 * @throws ModelNotFoundException
	 */
	public function findPageById($id){
		\Log::info("Req=PageRepository@findPageById called");
		try{
			return $this->findOneOrFail($id);
		}catch(ModelNotFoundException $e){
			throw new ModelNotFoundException($e);
		}
	}


	/**
	 * @param int $slug
	 * @return mixed
	 * @throws ModelNotFoundException
	 */
	public function findPageBySlug($slug){
		\Log::info("Req=PageRepository@findPageBySlug called");
		try{
			return $this->findOneBy(['page_slug'=>$slug]);
		}catch(ModelNotFoundException $e){
			throw new ModelNotFoundException($e);
		}
	}


	/**
	 * @param array $params
	 * @return mixed
	 */
	public function updatePage($params){
		\Log::info("Req=PageRepository@updatePage called");

		$page = $this->findPageById($params['id']);
		$colleciton = collect($params)->except('_token');
		$separator ='-';

		$page_status = $colleciton['page_status'];
		$page_slug = str_slug($colleciton['page_slug'], $separator);


		$merge = $colleciton->merge(compact('page_status','page_slug'));
		$page->update($merge->all());

		return $page;

	}
	
	/**
	 * @param int id
	 */
	public function deletePage($id){
		\Log::info("Req=PageRepository@deletePage called");

		$page = $this->findPageById($id);
		$page->delete();
		return $page;
	}

	
}
