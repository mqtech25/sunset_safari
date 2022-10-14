<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuitemController extends Controller
{
    //
    public function index(){
    \Log::info("Req=MenuitemController@index called");
    // $categories = $this->categoryRepository->listCategories();
    // $this->setPageTitle('CreateMenu', 'List of all menu');
    return view('admin.menuitems.index');
	}
    
    public function create(){
    \Log::info("Req=MenuitemController@create called");
    // $categories = $this->categoryRepository->listCategories('id', 'asc');
    // $categories = $this->categoryRepository->treeList();
    // $this->setPageTitle('Categories', 'Create Category');
    return view('admin.menuitems.create');
	}
}