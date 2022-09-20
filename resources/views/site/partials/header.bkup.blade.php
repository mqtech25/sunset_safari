@php
	$searchCategories = \App\Models\Category::select('id','name')->where('id','!=',1)->orderby('name','asc')->get();
@endphp
<!--========== Section-header start ==========-->
<header class="section-header">

	<nav class="navbar navbar-dark navbar-expand p-0 bg-primary">
		<div class="container">
			<ul class="navbar-nav d-none d-md-flex mr-auto">
				<li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
				@if(config('settings.blog_enabled') == 1)
				<li class="nav-item"><a class="nav-link" href="{{route('blog')}}">Blog</a></li>
				@endif
				<li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Contact</a></li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item"><a href="tel:{{config('settings.default_phone_number')}}" class="nav-link"> <i class="fas fa-phone"></i> {{config('settings.default_phone_number')}} </a></li>
			</ul> <!-- list-inline //  -->
		</div> <!-- navbar-collapse .// -->
		<!-- container //  -->
	</nav> <!-- header-top-light.// -->

	<section class="header-main border-bottom">
		<div class="container">
			<div class="row align-items-center">

				<div class="col-lg-2 col-6">
					<a href="{{ url('/') }}">
						<img class="brand-wrap" width="100%" src="{{ asset('storage/'.config('settings.site_logo')) }}" alt="logo">
					</a>  <!-- brand-wrap.// -->
				</div>
				<div class="col-lg-6 col-12 col-sm-12">
					<form action="{{route('search')}}" class="search" method="get">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<select class="form-control" id="search-categories" name="search_category">
									<option value="all">All Categories</option>
									@foreach ($searchCategories as $s_cat)
										<option value="{{$s_cat->id}}">{{$s_cat->name}}</option>
									@endforeach
								</select>
							</div>
							<input type="text" class="form-control" id="search_keyword" name="search_keyword" placeholder="Search">
							<div class="input-group-append">
								<button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
							</div>
							
						</div>
					</form> <!-- search-wrap .end// -->
				</div> <!-- col.// -->
				<div class="col-lg-4 col-sm-6 col-12">
					<div class="widgets-wrap float-md-right">
						{{-- <div class="widget-header  mr-1">
							<a href="{{ route('checkout.cart') }}" title ="Cart" class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></a>
							@if($cartCount>0)
								<span class="badge badge-pill badge-danger notify">{{ $cartCount }}</span>
							@endif
						</div> --}}
						<div class="dropdown show widget-header mr-1">
							<a class="icon icon-sm rounded-circle border " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-shopping-cart">
									@if($cartCount>0)
										<span class="badge badge-pill badge-danger notify">{{ $cartCount }}</span>
									@endif
								</i>
								
							</a>
							<div id="cart-droup-down" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<table class="table table-hover shopping-cart-wrap">
								@forelse (\Cart::getContent() as $citem)
									{{-- <a class="dropdown-item" href="#">{{$citem->name}}</a> --}}
								<tr>
									<td>
										<h6 class="title text-truncate"> {{ Str::words($citem->name, 20) }}</h6>
									</td>
									<td>{{ $citem->quantity }}</td>

									<td>
										<var class="price-wrap">
										<var class="price">{{ config('settings.currency_symbol').$citem->price }}</var>
											<small class="text-muted">each</small>
										</var>
									</td>
									<td>
										<var class="price-wrap">
										<var class="price">{{ config('settings.currency_symbol').$citem->price*$citem->quantity }}</var>
										</var>
									</td>
									<td class="text-right" width="20px">
										<a href="{{ route('checkout.cart.remove', $citem->id) }}" class="btn btn-ouline-danger"><i class="fa fa-times"></i></a>
									</td>
								</tr>
								@empty
									<tr>
										<td><span class="text-danger p-3">Your Cart is empty</span></td>
									</tr>
								@endforelse
								</table>
								@if($cartCount>0)
									<p class="p-0 m-0 text-right"><a href="{{route('checkout.cart')}}" class="btn btn-primary mr-2">Cart</a><a href="{{route('checkout.index')}}" class="btn btn-success mr-2">Checkout</a></p>
								@endif
							</div>
						</div>
						<div class="widget-header  mr-1">
							<a href="{{ route('wishlist.index') }}" title ="Wishlist" class="icon icon-sm rounded-circle border"><i class="fa fa-heart"></i></a>
							@if(\Auth::user() !=null && \Auth::user()->wishlist()->count()>0)
								<span class="badge badge-pill badge-danger notify">{{ \Auth::user()->wishlist()->count() }}</span>
							@endif
						</div>
						<div class="widget-header icontext">
							<a href="{{route('site.customer.profile')}}" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
							<div class="text ml-2">
								<span class="text-muted">Welcome!</span>
								@guest
								<div> 
									<a href="{{ url('login') }}">Sign in</a> |  
									<a href="{{ url('register') }}"> Register</a>
								</div>
								@else
								<ul class="navbar-nav ml-auto">
									<li class="nav-item dropdown">
										<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
											{{ Auth::user()->primaryAddress->first_name }} <span class="caret"></span>
										</a>
										<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
											<a class="dropdown-item" href="{{ route('logout') }}"
											onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
											{{ __('Logout') }}
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
									</div>
								</li>
							</ul>
							@endguest
						</div>
					</div>
				</div> <!-- widgets-wrap.// -->
			</div> <!-- col.// -->
		</div> <!-- row.// -->
	</div> <!-- container.// -->
</section> <!-- header-main .// -->
</header>
<!--==========Section-header end//==========-->
