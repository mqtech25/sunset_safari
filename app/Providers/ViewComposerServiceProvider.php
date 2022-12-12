<?php
namespace App\Providers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Cart;

class ViewComposerServiceProvider extends ServiceProvider{
	
	public function boot(){
		
		View::composer('site.partials.nav', function($view){ 
			// $view->with('categories', Category::orderByRaw('-name ASC')->get()->nest());
			$view->with('categories', Category::orderByRaw('name ASC')->get()->nest());

		});

		View::composer('site.partials.header', function($view){
			$view->with('cartCount', Cart::getContent()->count());

		});

		View::composer('site.partials.header', function($view){
			$menu_items = Menu::where(['location'=>'PRIMARY','tab_status'=>'1'])->first();
			$view->with(['cartCount'=> Cart::getContent()->count(),'menu_items'=>$menu_items]);

		});
		
		View::composer('site.partials.footer', function($view){
			$copy_right = Setting::where('key','footer_copyright_text')->first();
			//dd($copy_right);
			$view->with(['copy_right'=>$copy_right]);

		});
	}
}