<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Contracts\CategoryContract;
use App\Contracts\AttributeContract;

class CategoryController extends Controller{

	protected $categoryRepository;
	protected $attributeRepository;

	public function __construct(CategoryContract $categoryRepository, AttributeContract $attributeRepository){
		\Log::info("Req=CategoryController@__construct called");
		$this->categoryRepository = $categoryRepository;
		$this->attributeRepository = $attributeRepository;
	}

	public function show($slug){
		\Log::info("Req=CategoryController@show called");
		$category = $this->categoryRepository->findBySlug($slug);
		$cat_id = $category->id;
		$products = Product::where('status',1)->whereHas('categories', function($query) use ($cat_id){
			$query->where('categories.id', $cat_id);
		})->paginate(10);
		$attributes = $this->attributeRepository->listAttributes();
		return view('site.pages.category', compact('products','attributes','category'));
	}

	public function showBrand($slug){
		\Log::info("Req=CategoryController@show called");
		
		$brand = Brand::where('slug',$slug)->firstOrFail();
		$brand_id = $brand->id;
		$products = Product::where([['status',1],['brand_id',$brand_id]])->paginate(10);
		$attributes = $this->attributeRepository->listAttributes();
		return view('site.pages.brand', compact('products','attributes','brand'));
	}

	public function sorting(Request $request){
		$cat_id = $request->cat_id;
		$sortby = $request->sortby;
		$category = $this->categoryRepository->findCategoryById($cat_id);
		$attributes = $this->attributeRepository->listAttributes();
		if($sortby == 'hp'){
			$products = Product::where('status',1)->whereHas('categories', function($query) use ($cat_id){$query->where('categories.id', $cat_id);})->orderby('price','desc')->paginate(10);
		}elseif($sortby == 'lp'){
			$products = Product::where('status', 1)->whereHas('categories', function ($query) use ($cat_id) {$query->where('categories.id', $cat_id);})->orderby('price', 'asc')->paginate(10);
		}elseif($sortby == 'az'){
			$products = Product::where('status',1)->whereHas('categories', function($query) use ($cat_id){$query->where('categories.id', $cat_id);})->orderby('name','asc')->paginate(10);
		}elseif($sortby == 'za'){
			$products = Product::where('status', 1)->whereHas('categories', function ($query) use ($cat_id) {$query->where('categories.id', $cat_id);})->orderby('name', 'desc')->paginate(10);
		}elseif($sortby == 'ra'){
			$products = Product::Select('products.*',\DB::raw('sum(product_rattings.ratting) as totalrattings, count(product_rattings.user_id) as totalusers'))->LeftJoin('product_rattings', function($q){
            return $q->on('products.id','product_rattings.product_id');
        	})->whereHas('categories', function ($query) use ($cat_id) {$query->where('categories.id', $cat_id);})->groupby('products.id')->orderBy('product_rattings.ratting','desc')->inRandomOrder()->paginate(10);
		}
		// dd($products);
		return view('site.pages.category', compact('category','attributes','products'));
	}


	public function filterProducts(Request $request){
		// dd($request);
		$minPrice = $request->min_price;
		$maxPrice = $request->max_price;
		$cat_id = $request->cat_id;

		$category = $this->categoryRepository->findCategoryById($cat_id);
		$attributes = $this->attributeRepository->listAttributes();

		$otherOptions = $request->except('min_price','max_price','pricerange','cat_id');
		$attributeIds = array_values($otherOptions);
		$attributeValues = array_keys($otherOptions);
		// dd($attributeIds);
		if(count($otherOptions)>0){
			$products = Product::Select('products.*')->LeftJoin('product_attributes', function($q){
				return $q->on('products.id','product_attributes.product_id');
			})->LeftJoin('product_categories', function($q2){
				return $q2->on('product_categories.product_id','products.id');
			})->whereIn('product_attributes.attribute_id',$attributeIds)->whereIn('product_attributes.value',$attributeValues)->where('product_categories.category_id' ,$cat_id)->paginate(10);
		}else{
			$products = Product::where('status',1)->whereBetween('price', [$minPrice, $maxPrice])->whereHas('categories', function($query) use ($cat_id){$query->where('categories.id', $cat_id);})->paginate(10);
		}
		return view('site.pages.category', compact('category','attributes','products'));
	}
}