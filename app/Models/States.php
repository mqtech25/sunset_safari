<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $table = 'states';
    protected $fillable = [
		'country_id', 'name'
	];
    public $timestamps = false;
}