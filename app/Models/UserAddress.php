<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserAddress extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    private $obj;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','first_name', 'last_name', 'phone', 'address', 'addressline2', 'city', 'state', 'zip_code', 'country','is_primary'
    ];


    public function getFormatedAddress(){
        return $this->first_name.' '.$this->last_name.', '.$this->address.', '.$this->addressline2.', '.$this->city.', '.$this->state.', '.$this->country;
    }
}
