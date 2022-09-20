<div class="user-name-tile mb-2">
    <div class="row">
        <div class="col-4">
            <img class="profile_avatar_img" src="{{asset('storage/img/useravt.png')}}" alt="">
        </div>
        <div class="col-8">
            <p class="pt-2"><strong>{{Auth::user()->primaryAddress->first_name.' '.Auth::user()->primaryAddress->last_name}}</strong><br><small class="text-muted">Customer</small></p>
            
        </div>
    </div>
</div>
<div class="user-menu-tile mb-5">
    <ul class="nav flex-column">
        <li class="nav-item mt-3 {{ Route::currentRouteName() == 'site.customer.profile' ? 'user-sidebar-active' : '' }}"><a href="{{route('site.customer.profile')}}" class="user-menu-link">My Account</a></li>
        <li class="nav-item mt-3 {{ Route::currentRouteName() == 'customer.orders' ? 'user-sidebar-active' : '' }}"><a href="{{route('customer.orders')}}" class="user-menu-link">My Orders</a></li>
        <li class="nav-item mt-3 {{ Route::currentRouteName() == 'wishlist.index' ? 'user-sidebar-active' : '' }}"><a href="{{route('wishlist.index')}}" class="user-menu-link">Whishlist</a></li>
        <li class="nav-item mt-3 {{ Route::currentRouteName() == 'customer.addresses' ? 'user-sidebar-active' : '' }}"><a href="{{route('customer.addresses')}}" class="user-menu-link">Addresses</a></li>
    </ul>
    <hr>
    <ul class="nav flex-column">
        <li class="nav-item"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="user-menu-link">Logout</a></li>
    </ul>
</div>