<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreatemenuController extends Controller
{
    //
    	public function index(){
		\Log::info("Req=CreatemenuController@index called");
		// $categories = $this->categoryRepository->listCategories();
		// $this->setPageTitle('CreateMenu', 'List of all menu');
		return view('admin.createmenu.index');
	}
	// 
	    public function create(){
		\Log::info("Req=CreatemenuController@create called");
		// $categories = $this->categoryRepository->listCategories('id', 'asc');
		// $categories = $this->categoryRepository->treeList();
		// $this->setPageTitle('Categories', 'Create Category');
		return view('admin.createmenu.create');
		}

}