<?php
namespace App\Repositories;

use App\Contracts\ItemContract;
use App\Models\Item;
use Illuminate\Database\QueryException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\UploadAble;


class ItemRepository extends BaseRepository implements ItemContract{
	use UploadAble;
	/**
	* ItemRepository Constructor
	* @param Service $model
	*/

	public function __construct(Item $model){
		\Log::info("Req=ItemRepository@__construct called");
		parent::__construct($model);
		$this->model = $model;
	}
	

	/**
	* @param string $order
	* @param string $sort
	* @param array $columns
	* @return mixed
	*/
	public function listItem(string $order = 'id', string $sort = 'desc', array $columns = ['*']){
		\Log::info("Req=ItemRepository@listServices called");
		return $this->all($columns, $order, $sort);	
	}

	
	/**
	* @param array $params
	* @return Services|mixed
	*/
	public  function createItem($params){
		//dd($params);
		\Log::info("Req=ItemRepository@createService called");
		try {
			$dataArray = [
				'name' => $params['name'],
				'slug' => $params['slug'],
				'slug_id' => $params['slug_id'],
				'parent' => $params['parent']
			];
			$colleciton = collect($params)->except('_token');
			
			// $separator ='-';
			// $service_status = $colleciton['service_status'];
			// $icon = $imagePath;
			
			// $merge = $colleciton->merge(compact('service_status','icon'));
			
			$item = Item::create($dataArray);
			return $item;
			
		} catch (QueryException $e) {
			throw new InvalidArgumentException($e->getMessage());
		}
	}

	/**
	 * @param int $id
	 * @return mixed
	 * @throws ModelNotFoundException
	 */
	public  function  findItemById($id){
		
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
	public function updateItem($params){
		\Log::info("Req=MenuRepository@createService called");
		$menuUpdate = $this->findItemById($params['id']);
		$colleciton = collect($params)->except('_token');
		$menuUpdate->update($colleciton->all());
		return $menuUpdate;

	}
	
	/**
	 * @param int id
	 */
	public function deleteItem($id){
		\Log::info("Req=MenuRepository@createService called");
		
		$menu = $this->findItemById($id);
		$matchThis = [ 'parent' => $id ];
		//$deleteService = Service::where($matchThis)->delete();
		$menu->delete();

		return $menu;
	}

	
}
