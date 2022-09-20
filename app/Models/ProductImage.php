<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
	protected $table = 'product_images';

	protected $fillable = ['product_id', 'path', 'thumbs'];

	protected $casts = [
		'product_id' => 'integer',
	];

	public function product(){
    	// $images->product
		return $this->belongsTo(Product::class);
	}

	public function getMainThumb(){
        return $this->path.'\\'.json_decode($this->thumbs)->categoryThumb;
	}
	
	public function getSingleProductThumb(){
        return $this->path.'\\'.json_decode($this->thumbs)->productPageThumb;
	}
	
	public function getProductFullThumb(){
        return $this->path.'\\'.json_decode($this->thumbs)->full;
    }
}
