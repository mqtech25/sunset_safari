@php
    $newOrders = \App\Models\Order::select(DB::raw("concat(`first_name`,' ',`last_name`) as name"),'id','created_at')->where('order_status', 0)->get();
    $newOrdersCount = $newOrders->count();
@endphp
<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" href="index.html">{{ config('settings.site_title') }}</a>
  <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
  <!-- Navbar Right Menu-->
  <ul class="app-nav">
    <li class="app-search">
      <input class="app-search__input" type="search" placeholder="Search">
      <button class="app-search__button"><i class="fa fa-search"></i></button>
  </li>
  <!--Notification Menu-->
  <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i><sup><span class="badge badge-danger">{{$newOrdersCount}}</span></sup></a>
      <ul class="app-notification dropdown-menu dropdown-menu-right">
        <li class="app-notification__title">You have {{$newOrdersCount}} new Orders.</li>
        <div class="app-notification__content">
          @foreach ($newOrders as $newOrder)
              <li>
                <a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack"><span class="badge badge-danger">NEW</span></span></span>
                  <div>
                    <p class="app-notification__message">Order from {{$newOrder->name}}</p>
                    <p class="app-notification__meta">{{\Carbon\Carbon::createFromTimeStamp(strtotime($newOrder->created_at))->diffForHumans()}}</p>
                  </div>
                </a>
              </li>
          @endforeach
        </div>
          <li class="app-notification__footer"><a href="{{route('admin.orders.index')}}">See all Orders.</a></li>
      </ul>
  </li>
  <!-- User Menu-->
  <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
      <ul class="dropdown-menu settings-menu dropdown-menu-right">
        <li><a class="dropdown-item" href="{{route('home')}}" target="_blank"><i class="fa fa-globe fa-lg"></i> Visit Site</a></li>
        <li><a class="dropdown-item" href="{{route('admin.settings')}}"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
        <li><a class="dropdown-item" href="{{route('admin.profile')}}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
        <li><a class="dropdown-item" href="{{route('admin.logout')}}"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
    </ul>
</li>
</ul>
</header>