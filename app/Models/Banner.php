<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

	protected $fillable = [
		'id', 'banner_image', 'banner_title', 'banner_subtitle', 'banner_status', 'banner_order', 'created_at', 'updated_at',
	];
}
