<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ShippingRule;

class ShippingCountry extends Model
{
    protected $table = 'shipping_countries';

    protected $fillable = ['code', 'name', 'shipping_status'];


    public function rules(){
        return $this->hasMany(ShippingRule::class);
    }
}
