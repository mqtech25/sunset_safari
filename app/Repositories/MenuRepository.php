<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Contracts\MenuContract;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Http\UploadedFile;
use App\Traits\UploadAble;

class MenuRepository extends BaseRepository implements MenuContract{

	use UploadAble;

	/**
	* MenuRepository constructor
	* @param Menu $model
	*/
	public function __construct(Menu $model){
		\Log::info("Req=Repositories/MenuRepository@__construct called");
		Parent::__construct($model);
		$this->model = $model;
	}

	/**
	* @param string $order
	* @param string $sort
	* @param array $columns
	* @return mixed
	*/
	public function listMenu(string $order = 'id', string $sort ='desc', array $columns = ['*']){
		\Log::info("Req=Repositories/MenuRepository@listMenu Called");
		return $this->all($columns, $order, $sort);
	}

	/**
	* @param int $id
	* @return mixed
	* @throws ModelNotFoundException
	*/
	public function findMenuById(int $id){
		\Log::info("Req=Repositories/MenuRepository@findMenuById Called");
		try{
			return $this->findOneOrFail($id);
		}catch (ModelNotFoundException $e){
			throw new ModelNotFoundException($e);
		}
	}

	/**
	* @param array $params
	* @return Menu|mixed
	*/
	public function createMenu(array $params){
		\Log::info("Req=Repositories/MenuRepository@createMenu Called");
		
		try{
			$collection = collect($params);
			$location = $collection['location'];
			$location = json_encode($location);
			$merge = $collection->merge(compact('location'));
			$menu = new Menu($merge->all());
			$alreadyExists = Menu::where('title', $menu->title)->first();
			// $menu = new Menu($collection->all());
			// $title=$title->title;
			// $alreadyExists = Menu::where('title', $title)->first();
			if($alreadyExists != null){
				return false;
			}

			$menu->save();
			return $menu;
		}catch(QueryException $exception){
			throw new InvalidArgumentException($exception->getMessage());
			
		}
	}

	/**
	* @param array $params
	* @return mixed
	*/
	public function updateMenu(array $params){
		\Log::info("Req=Repositories/MenuRepository@updateMenu Called");
		$menu = $this->findMenuById($params['id']);

		$collection = collect($params)->except('_token');
		$location = $collection['location'];
		$location = json_encode($location);
		$merge = $collection->merge(compact('location'));
		$menu->update($merge->all());
		return $menu;
	}

	/**
	* @param int $id
	* @return bool|mixed
	*/
	public function deleteMenu($id){
		\Log::info("Req=MenuRepository@deleteMenu Called");
		$menu = $this->findMenuById($id);
		// if($menu->children->count()>0)
		// {
		// 	return false;
		// }
		// $updateMenu = DB::table('product_categories')->where('category_id', $menu->id)->update(['category_id'=>1]);
		$menu->delete();


		return $menu;
	}


	/**
	* @return mixed
	*/
	public function treeList(){
		\Log::info("Req=Repositories/CategoryRepository@treeList Called");
		return Category::orderByRaw('-name ASC')
		->get()
		->nest()
		->listsFlattened('name'); // other plugins
	}

	/**
	* @param $slug
	* @return mixed
	*/
	public function findBySlug($slug){
		\Log::info("Req=Repositories/CategoryRepository@findBySlug Called");
		return Category::where('slug', $slug)->firstOrFail();
	}
}