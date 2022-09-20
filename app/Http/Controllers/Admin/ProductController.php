<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Contracts\BrandContract;
use App\Contracts\CategoryContract;
use App\Http\Requests\ProductFormValidate;
use App\Traits\UploadAble;
use App\Models\ProductImage;
use Intervention\Image\ImageManager;

class ProductController extends BaseController
{
	use UploadAble;
	/**
	* @var $productRepository;
	*/
	protected $productRepository;

	/**
	* @var $brandRepository
	*/
	protected $brandRepository;

	/**
	* @var $categoryRepository
	*/
	protected $categoryRepository;

	/**
	* ProductController Construct
	* @param ProductContract $productRepository
	*/
	public function __construct(ProductContract $productRepository, BrandContract $brandRepository, CategoryContract $categoryRepository){
		\Log::info("Req=ProductController@__construct called");
		$this->productRepository = $productRepository;
		$this->brandRepository = $brandRepository;
		$this->categoryRepository = $categoryRepository;
	}

	/**
	* @return \Illuminate\Contracts\View\Factory|Illuminate\View\View
	*/
	public function index(){
		\Log::info("Req=ProductController@index called");
		$this->setPageTitle('Product', 'List All Product');
		$products = $this->productRepository->listProducts();
		return view('admin.products.index', compact('products'));
	}

	/**
	* @return \Illuminate\Contracts\View\Factory|Illumiate\View\View
	*/
	public function create(){
		\Log::info("Req=ProductController@create called");
		$this->setPageTitle('Product', 'Create Product');
		$brands = $this->brandRepository->listBrands();
		$categories = $this->categoryRepository->listCategories();
		return view('admin.products.form', compact('brands', 'categories'));
	}


	/**
	* @param Request $reqest
	*/
	public function store(ProductFormValidate $request){
		\Log::info("Req=ProductController@store called");

		// $this->validate($request,[
		// 	'name'			=> 'required|max:255',
		// 	'sku'			=> 'required',
		// 	'brand_id'		=> 'required|not_in:0',
		// 	'price'			=> 'regex:/^\d+(\.\d{1,2})?$/|required',
		// 	'special_price'	=> 'regex:/^\d+(\.\d{1,2})?$/',
		// 	'quantity'		=>	'required|numeric'

		// ]);

		$params = $request->except('_token');

		$createProduct = $this->productRepository->createProduct($params);

		if(!$createProduct){
			return $this->responseRedirectBack('Error occured while creating product', 'error', true, true);		
		}

		return $this->responseRedirect('admin.products.index', 'Product added successfully.', 'success');
	}


	/**
	 * @param int $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($id){
		\Log::info("Req=ProductController@edit called");
		$this->setPageTitle('Product', 'Edit Product');

		$product = $this->productRepository->findOneOrFail($id);

		$brands = $this->brandRepository->listBrands();

		$categories = $this->categoryRepository->listCategories();
		
		return view('admin.products.form', compact('product','brands', 'categories'));
	}

	/**
	 * @param Request $request
	 * @return mixed
	 */
	public function update(ProductFormValidate $request){
		
		$params = $request->except('_token');
		$updateProduct = $this->productRepository->updateProduct($params);

		if(!$updateProduct){
			return $this->responseRedirectBack('Error occurred while updating product', 'error', true, true);
		}

		return $this->responseRedirect('admin.products.index', 'Product has been updated successfully', 'success');

	}


	/**
	 * @param int $id
	 * @return mixed
	 */
	public function delete($id){
		\Log::info("Req=ProductController@delete called");
		$deleteProduct = $this->productRepository->deleteProduct($id);

		if(!$deleteProduct){
			return $this->responseRedirectBack('Error occured while deleting product', 'error', true, true);
		}

		return $this->responseRedirect('admin.products.index', 'Product has been deleted successfully', 'success');
	}


	/**
	* product image upload
	* @param Request $request
	*/
	public function uploadImage(Request $request){
		\Log::info("Req=ProductController@uploadImage called");
		$product = $this->productRepository->findOneOrFail($request->product_id);
		if($request->has('image')){
			$fileName = $product->slug."-".$product->id;
			$imgName = $fileName.uniqid (rand ());
			$mainImg = $imgName.'.'.$request->image->getClientOriginalExtension();
			$path ='\storage\products\\'.$request->product_id;
			\Storage::makeDirectory($path);
			// \File::makeDirectory($path, $mode = 0777, true, true);
			
			
			$image = $this->uploadOne($request->image, 'products/'.$request->product_id, 'public', $imgName);
			$categoryThumb = $this->uploadThumbs($request->image,$path.'\\', $fileName, config('settings.cat_img_width'));
			$productPageThumb = $this->uploadThumbs($request->image, $path.'\\', $fileName, config('settings.product_image_width'));
			$productThumb = $this->uploadThumbs($request->image,$path.'\\', $fileName, config('settings.product_thumb_img'));
			$imgNames = ['full'=>$mainImg,'categoryThumb'=>$categoryThumb,'productPageThumb'=>$productPageThumb,'productThumb'=>$productThumb];
			$imgNames = json_encode($imgNames);
			$isFeatured = 0;
			if($product->images()->count() == 0)
			{
				$isFeatured = 1;
			}

			$productImages = [[
				'product_id' => $request->product_id,
				'path'	=> $path,
				'thumbs' => $imgNames,
				'main' => $isFeatured,
			],];

			// $product->images()->save($productImage);
			ProductImage::insert($productImages);

		}

		return response()->json(['status' => 'success']);
	}

	public function setFeaturedImage(Request $request){
		$image = ProductImage::findOrFail($request->imageId);
		$image->main = 1;
		if($image->save()){
			$oldFeatured = ProductImage::findOrFail($request->old_featured);
			$oldFeatured->main = 0;
			$oldFeatured->save();
		}
	}


	public function deleteImage($id){
		$image = ProductImage::findOrFail($id);
		if($image->full != ''){
			$this->deleteOne($image->full);
		}

		$image->delete();

		return redirect()->back();
	}

	public function deleteBulkImages($id){
		$image = ProductImage::findOrFail($id);
		if($image->main == 1)
		{
			$newFeatured = ProductImage::where([['product_id',$image->product_id],['main', 0]])->first();
			if($newFeatured != null){
				$newFeatured->main = 1;
				$newFeatured->save();
			}
		}
		foreach(json_decode($image->thumbs) as $imageName)
		{
			if($imageName != ''){
				$this->deleteThumbs($image->path,$imageName);
			}
		}
		$image->delete();
		return redirect()->back();
	}
}
