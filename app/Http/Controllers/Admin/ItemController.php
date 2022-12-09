<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Page;
use App\Repositories\ItemRepository;
use App\Contracts\ItemContract;
use Illuminate\Http\Request;
use App\Traits\UploadAble;
use Intervention\Image\Facades\Image;
use App\Models\SubService;

class ItemController extends BaseController
{
    use UploadAble;
    protected $itemRepository;

    public function __construct(ItemContract $itemRepository)
    {
        \Log::info("Req=ItemController@__construct called");
        $this->itemRepository = $itemRepository;
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Log::info("Req=ItemController@__construct called");
        $aboutItem = $this->itemRepository->listItem()->keyBy('id');
        $this->setPageTitle('Item', 'List of All Item');
        return view('admin.menuitems.index', compact('aboutItem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \Log::info("Req=ItemController@create called");
        $this->setPageTitle('Create Item', 'Create Item');
        $menus = Menu::where('tab_status','1')->get();
        $items = Item::get();
        //dd($menus);
        //$service = $this->itemRepository->createService();

        // if (!$service) {
        //     return $this->responseRedirectBack('Error occured while creating page', 'error', true, true);
        // }

        return view('admin.menuitems.create',compact('menus','items'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $names = Item::where('id',$request->parent)->get('name')->first(); 
        if(isset($names)){
            if($names->name == $request->name ){
                return $this->responseRedirect('admin.item.create', 'Menu Item and Parent should not be same!', 'success');
            }
        }
        $validated = $request->validate([
            'name' => 'required',
            'parent' => 'required',
            'slug' => 'required'
        ]);
        $params = $request->except('_token');
        $createMenu = $this->itemRepository->createItem($params);

        if(!$createMenu){
            return $this->responseRedirectBack('Error occurred while updating Menu Item', 'error', true, true);
        }

        return $this->responseRedirect('admin.item.index', 'Menu Item has been updated successfully', 'success');
    }

    // Load Page Data
    public function loadPageData(Request $request)
    {
        $page = Page::where('id',$request->id)->get();
        //dd($page);
        $pageInfo = json_decode($page);
        return response($pageInfo, 200)->header('Content-Type', $page);
        //return view('admin.item.create',compact('page'))
    }

    // Search page because add against the menu

    public function search()
    {
        $pageSlug = $_GET['term'];
        $page = Page::where('page_slug', 'like', '%' . $pageSlug . '%')->get();
        //dd(json_decode($page));
        return json_decode($page);
    }

    /**
     * product image upload
     * @param Request $request
     */
    public function uploadImage(Request $request)
    {
        \Log::info("Req=ItemController@create called");
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
        \Log::info("Req=ItemController@create called");
        $this->setPageTitle('Menu', 'Edit Menu');
        $menus = Menu::where('tab_status','1')->get();
		$menu = $this->itemRepository->findItemById($id);
        $pageInfo = Page::where('page_slug',$menu->slug)->get();
        //dd(json_encode($service));
		return view('admin.menuitems.create', compact('menu', 'menus','pageInfo'));
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
        $updateMenu = $this->itemRepository->updateItem($params);

		if(!$updateMenu){
			return $this->responseRedirectBack('Error occurred while updating Menu', 'error', true, true);
		}

		return $this->responseRedirect('admin.item.index', 'Menu has been updated successfully', 'success');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $Page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Log::info("Req=ItemController@create called");
        $deleteMenu = $this->itemRepository->deleteItem($id);
		if(!$deleteMenu){
			return $this->responseRedirectBack('Error occured while deleting Menu', 'error', true, true);
		}
		return $this->responseRedirect('admin.item.index', 'Menu has been deleted successfully', 'success');
    }
}