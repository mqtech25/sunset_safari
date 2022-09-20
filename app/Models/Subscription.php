<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscription extends Model
{
	protected $table = 'subscriptions';

	protected $fillable = ['email','subscription_tokken'];
}
