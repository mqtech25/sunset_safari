<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Post extends Model
{
    protected $table = 'blog_posts';

	protected $fillable = [
		'id', 'admin_id', 'title', 'slug', 'path', 'images','description', 'status', 'meta_title','meta_tags','meta_description'
	];

	public function creater()
	{
		return $this->hasOne(Admin::class,'id','admin_id');
	}
}
