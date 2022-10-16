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

    public function index(){
		\Log::info("Req=CreatemenuController@index called");
		$menu = $this->menuRepository->listMenu();
		$this->setPageTitle('Menu', 'List of all Menu Information');
		return view('admin.createmenu.index',compact('menu'));
	}

	public function create(){
		\Log::info("Req=CreatemenuController@create called");
		// $categories = $this->categoryRepository->listCategories('id', 'asc');
		// $categories = $this->categoryRepository->treeList();
		// $this->setPageTitle('Categories', 'Create Category');
		return view('admin.createmenu.create');
	}

}