<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Menu;
use App\Models\Item;
use App\Models\Page;
use App\Repositories\MenuRepository;
use App\Contracts\MenuContract;
use Illuminate\Http\Request;
use App\Traits\UploadAble;
use Intervention\Image\Facades\Image;
use App\Models\SubService;

class MenuController extends BaseController
{
    use UploadAble;
    protected $menuRepository;

    public function __construct(MenuContract $menuRepository)
    {
        \Log::info("Req=MenuController@__construct called");
        $this->menuRepository = $menuRepository;
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Log::info("Req=MenuController@__construct called");
        $aboutMenu = $this->menuRepository->listMenu()->keyBy('id');
        $this->setPageTitle('Menu', 'List of All Menu');
        return view('admin.menu.index', compact('aboutMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \Log::info("Req=MenuController@create called");
        $this->setPageTitle('Create Menu', 'Create Menu');
        $slugs = Page::where('page_status','1')->get();
        $menus = Menu::where('tab_status','1')->get();
        //dd($slugs);
        //$service = $this->menuRepository->createService();

        // if (!$service) {
        //     return $this->responseRedirectBack('Error occured while creating page', 'error', true, true);
        // }

        return view('admin.menu.create',compact('slugs','menus'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_title' => 'required',
            'location' => 'required'
        ]);
        $params = $request->except('_token');
        $createMenu = $this->menuRepository->createMenu($params);

        if(!$createMenu){
            return $this->responseRedirectBack('Error occurred while updating Menu', 'error', true, true);
        }

        return $this->responseRedirect('admin.menu.index', 'Menu has been updated successfully', 'success');
    }

    // Search page because add against the menu

    public function search(Request $request)
    {
        $page = Page::where('page_slug', 'like', '%' . $request->search_text . '%')->get();
        dd($page);
    }

    /**
     * product image upload
     * @param Request $request
     */
    public function uploadImage(Request $request)
    {
        \Log::info("Req=MenuController@create called");
        echo "upload";

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $Page
     * @return \Illuminate\Http\Response
     */
    // public function show($slug)
    // {
    //     \Log::info("Req=PageController@show called");
    //     $page = $this->pageRepository->findServiceBySlug($slug);
    //     return view('site.pages.cmspage',compact('page'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $Page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        \Log::info("Req=MenuController@create called");
        $this->setPageTitle('Menu', 'Edit Menu');
        $menus = Menu::where('tab_status','1')->get();
        $menuItems = Item::get();
		$menu = $this->menuRepository->findMenuById($id);
        //dd(json_encode($service));
		return view('admin.menu.create', compact('menu', 'menus','menuItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $Page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $params = $request->except('_token');
        $updateMenu = $this->menuRepository->updateMenu($params);

		if(!$updateMenu){
			return $this->responseRedirectBack('Error occurred while updating Menu', 'error', true, true);
		}

		return $this->responseRedirect('admin.menu.index', 'Menu has been updated successfully', 'success');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $Page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        \Log::info("Req=MenuController@create called");
        $deleteMenu = $this->menuRepository->deleteMenu($id);
		if(!$deleteMenu){
			return $this->responseRedirectBack('Error occured while deleting Menu', 'error', true, true);
		}
		return $this->responseRedirect('admin.menu.index', 'Menu has been deleted successfully', 'success');
    }
}