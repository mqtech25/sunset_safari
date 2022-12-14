<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\CategoryContract;
use App\Repositories\CategoryRepository;

use App\Contracts\AttributeContract;
use App\Repositories\AttributeRepository;

use App\Contracts\BrandContract;
use App\Repositories\BrandRepository;

use App\Contracts\ProductContract;
use App\Repositories\ProductRepository;

use App\Contracts\OrderContract;
use App\Repositories\OrderRepository;

use App\Contracts\BannerContract;
use App\Repositories\BannerRepository;

use App\Contracts\PageContract;
use App\Repositories\PageRepository;

use App\Contracts\CouponContract;
use App\Repositories\CouponRepository;

use App\Contracts\PostContract;
use App\Repositories\PostRepository;

use App\Contracts\MenuContract;
use App\Repositories\MenuRepository;

use App\Contracts\ItemContract;
use App\Repositories\ItemRepository;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
    * @var $repositories
    */
    protected $repositories = [
        CategoryContract::class         =>  CategoryRepository::class,
        AttributeContract::class        =>  AttributeRepository::class,
        BrandContract::class            =>  BrandRepository::class,
        ProductContract::class          =>  ProductRepository::class,
        OrderContract::class            =>  OrderRepository::class,
        BannerContract::class            =>  BannerRepository::class,
        PageContract::class            =>  PageRepository::class,
        CouponContract::class            =>  CouponRepository::class,
        PostContract::class            =>  PostRepository::class,
        MenuContract::class          =>  MenuRepository::class,
        ItemContract::class          =>  ItemRepository::class,
    ];
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        \Log::info("Req=Providers/RepositoryServiceProvider@register Called");

        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}