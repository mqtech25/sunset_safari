<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingRule extends Model
{
    protected $table = 'shipping_rules';

    protected $fillable = ['shipping_country_id', 'min_weight', 'max_weight', 'shipping_amount', 'status'];
}
