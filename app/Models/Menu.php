<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // protect
    protected $table='menu';

    // fillable

    protected $fillable = [
        'title',
        'status',
        'location',
        'items',
    ];
}