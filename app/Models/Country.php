<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = [
		'code', 'name', 'phonecode'
	];
    public $timestamps = false;

    public function states()
    {
        return $this->hasMany(States::class, 'country_id', 'id');
    }
}