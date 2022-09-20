<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';

	protected $fillable = [
		'order_number',
		'user_id',
		'status',
		'sub_total',
		'discount',
		'shipping',
		'grand_total',
		'item_count',
		'payment_status',
		'payment_method',
		'first_name',
		'last_name',
		'email',
		'address',
		'addressline2',
		'city',
		'state',
		'country',
		'post_code',
		'phone_number',
		'shipping_address',
		'notes'
	];

	public function user(){
		return $this->belongsTo(User::class, 'user_id');
	}

	public function items(){
		return $this->hasMany(OrderItem::class);
	}

	public function orderStatus(){
		return $this->hasMany(OrderStatus::class);
	}
}
