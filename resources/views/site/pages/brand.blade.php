@extends('site.app')
@section('title', $brand->name)
@section('content')
<style>
	.user-rating-top-dynamic{
        background-image: url('{{asset("storage/payment_img/star-bg.png")}}');
    }
    .user-rating-back-dynamic{
        background-image: url('{{asset("storage/payment_img/star-bg-dark.png")}}');
    }
</style>
<section class="section-pagetop bg-primary">
	<div class="container clearfix">
		<h2 class="title-page"><img width="50px" src="{{asset('storage/'.$brand->logo)}}" alt=""> {{ $brand->name }}</h2>
		
	</div>
</section>
<section class="section-content bg padding-y">
	<div class="container">
		<div id="code_prod_complex">
			<div class="row">
				@if(Session::has('message'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Success!</strong> {{ Session::get('message') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@elseif(Session::has('error'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>!</strong> {{ Session::get('error') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
				<div class="col-md-12">
					<div class="row">
							@forelse($products as $product)
							<div class="col-md-4">
								<figure class="card card-product">
									@if ($product->images()->count() > 0 && $product->mainProductThumbImage() !=null)
									<a href="{{route('product.show',$product->slug)}}" class="img-wrap"> @if($product->special_price!=$product->price)<div class="ribbon"><span>SALE</span></div>@endif<img class="product-image" src="{{$product->mainProductThumbImage()}}"> </a>
									@else
									<div class="img-wrap padding-y"><img src="https://via.placeholder.com/176" alt=""></div>
									@endif
									<figcaption class="info-wrap">
										<h4 class="title"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h4>
									</figcaption>
									@php
										$rattingPercentage = 0;
										if($product->rattings->count()>0){
											$rattingPercentage = (($product->rattings->sum('ratting'))/($product->rattings->count()*5))*100;
										}
									@endphp
									<div class="info-wrap">
										<div class="user-rating-back-dynamic">
											<div class="user-rating-top-dynamic" style="width: {{$rattingPercentage}}% !important"></div>
										</div>
										<span class="label-rating text-muted"> {{$product->rattings->count()}} reviews</span>
										@if($product->quantity<1)
											<span class="text-danger d-block font-weight-bold"> Out Of Stock</span>
										@endif
									</div>
									<div class="bottom-wrap">
										<a href="{{route('wishlist.add', $product->id)}}" class="btn btn-sm btn-danger float-right"><i class="fa fa-heart"></i></a>
										<a href="{{route('product.show',$product->slug)}}" class="btn btn-sm btn-success float-right  mr-2"><i class="fa fa-cart-arrow-down"></i></a>
										@if ($product->special_price != $product->price)
										<div class="price-wrap h6">
											<span class="price"> {{ config('settings.currency_symbol').$product->special_price }} </span>
											<del class="price-old"> {{ config('settings.currency_symbol').$product->price }}</del>
										</div>
										@else
										<div class="price-wrap h6">
											<span class="price"> {{ config('settings.currency_symbol').$product->price }} </span>
										</div>
										@endif
									</div>
								</figure>
							</div>
							@empty
							<p>No Products found in {{ $brand->name }}.</p>
							@endforelse
					</div>
					<div class="row">
						{{ $products->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@push('custom-scripts')
	<script>
		$(document).ready(function(){
			var minPrice = Number('{{$brand->products->min("price")}}');
			var maxPrice =Number('{{$brand->products->max("price")}}');
			$("#pricerange").slider({
				min: minPrice,
				max: maxPrice,
				step: 1,
				precision: 0,
				orientation:'horizontal',
				value: [minPrice,maxPrice],
				range:true,
				selection:'before',
				tooltip:'show',
				tooltip_split:true,
				handle:'square',
				ticks: [0,1],
				ticks_snap_bounds: 0,
				ticks_tooltip:true,
				tooltip_position:null,
				scale: 'linear',
				focus: false,

				labelledby:null,
				rangeHighlights: []

			}).on ('slide', function(){
				var val = $("#pricerange").slider("getValue");
				$("#min_price").val(val[0]);
				$("#max_price").val(val[1]);
			});


			$("#sorting_select").change(function(){
				$("#sorting-filters").submit();
			})
		});
	</script>	
@endpush
@stop