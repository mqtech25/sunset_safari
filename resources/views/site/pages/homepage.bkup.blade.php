@extends('site.app')
@section('title', 'Homepage')

@section('content')
<style>
	.user-rating-top-dynamic{
        background-image: url('{{asset("storage/payment_img/star-bg.png")}}');
    }
    .user-rating-back-dynamic{
        background-image: url('{{asset("storage/payment_img/star-bg-dark.png")}}');
    }
</style>

<!--========= Banner-section start =========-->
<section class="section-intro padding-y-sm">
	<div class="container">

		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
				@php
					$banners = \App\Models\Banner::where('banner_status', 1)->orderByRaw('banner_order','Desc')->get();
					$active ='active';
					// dd($banners);
				@endphp

				@foreach ($banners as $item)
					<div class="carousel-item {{$active}}">
						<img src="{{ asset('storage/'.$item->banner_image)}}" alt="...">
						<div class="carousel-caption d-none d-md-block">
							<h5>{{$item->banner_title}}</h5>
							<p>{{ $item->banner_subtitle}}</p>
						</div>
					</div>
					@php $active =''; @endphp
				@endforeach
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>

	</div> <!-- container //-->
</section>
<!--========== Banner-section end//==========-->

<!--========== Feature-Category-section start==========-->
<section class="section-content padding-y-sm">
	<div class="container">
		<article class="card card-body">

			<div class="row">
				@forelse ($categories as $category)
					<div class="col-md-3 d-flex justify-content-center">	
						<a href="{{route('category.show', $category->slug)}}">
							<figure class="item-feature w-100">
								<p class="text-center mb-0"><img class="feature-category w-100" src="{{asset('storage/'.$category->image)}}" alt=""></p>
								<figcaption>
									<h5 class="title text-center">{{$category->name}}</h5>
								</figcaption>
							</figure>
						</a>
					</div>
				@empty
					<p>No Featured Categories Available</p>
				@endforelse
			</div>
		</article>

	</div> <!-- container .//  -->
</section>
<!--========== Feature-Category-section end// ==========-->

<!--========== Popular-products-section start ==========-->
<section class="section-content">
	<div class="container">
		<header class="section-heading">
			<h3 class="section-title">Featured Products</h3>
		</header><!-- sect-heading -->
		<div class="row">
			@forelse($featuredProducts as $featuredProduct) 
				@php 
					$productImageUrl="//via.placeholder.com/370x300";
					if($featuredProduct->images()->count()>0 && $featuredProduct->mainProductThumbImage() !=null){
						$productImageUrl = $featuredProduct->mainProductThumbImage();
						// dd($productImageUrl);
					}
				@endphp
				<div class="col-md-3">
					<div href="#" class="card card-product-grid">
						<a href="{{route('product.show',$featuredProduct->slug)}}" class="img-wrap"> @if($featuredProduct->special_price!=$featuredProduct->price)<div class="ribbon"><span>SALE</span></div>@endif<img class="product-image" src="{{$productImageUrl}}"> </a>
						<figcaption class="info-wrap p-2">
							<a href="{{route('product.show',$featuredProduct->slug)}}" class="title">{{$featuredProduct->name}}</a>
							@php
								$rattingPercentage = 0;
								if($featuredProduct->rattings->count()>0){
									$rattingPercentage = (($featuredProduct->rattings->sum('ratting'))/($featuredProduct->rattings->count()*5))*100;
								}
							@endphp
							<div class="rating-wrap">
								<div class="user-rating-back-dynamic">
									<div class="user-rating-top-dynamic" style="width: {{$rattingPercentage}}% !important"></div>
								</div>
								<span class="label-rating text-muted"> {{$featuredProduct->rattings->count()}} reviews</span>
							</div>
							@if($featuredProduct->special_price!=$featuredProduct->price)
								<div class="price mt-1"><del class="price-old">{{config('settings.currency_symbol').$featuredProduct->price}}</del> {{config('settings.currency_symbol').$featuredProduct->special_price}}</div>
							@else
								<div class="price mt-1">{{config('settings.currency_symbol').$featuredProduct->price}}</div>
							@endif
						</figcaption>
						<figcaption class="info-wrap p-2">
							@if($featuredProduct->quantity>0)
								@if($featuredProduct->attributes->count()==0)
									<a href="{{ route('direct.add.cart', $featuredProduct->id)}}" class="btn btn-success w-100">Add to cart</a>
								@else
									<a href="{{route('product.show',$featuredProduct->slug)}}" class="btn btn-danger w-100">Select Options</a>
								@endif
							@else
								<p class="text-center text-danger">OUT OF STOCK</p>
							@endif
						</figcaption>
					</div>
				</div>
			@empty
				<p>No Featured products available.</p>
			@endforelse
		</div>
	</div> 
