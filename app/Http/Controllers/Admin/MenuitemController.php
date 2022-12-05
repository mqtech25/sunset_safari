<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Contracts\MenuItemContract;
use Illuminate\Http\UploadedFile;
use App\Traits\UploadAble;
use Illuminate\Support\Facades\Route;

/**
* Class MenuitemController
* @package App\Http\Controller\Admin
*/

class MenuitemController extends BaseController
{
	use UploadAble;
	/**
	* @var MenuItemContract
	*/
	protected $menuItemRepository;

	/**
	* MenuitemController construct
	* @param MenuItemContract $menuItemRepository
	*/
	public function __construct(MenuItemContract $menuItemRepository)
	{
		\Log::info("Req=MenuitemController@__construct called");
		$this->menuItemRepository = $menuItemRepository;
	}
	/**
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	*/
	// index menu page
    public function index(){
		\Log::info("Req=MenuitemController@index called");
		$menuItems = $this->menuItemRepository->listMenuItems();

		$this->setPageTitle('Menu Items', 'List of all Menu Items');
		return view('admin.menuitems.index',compact('menuItems'));
	}
	/**
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	*/
	// create menu page
	public function create(){
		\Log::info("Req=MenuitemController@create called");
		$menu = $this->menuItemRepository->listMenuItems('id', 'asc');
		// $categories = $this->categoryRepository->treeList();
		$this->setPageTitle('Menu Item', 'Create Menu Item');
        // $routes = collect(\Route::getRoutes())->map(function ($route) { return $route->name(); });
        $routeCollection = Route::getRoutes();
	// 	$siteroute=[];
	// 	    foreach ($routeCollection as $value) {
    //      if(str_starts_with($value->uri(),"sunsetsafari")){
	// 		$siteroute[]=$value->uri();
	// 	 }
    //  }
	// 	dd($siteroute);
		return view('admin.menuitems.create',compact('menu','routeCollection'));
	}
	/**
	* @param Request $request
	* @return \IIluminate\Http\RedirectResponse
	* @throws \Illuminate\Validation\ValidationException
	*/
	// update btn call to store menu data
	public function store(Request $request)
	{
		\Log::info("Req=MenuitemController@store called");
		$this->validate(
			$request,[
				'title' => 'required|max:191',
				'slug' => 'required|not_in:0'
			]);
		$params =$request->except('_token');
		$menuItem= $this->menuItemRepository->createMenuItem($params);
		
		if (!$menuItem) {
			return $this->responseRedirectBack('Error occurred while creating menu item or Menu item already exists','error',true,true);
		}
		return $this->responseRedirect('admin.menuitems.index','Menu add successfully','success',false,false);
	}
	/**
	* @param int $id
	* @return \Illuminate\Contracts\View\Factory|\Illumniate\View\View
	*/
	// edit menu data
	public function edit($id)
	{
		\Log::info("Req=MenuitemController@edit called");
		$targetMenu=$this->menuItemRepository->findMenuById($id);
		// $menu = $this->menuItemRepository->listMenu();
		$locations=json_decode($targetMenu->location);
		$this->setPageTitle('Menu','Edit Menu :'.$targetMenu->title);
		return view('admin.createmenu.edit',compact('targetMenu','locations'));
	}
	/**
	* @param Request $request
	* @return \Illuminate\Http\RedirectResponse
	* @throws \Illuminate\Validate\ValidateException
	*/
	// update menu data
	public function update(Request $request)
	{
		\Log::info("Req=MenuitemController@update called");
		$this->validate(
			$request,[
				'title' =>'required|max:191',
				'status'=>'required|not_in:0',
				'location' => ['required', 'array'],
			]
			);
		$params=$request->except("_token");
		$updateMenu=$this->menuItemRepository->updateMenu($params);
		if(!$updateMenu){
			return $this->responseRedirectBack('Error occured while update menu', 'error', true, true);
		}

		return $this->responseRedirect('admin.createmenu.index', 'Menu updated successfully', 'success');
	}
	/**
	* @param int $id
	* @return \Illuminate\Contracts\View\Factory|\Illumniate\View\View
	*/
	// delete Menu data
	public function delete($id){
		\Log::info("Req=MenuitemController@delete called");
		$deleteMenu = $this->menuItemRepository->deleteMenu($id);
		if(!$deleteMenu){
			return $this->responseRedirectBack('Error occurred while deleting menu Or deleting parent menu is not allowed', 'error', true, true);
		}

		return $this->responseRedirect('admin.createmenu.index', 'Menu deleted successfully', 'success');
	}
}