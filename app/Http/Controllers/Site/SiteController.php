<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Post;
use App\Contracts\PostContract;
use App\Repositories\PostRespository;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    protected $postRepository;

    public function __construct(PostContract $postRepository)
    {
        \Log::info("Req=SiteController@__construct called");
        $this->postRepository = $postRepository;
    }

    // public function homePage(){
    //     \Log::info("Req=SiteController@homePage called");
    //     $featuredProducts = Product::where('status',1)->where('featured',1)->take(4)->get();
    //     // dd($featuredProducts[2]->mainProductThumbImage());
    //     $newlyArrivedProducts = Product::orderBy('id', 'desc')->take(4)->get();
    //     $recommendedProducts = Product::Select('products.*',\DB::raw('sum(product_rattings.ratting) as totalrattings, count(product_rattings.user_id) as totalusers'))->LeftJoin('product_rattings', function($q){
    //         return $q->on('products.id','product_rattings.product_id');
    //     })->groupby('products.id')->orderBy('product_rattings.ratting','desc')->inRandomOrder()->take(4)->get();
    //     $brands = Brand::inRandomOrder()->limit(6)->get();
    //     $categories = Category::select('name','slug','image')->where('featured', 1)->inRandomOrder()->limit(4)->get();
        
	// 	return view('site.pages.homepage', compact('featuredProducts', 'newlyArrivedProducts', 'recommendedProducts', 'brands','categories'));
    // }
    public function homePage(){
        \Log::info("Req=SiteController@homePage called");
		return view('site.pages.home');
    }
    public function offerDetail(){
        \Log::info("Req=SiteController@offerDetail called");
		return view('site.pages.viewDetails');
    }
    public function blogPage(){
        \Log::info("Req=SiteController@blogPage called");
        if(config('settings.blog_enabled') == 0)
        {
            \App::abort(404);
        }
        $posts = Post::where('status',1)->paginate(12);
        return view('site.pages.blogpage',compact('posts'));
    }

    public function postPage($slug)
    {
        \Log::info("Req=SiteController@postPage called");
        if(config('settings.blog_enabled') == 0)
        {
            \App::abort(404);
        }
        $post = $this->postRepository->findPostBySlug($slug);
        return view('site.pages.postpage',compact('post'));
    }

    public function contactPage(){
        \Log::info("Req=SiteController@contactPage called");
        return view('site.pages.contact');
    }
    
    public function search(Request $request){
        \Log::info("Req=SiteController@search called");
        $resultentProducts='';
        if($request->search_category == "all" && $request->search_keyword == ""){
            $resultentProducts = Product::where('status',1);
        }else if($request->search_category == "all" && $request->search_keyword != ""){
            $resultentProducts = Product::where('status',1)->where('name', 'like', '%'.$request->search_keyword.'%');
        }else if($request->search_category != "all" && $request->search_keyword == ""){
            $cat_id = $request->search_category;
            $resultentProducts = Product::where('status',1)->whereHas('categories', function($query) use ($cat_id){
                $query->where('categories.id', $cat_id);
            });
        }else{
            $cat_id = $request->search_category;
            $resultentProducts = Product::where('status',1)->whereHas('categories', function($query) use ($cat_id){
                $query->where('categories.id', $cat_id);
            })->where('name','like', '%'.$request->search_keyword.'%');
        }
        $resultentProducts = $resultentProducts->paginate(9);
        return view('site.pages.searchresults',compact('resultentProducts'));
    }
}