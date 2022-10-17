<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Contracts\MenuContract;
use Illuminate\Http\UploadedFile;
use App\Traits\UploadAble;

/**
* Class MenuController
* @package App\Http\Controller\Admin
*/

class CreatemenuController extends BaseController
{
	use UploadAble;
	/**
	* @var MenuContract
	*/
	protected $menuRepository;

	/**
	* CreatemenuController construct
	* @param MenuContract $menuRepository
	*/
	public function __construct(MenuContract $menuRepository)
	{
		\Log::info("Req=CreatemenuController@__construct called");
		$this->menuRepository = $menuRepository;
	}
	/**
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	*/
	// index menu page
    public function index(){
		\Log::info("Req=CreatemenuController@index called");
		$menu = $this->menuRepository->listMenu();
		$this->setPageTitle('Menu', 'List of all Menu Information');
		return view('admin.createmenu.index',compact('menu'));
	}
	/**
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	*/
	// create menu page
	public function create(){
		\Log::info("Req=CreatemenuController@create called");
		$menu = $this->menuRepository->listMenu('id', 'asc');
		// $categories = $this->categoryRepository->treeList();
		$this->setPageTitle('Menu', 'Create Menu');
		return view('admin.createmenu.create',compact('menu'));
	}
	/**
	* @param Request $request
	* @return \IIluminate\Http\RedirectResponse
	* @throws \Illuminate\Validation\ValidationException
	*/
	// update btn call to store menu data
	public function store(Request $request)
	{
		\Log::info("Req=CreatemenuController@store called");
		$this->validate(
			$request,[
				'title' => 'required|max:191',
				'status'=> 'required|not_in:0',
				'location'=>'required|not_in:0',

			]);
		$params =$request->except('_token');
		$menu= $this->menuRepository->createMenu($params);
		if (!$menu) {
			return $this->responseRedirectBack('Error occurred while creating menu or Menu already exists','error',true,true);
		}
		return $this->responseRedirect('admin.createmenu.index','Menu add successfully','success',false,false);
	}
	/**
	* @param int $id
	* @return \Illuminate\Contracts\View\Factory|\Illumniate\View\View
	*/
	// edit menu data
	public function edit($id)
	{
		\Log::info("Req=CreatemenuController@edit called");
		$targetMenu=$this->menuRepository->findMenuById($id);
		// $menu = $this->menuRepository->listMenu();
		$this->setPageTitle('Menu','Edit Menu :'.$targetMenu->title);
		return view('admin.createmenu.edit',compact('targetMenu'));
	}
	/**
	* @param Request $request
	* @return \Illuminate\Http\RedirectResponse
	* @throws \Illuminate\Validate\ValidateException
	*/
	// update menu data
	public function update(Request $request)
	{
		\Log::info("Req=CreatemenuController@update called");
		$this->validate(
			$request,[
				'title' =>'required|max:191',
				'status'=>'required|not_in:0',
				'location'=>'required|not_in:0',
			]
			);
		$params=$request->except("_token");
		$updateMenu=$this->menuRepository->updateMenu($params);
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
		\Log::info("Req=CreatemenuController@delete called");
		$deleteMenu = $this->menuRepository->deleteMenu($id);
		if(!$deleteMenu){
			return $this->responseRedirectBack('Error occurred while deleting menu Or deleting parent menu is not allowed', 'error', true, true);
		}

		return $this->responseRedirect('admin.createmenu.index', 'Menu deleted successfully', 'success');
	}
}