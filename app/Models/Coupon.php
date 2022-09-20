<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';

	protected $fillable = [
		'id', 'type', 'code', 'details', 'discount','discount_type','start_date','end_date',
	];

	 public function users(){
		return $this->belongsToMany('App\User','coupon_usages','coupon_id','user_id')->withTimestamps();
	}
}