</section>
<!--========== Popular-products-section end// ==========-->




<!--========== New-arrived-section start ==========-->
<section class="section-content">
	<div class="container">

		<header class="section-heading">
			<h3 class="section-title">New arrived</h3>
		</header>

		<div class="row">
			@forelse($newlyArrivedProducts as $newlyArrivedProduct) 
				@php 
					$productImageUrl="//via.placeholder.com/370x300";
					if($newlyArrivedProduct->images()->count()>0 && $newlyArrivedProduct->mainProductThumbImage() !=null){
						$productImageUrl = $newlyArrivedProduct->mainProductThumbImage();
						// dd($productImageUrl);
					}
				@endphp
				<div class="col-md-3">
					<div href="#" class="card card-product-grid">
						<a href="{{route('product.show',$newlyArrivedProduct->slug)}}" class="img-wrap"> @if($newlyArrivedProduct->special_price!=$newlyArrivedProduct->price)<div class="ribbon"><span>SALE</span></div>@endif<img class="product-image" src="{{$productImageUrl}}"> </a>
						<figcaption class="info-wrap p-2">
							<a href="{{route('product.show',$newlyArrivedProduct->slug)}}" class="title">{{$newlyArrivedProduct->name}}</a>
							@php
								$rattingPercentage = 0;
								if($newlyArrivedProduct->rattings->count()>0){
									$rattingPercentage = (($newlyArrivedProduct->rattings->sum('ratting'))/($newlyArrivedProduct->rattings->count()*5))*100;
								}
							@endphp
							<div class="rating-wrap">
								<div class="user-rating-back-dynamic">
									<div class="user-rating-top-dynamic" style="width: {{$rattingPercentage}}% !important"></div>
								</div>
								<span class="label-rating text-muted"> {{$newlyArrivedProduct->rattings->count()}} reviews</span>
							</div>
							@if($newlyArrivedProduct->special_price!=$newlyArrivedProduct->price)
								<div class="price mt-1"><del class="price-old">{{config('settings.currency_symbol').$newlyArrivedProduct->price}}</del> {{config('settings.currency_symbol').$newlyArrivedProduct->special_price}}</div>
							@else
								<div class="price mt-1">{{config('settings.currency_symbol').$newlyArrivedProduct->price}}</div>
							@endif
						</figcaption>
						<figcaption class="info-wrap p-2">
							@if($newlyArrivedProduct->quantity>0)
								@if($newlyArrivedProduct->attributes->count()==0)
									<a href="{{ route('direct.add.cart', $newlyArrivedProduct->id)}}" class="btn btn-success w-100">Add to cart</a>
								@else
									<a href="{{route('product.show',$newlyArrivedProduct->slug)}}" class="btn btn-danger w-100">Select Options</a>
								@endif
							@else
								<p class="text-center text-danger">OUT OF STOCK</p>
							@endif
						</figcaption>
					</div>
				</div>
			@empty
				<p>No Featured products available.</p>
			@endforelse
		</div>

	</div>
</section>
<!--========== New-arrived-section end// ==========-->



