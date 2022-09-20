<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRatting extends Model
{
    protected $table = 'product_rattings';

	protected $fillable = [
		'id', 'product_id', 'user_id', 'ratting', 'review','created_at','updated_at',
	];

	public function user(){
		return $this->belongsTo(User::class);
	}
}
