<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';

	protected $fillable = [
		'id', 'order_id', 'status', 'comments', 'created_at', 'updated_at',
	];
}
