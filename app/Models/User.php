<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'address', 'addressline2', 'city', 'country',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getFullNameAttribute(){
        return $this->address()->first_name. ' '. $this->address()->last_name;
    }

    public function address(){
        return $this->hasMany(UserAddress::class, 'user_id','id');
    }

    public function primaryAddress(){
        return $this->hasOne(UserAddress::class, 'user_id','id')->where('is_primary',1);
    }


    public function wishlist(){
        return $this->hasMany(Wishlist::class, 'user_id','id')
        ->leftJoin('products', function($q){
            return $q->on('wishlists.product_id','products.id');
        })
        ->leftJoin('product_images', function($q){
            return $q->on('product_images.product_id','products.id')->where('product_images.main', 1);
        })->select(\DB::raw('products.id as product_id'),'wishlists.id','products.slug','products.name','products.price','products.special_price',
                            'products.quantity','wishlists.created_at','product_images.thumbs','product_images.path')
        ->where('products.status', 1)->groupBy('products.id')->get();
    }
}
