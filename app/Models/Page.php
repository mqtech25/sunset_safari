<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

	protected $fillable = [
		'id', 'page_title', 'page_subtitle', 'page_content', 'page_slug','page_status','page_banner_image','page_meta_title','page_meta_description','page_meta_keyword', 'created_at', 'updated_at',
	];
}
