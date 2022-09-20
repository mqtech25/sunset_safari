<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
	protected $table = 'products';

	protected $fillable = [
		'brand_id', 'sku', 'name', 'slug', 'description', 'quantity', 'weight', 'price', 'special_price', 'status', 'featured',
	];

	protected $casts = [
		'quantity'	=>	'integer',
		'brand_id'	=>	'integer',
		'status'	=>	'boolean',
		'featured'	=>	'boolean',
	];


	public function setNameAttribute($value){
		$this->attributes['name'] = $value;
		$this->attributes['slug'] = Str::slug($value);
	}

	public function brand(){
		// $products->brand
		return $this->belongsTo(Brand::class);
	}

	public function images(){
		// $product->images
		return $this->hasMany(ProductImage::class);
	}

	public function mainProductThumbImage(){
		// $product->images
		return $this->hasOne(ProductImage::class)->select('path','thumbs')->where('main', 1)->first()->getMainThumb();
	}

	public function singleProductThumb(){
		// $product->images
		return $this->hasOne(ProductImage::class)->select('path','thumbs')->where('main', 1)->first()->getSingleProductThumb();
	}
	public function singleProductFull(){
		// $product->images
		return $this->hasOne(ProductImage::class)->select('path','thumbs')->where('main', 1)->first()->getProductFullThumb();
	}
	public function attributes(){
		// $product->attributes
		return $this->hasMany(ProductAttribute::class);
	}

	public function categories(){
		// $product->categories()->sync(array(1,2,3));
		return $this->belongsToMany(Category::class, 'product_categories', 'product_id','category_id');
	}

	public function rattings(){
		// $product->rattings
		return $this->hasMany(ProductRatting::class);
	}

	public function wishlist(){
		return $this->belongsTo(Wishlist::class);
	}
}
