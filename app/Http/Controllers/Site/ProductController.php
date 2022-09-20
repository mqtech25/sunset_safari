<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Contracts\ProductContract;
use App\Models\ProductRatting;
use App\Contracts\AttributeContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Cart;

class ProductController extends Controller{

	protected $productRepository;
	protected $attributeRepository;

	public function __construct(ProductContract $productRepository, AttributeContract $attributeRepository){
		\Log::info("Req=ProductController@__construct called");
		$this->productRepository = $productRepository;
		$this->attributeRepository = $attributeRepository;
	}

	public function show($slug){
		\Log::info("Req=ProductController@show called");
		$product = $this->productRepository->findProductBySlug($slug);
		$fiveStars = $fourStars = $threeStars = $twoStars = $oneStars = 0;
		$rattings = ProductRatting::select('ratting',\DB::raw("count('ratting') as rattingCount"))->where('product_id',$product->id)->groupby('ratting')->get();
		foreach($rattings as $ratting){
			if($ratting->ratting == 1){
				$oneStars = $ratting->rattingCount;
			}elseif($ratting->ratting == 2){
				$twoStars = $ratting->rattingCount;
			}elseif($ratting->ratting == 3){
				$threeStars = $ratting->rattingCount;
			}elseif($ratting->ratting == 4){
				$fourStars = $ratting->rattingCount;
			}elseif($ratting->ratting == 5){
				$fiveStars = $ratting->rattingCount;
			}
		}
		
		$rattingsCount = array("fivestar"=>$fiveStars, "fourstar"=>$fourStars, "threestar"=>$threeStars, "twostar"=>$twoStars, "onestar"=>$oneStars);
		
		$attributes = $this->attributeRepository->listAttributes();
		return view('site.pages.product', compact('product', 'attributes','rattingsCount'));
	}

	public function storeProductRatting(Request $request){
		\Log::info("Req=ProductController@storeProductRatting called");
		
		if($request->star_rating != null)
		{
			$ratting = new ProductRatting();
			$ratting->product_id = $request->product_id;
			$ratting->user_id = Auth::user()->id;
			$ratting->ratting = $request->star_rating;
			$ratting->review = $request->product_review;
			if($ratting->save()){
				return redirect()->back()->with('message', 'Item added to cart successfully');
			}
			return redirect()->back()->with('Error', 'Something went wrong.');
		}
		return redirect()->back()->with('Error', 'Please select star ratting.');
	}

	public function directAddToCart($id)
	{
		$product = $this->productRepository->findProductById($id);
		$productId = $product->weight.'-'.$product->id;
		Cart::add(str_replace('.','&',$productId), $product->name, ($product->price == $product->special_price ? $product->price : $product->special_price), 1, null);
		return redirect()->back()->with('message', 'Item added to cart successfully');
	}

	public function addToCart(Request $request){
		\Log::info("Req=ProductController@addToCart called");

		$product = $this->productRepository->findProductById($request->input('productId'));
		$productId = $product->weight.'-'.$product->id;
		$options = $request->except('_token', 'productId', 'price', 'qty');
		$attr_ids = array();
		$otherInputsIds = array();
		$otherInputIdString = '';
		if(count($options)>0){
			foreach($options as $key=>$op)
			{
				$otherInputIdString.=$op;
				$oparr = explode('-',$key);
				if(count($oparr)>1){
					$attr_ids[] = $oparr[count($oparr)-1];
					$otherInputsIds[$oparr[count($oparr)-1]] = $op;
				}else{
					$attr_ids[] = $op;
				}
			}
		}
		$attr_Names=array_keys($options);
		$total_attr_price = 0;
		if($options)
		{
			$attr_id = reset($options);
			$attributes = \App\Models\ProductAttribute::whereIn('id', $attr_ids)->get();
			$productId = $productId."-".implode('-',$attr_ids)."-".implode('-',$attr_Names);
			// $productId = preg_replace('/[\W]/', '', $productId.$otherInputIdString);

			// dd($productId);
			foreach($attributes as $attr)
			{
				if(array_key_exists($attr->id, $otherInputsIds))
				{
					$option[$attr->attribute->name] = $otherInputsIds[$attr->id];
				}
				else{
					$option[$attr->attribute->name] = $attr->value;
				}
				
				$total_attr_price += $attr->price;
			}
			$option['Additional Amount'] = $total_attr_price;
		}
		Cart::add(str_replace('.','&',$productId), $product->name, $request->input('price'), $request->input('qty'), $options!=null?$option:$options);
		return redirect()->back()->with('message', 'Item added to cart successfully');
	}

}