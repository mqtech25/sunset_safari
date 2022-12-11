@php
	$name = explode(" ", \Auth::user()->name);
	$adminAcronym = "";

	foreach ($name as $w) {
		$adminAcronym .= $w[0]." ";
	}
@endphp

<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
	<div class="app-sidebar__user"><img class="app-sidebar__user-avatar" width="50" src="https://via.placeholder.com/50x50.png?text={{$adminAcronym}}" alt="User Image">
		<div>
			<p class="app-sidebar__user-name">{{\Auth::user()->name}}</p>
			<p class="app-sidebar__user-designation">Site Admin</p>
		</div>
	</div>
	<ul class="app-menu">
		<li>
			<a class="app-menu__item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : null }}" href="{{ route('admin.dashboard') }}">
				<i class="app-menu__icon fa fa-dashboard"></i>
				<span class="app-menu__label">Dashboard</span>
			</a>
		</li>
		<li>
			<a class="app-menu__item {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}" href="{{ route('admin.settings') }}">
				<i class="app-menu__icon fa fa-cogs"></i>
				<span class="app-menu__label">Settings</span>
			</a>
		</li>
		
		<li class="treeview"><a class="app-menu__item {{ Route::currentRouteName() == 'admin.menu.index' ? 'active' : '' }} " href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-bars"></i><span class="app-menu__label">Navigation</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li>
				<a href="{{ route('admin.menu.index') }}" rel="noopener" class="treeview-item {{ Route::currentRouteName() == 'admin.menu.index' ? 'active' : '' }}">
					<i class="app-menu__icon fa fa-sliders"></i>
					<span class="app-menu__table">Menu</span>
				</a>
			</li>
			<li>
				<a href="{{ route('admin.item.index') }}" rel="noopener" class="treeview-item {{ Route::currentRouteName() == 'admin.item.index' ? 'active' : '' }}">
					<i class="app-menu__icon fa fa-sliders"></i>
					<span class="app-menu__table">Menu Items</span>
				</a>
			</li>
          </ul>
        </li>
		{{-- <li>
			<a class="app-menu__item {{ Route::currentRouteName() == 'admin.createmenu.index' ? 'active' : '' }}" href="{{ route('admin.createmenu.index') }}">
				<i class="app-menu__icon fa fa-tags"></i>
				<span class="app-menu__label">Create Menu</span>
			</a>
		</li> --}}
		<li>
			<a class="app-menu__item {{ Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
				<i class="app-menu__icon fa fa-tags"></i>
				<span class="app-menu__label">Categories</span>
			</a>
		</li>
		<li>
			<a class="app-menu__item {{ Route::currentRouteName() == 'admin.attributes.index' ? 'active' : '' }}" href="{{ route('admin.attributes.index') }}">
				<i class="app-menu__icon fa fa-th"></i>
				<span class="app-menu__label">Attributes</span>
			</a>
		</li>
		<li>
			<a class="app-menu__item {{ Route::currentRouteName() == 'admin.brands.index' ? 'active' : '' }}" href="{{ route('admin.brands.index') }}">
				<i class="app-menu__icon fa fa-briefcase"></i>
				<span class="app-menu__label">Brands</span>
			</a>
		</li>
		<li>
			<a class="app-menu__item {{ Route::currentRouteName() == 'admin.products.index' ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
				<i class="app-menu__icon fa fa-shopping-bag"></i>
				<span class="app-menu__label">Products</span>
			</a>
		</li>
		<li>
			<a class="app-menu__item {{ Route::currentRouteName() == 'admin.orders.index' ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
				<i class="app-menu__icon fa fa-pencil-square-o"></i>
				<span class="app-menu__label">Orders</span>
			</a>
		</li>
		<li>
			<a class="app-menu__item {{ Route::currentRouteName() == 'admin.shipping.index' ? 'active' : '' }}" href="{{ route('admin.shipping.index') }}">
				<i class="app-menu__icon fa fa-truck"></i>
				<span class="app-menu__label">Shipping</span>
			</a>
		</li>
		<li>
			<a class="app-menu__item {{ Route::currentRouteName() == 'admin.coupons.index' ? 'active' : '' }}" href="{{ route('admin.coupons.index') }}">
				<i class="app-menu__icon fa fa-gift"></i>
				<span class="app-menu__label">Coupons</span>
			</a>
		</li>
		@if(config('settings.blog_enabled') == 1)
		<li>
			<a class="app-menu__item {{ Route::currentRouteName() == 'admin.posts.index' ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
				<i class="app-menu__icon fa fa-thumb-tack post-icon"></i>
				<span class="app-menu__label">Posts</span>
			</a>
		</li>
		@endif

		<li>
			<a class="app-menu__item {{ Route::currentRouteName() == 'admin.contactmails.index' ? 'active' : '' }}" href="{{ route('admin.contactmails.index') }}">
				<i class="app-menu__icon fa fa-envelope"></i>
				<span class="app-menu__label">Contact Mail</span>
			</a>
		</li>

		<li>
			<a class="app-menu__item {{ Route::currentRouteName() == 'admin.subscriptions.index' ? 'active' : '' }}" href="{{ route('admin.subscriptions.index') }}">
				<i class="app-menu__icon fa fa-users"></i>
				<span class="app-menu__label">Subscriptions</span>
			</a>
		</li>

		<li class="treeview"><a class="app-menu__item {{ Route::currentRouteName() == 'admin.banners.index' ? 'active' : '' }} {{ Route::currentRouteName() == 'admin.pages.index' ? 'active' : '' }}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">CMS</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li>
				<a href="{{ route('admin.banners.index') }}" rel="noopener" class="treeview-item {{ Route::currentRouteName() == 'admin.banners.index' ? 'active' : '' }}">
					<i class="app-menu__icon fa fa-sliders"></i>
					<span class="app-menu__table">Banners</span>
				</a>
			</li>
			<li>
				<a href="{{ route('admin.pages.index') }}" rel="noopener" class="treeview-item {{ Route::currentRouteName() == 'admin.pages.index' ? 'active' : '' }}">
					<i class="app-menu__icon fa fa-files-o"></i>
					<span class="app-menu__table">Pages</span>
				</a>
			</li>
          </ul>
        </li>
	</ul>
</aside>