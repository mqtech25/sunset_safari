<?php
namespace App\Repositories;

use App\Contracts\MenuContract;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use Illuminate\Database\QueryException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\UploadAble;


class MenuRepository extends BaseRepository implements MenuContract{
	use UploadAble;
	/**
	* MenuRepository Constructor
	* @param Service $model
	*/

	public function __construct(Menu $model){
		\Log::info("Req=MenuRepository@__construct called");
		parent::__construct($model);
		$this->model = $model;
	}
	

	/**
	* @param string $order
	* @param string $sort
	* @param array $columns
	* @return mixed
	*/
	public function listMenu(string $order = 'id', string $sort = 'desc', array $columns = ['*']){
		\Log::info("Req=MenuRepository@listServices called");
		return $this->all($columns, $order, $sort);	
	}

	
	/**
	* @param array $params
	* @return Services|mixed
	*/
	public  function createMenu($params){
		//dd($params);
		\Log::info("Req=MenuRepository@createService called");
		try {
			$dataArray = [
				'menu_title' => $params['menu_title'],
				'location' => $params['location'],
				'tab_status' => $params['tab_status']
			];
			$colleciton = collect($params)->except('_token');
			
			// $separator ='-';
			// $service_status = $colleciton['service_status'];
			// $icon = $imagePath;
			
			// $merge = $colleciton->merge(compact('service_status','icon'));
			
			$menu = Menu::create($dataArray);
			return $menu;
			
		} catch (QueryException $e) {
			throw new InvalidArgumentException($e->getMessage());
		}
	}

	/**
	 * @param int $id
	 * @return mixed
	 * @throws ModelNotFoundException
	 */
	public  function  findMenuById($id){
		
		\Log::info("Req=MenuRepository@createService called");
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
	public function updateMenu($params){
		$menuUpdate = $this->findMenuById($params['id']);
		$colleciton = collect($params)->except('_token');
		$menuUpdate->update($colleciton->all());
		if(isset($params['menu_items'])){
			$menuUpdate->items()->syncWithoutDetaching($params['menu_items']);
		}
		return $menuUpdate;

	}
	
	/**
	 * @param int id
	 */
	public function deleteMenu($id){
		\Log::info("Req=MenuRepository@createService called");
		$menu = $this->findMenuById($id);
		$menu_items = collect(DB::table('menu_items')->where('menuid',$id)->get())->keyBy('itemid')->toArray();
		$json_items = array_keys($menu_items);
		if(isset($menu_items)){
			$menu->items()->toggle($json_items);
		}
		$matchThis = [ 'parent' => $id ];
		//$deleteService = Service::where($matchThis)->delete();
		$menu->delete();

		return $menu;
	}

	
}