<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Item extends Model
{
    protected $table = 'items';

	protected $fillable = [
		'id', 'name', 'slug','slug_id','parent','created_at', 'updated_at',
	];

	public function menus()
	{
		# code...
		return $this->belongsToMany(Menu::class,'menu_items','menuid','itemid');
	}
}