<!--========== Recommended-section start ==========-->
<section class="section-content padding-bottom-sm">
	<div class="container">

		<header class="section-heading">
			<a href="#" class="btn btn-outline-primary float-right">See all</a>
			<h3 class="section-title">Recommended</h3>
		</header><!-- sect-heading -->

		<div class="row">
			@forelse($recommendedProducts as $recommendedProduct) 
				@php 
					$productImageUrl="//via.placeholder.com/370x300";
					if($recommendedProduct->images()->count()>0 && $recommendedProduct->mainProductThumbImage() !=null){
						$productImageUrl = $recommendedProduct->mainProductThumbImage();
						// dd($productImageUrl);
					}
				@endphp
				<div class="col-md-3">
					<div href="#" class="card card-product-grid">
						<a href="{{route('product.show',$recommendedProduct->slug)}}" class="img-wrap"> @if($recommendedProduct->special_price!=$recommendedProduct->price)<div class="ribbon"><span>SALE</span></div>@endif<img class="product-image" src="{{$productImageUrl}}"> </a>
						<figcaption class="info-wrap p-2">
							<a href="{{route('product.show',$recommendedProduct->slug)}}" class="title">{{$recommendedProduct->name}}</a>
							@php
								$rattingPercentage = 0;
								if($recommendedProduct->totalrattings>0){
									$rattingPercentage = (($recommendedProduct->totalrattings)/($recommendedProduct->totalusers*5))*100;
								}
							@endphp
							<div class="rating-wrap">
								<div class="user-rating-back-dynamic">
									<div class="user-rating-top-dynamic" style="width: {{$rattingPercentage}}% !important"></div>
								</div>
								<span class="label-rating text-muted"> {{$recommendedProduct->rattings->count()}} reviews</span>
							</div>
							@if($recommendedProduct->special_price!=$recommendedProduct->price)
								<div class="price mt-1"><del class="price-old">{{config('settings.currency_symbol').$recommendedProduct->price}}</del> {{config('settings.currency_symbol').$recommendedProduct->special_price}}</div>
							@else
								<div class="price mt-1">{{config('settings.currency_symbol').$recommendedProduct->price}}</div>
							@endif
						</figcaption>
						<figcaption class="info-wrap p-2">
							@if($recommendedProduct->quantity>0)
								@if($recommendedProduct->attributes->count()==0)
									<a href="{{ route('direct.add.cart', $recommendedProduct->id)}}" class="btn btn-success w-100">Add to cart</a>
								@else
									<a href="{{route('product.show',$recommendedProduct->slug)}}" class="btn btn-danger w-100">Select Options</a>
								@endif
							@else
								<p class="text-center text-danger">OUT OF STOCK</p>
							@endif
						</figcaption>
					</div>
				</div>
			@empty
				<p>No Featured products available.</p>
			@endforelse
		</div>

	</div> <!-- container .//  -->
</section>
<!--========== Recommended-section end// ==========-->

<!--========== Feature-section start==========-->
<section class="section-content padding-y-sm">
	<div class="container">
		<article class="card card-body">

			<div class="row">
				<div class="col-md-4">	
					<figure class="item-feature">
						<span class="text-primary"><i class="fa fa-2x fa-truck"></i></span>
						<figcaption class="pt-3">
							<h5 class="title">Fast delivery</h5>
							<p>Dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore </p>
						</figcaption>
					</figure> <!-- iconbox // -->
				</div><!-- col // -->
				<div class="col-md-4">
					<figure class="item-feature">
						<span class="text-primary"><i class="fa fa-2x fa-landmark"></i></span>	
						<figcaption class="pt-3">
							<h5 class="title">Creative Strategy</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							</p>
						</figcaption>
					</figure> <!-- iconbox // -->
				</div><!-- col // -->
				<div class="col-md-4">
					<figure class="item-feature">
						<span class="text-primary"><i class="fa fa-2x fa-lock"></i></span>
						<figcaption class="pt-3">
							<h5 class="title">High secured </h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							</p>
						</figcaption>
					</figure> <!-- iconbox // -->
				</div> <!-- col // -->
			</div>
		</article>

	</div> <!-- container .//  -->
</section>
<!--========== Feature-section end// ==========-->

<!--=========== Brands-section start ==========-->
<section class="section-name bg padding-y-sm">
	<div class="container">
		<header class="section-heading">
			<h3 class="section-title">Our Brands</h3>
		</header><!-- sect-heading -->

		<div class="row">
			@forelse($brands as $brand)
				<div class="col-md-2 col-6">
					<figure class="box item-logo">
						<a href="{{ route('brand.show', $brand->slug) }}"><img class="brand-image" src="{{$brand->logo == null ? 'https://via.placeholder.com/120x120?text='.$brand->name : asset('storage/'.$brand->logo)}}"></a>
						<figcaption class="border-top pt-2 text-center">{{$brand->products->count()}} Products</figcaption>
					</figure> 
				</div> 
			@empty
				<p>No brands available.</p>
			@endforelse
		</div> 
	</div>
</section>
<!--========== Brands-section end// ==========-->


@stop