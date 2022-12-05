<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    // protect
    protected $table='items';

    // fillable
    protected $fillable = [
        'title',
        'slug',
    ];
}