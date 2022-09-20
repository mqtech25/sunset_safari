<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Page;
use App\Repositories\PageRespository;
use App\Contracts\PageContract;
use Illuminate\Http\Request;
use App\Traits\UploadAble;

class PageController extends BaseController
{
    use UploadAble;
    protected $pageRepository;

    public function __construct(PageContract $pageRepository)
    {
        \Log::info("Req=PageController@__construct called");
        $this->pageRepository = $pageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Log::info("Req=PageController@create called");
        $pages = $this->pageRepository->listPages();
        $this->setPageTitle('Pages', 'List All Pages');
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \Log::info("Req=PageController@create called");
        $this->setPageTitle('Create Page', 'Create Page');

        $page = $this->pageRepository->createPage();

        if (!$page) {
            return $this->responseRedirectBack('Error occured while creating page', 'error', true, true);
        }

        return view('admin.pages.create', compact('page'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * product image upload
     * @param Request $request
     */
    public function uploadImage(Request $request)
    {
        \Log::info("Req=PageController@uploadImage called");
        echo "upload";

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $Page
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        \Log::info("Req=PageController@show called");
        $page = $this->pageRepository->findPageBySlug($slug);
        return view('site.pages.cmspage',compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $Page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        \Log::info("Req=PageController@edit called");
        $this->setPageTitle('Page', 'Edit Page');

		$page = $this->pageRepository->findPageById($id);
		return view('admin.pages.create', compact('page'));
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
		$updatePage = $this->pageRepository->updatePage($params);

		if(!$updatePage){
			return $this->responseRedirectBack('Error occurred while updating Page', 'error', true, true);
		}

		return $this->responseRedirect('admin.pages.index', 'Page has been updated successfully', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $Page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Log::info("Req=PageController@destroy called");
        $deletePage = $this->pageRepository->deletePage($id);
		if(!$deletePage){
			return $this->responseRedirectBack('Error occured while deleting Page', 'error', true, true);
		}
		return $this->responseRedirect('admin.pages.index', 'Page has been deleted successfully', 'success');
    }
}
