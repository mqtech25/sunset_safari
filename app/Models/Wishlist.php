<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Product;

class Wishlist extends Model
{
    protected $table = 'wishlists';

	protected $fillable = [
		'id', 'user_id', 'product_id', 'created_at','updated_at',
	];
}
