<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Menu extends Model
{
    protected $table = 'menu';

	protected $fillable = [
		'id', 'menu_title', 'location', 'tab_status','created_at', 'updated_at',
	];

	public function items()
	{
		# code...
		return $this->belongsToMany(Item::class,'menu_items','menuid','itemid');
	}
}
