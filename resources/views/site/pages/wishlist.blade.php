@extends('site.app')
@section('title', 'Shopping Cart')
@section('content')
<section class="section-pagetop bg-primary">
	<div class="container clearfix">
		<p class="text-white text-center w-100 mb-0"><i class="fa fa-heart wishlist-icon"></i></p>
		<h3 class="title-page text-uppercase text-center">Wishlist</h3>
	</div>
</section>
<section class="section-content bg padding-y border-top">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@if(Session::has('message'))
				<p class="alert alert-success">{{ Session::get('message') }}</p>
				@elseif(Session::has('error'))
				<p class="alert alert-danger">{{ Session::get('error') }}</p>
				@endif
			</div>
		</div>
		<div class="row">
			<main class="col-sm-12">
				@if($wishlist->count()<=0)
				<p class="alert alert-warning">Your wishlist is empty</p>
				@else
				<div class="card mt-2">
					<table class="table table-hover">
						<thead class="text-muted">
							<tr>
								<th scope="col" width="15"></th>
								<th scope="col" width="100"></th>
								<th scope="col">Product</th>
								<th scope="col">Price</th>
								<th scope="col">Stock Status</th>
								<th scope="col" class="text-center" width="150">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($wishlist as $wishListProduct )
							@php
								if($wishListProduct->path !=null){
									$imgUrl = $wishListProduct->path.'\\'.json_decode($wishListProduct->thumbs)->productThumb;
								}else{
									$imgUrl = '//via.placeholder.com/176';
								}
							@endphp
								<tr>
									<td class="d-flex">
										<a href="#" data-id = "{{$wishListProduct->id}}" class="delete-btn btn btn-ouline-danger d-inline"><small><i class="fa fa-trash text-danger"></i></small></a>
									</td>
									<td>
										<img class="w-100 wishlist-image" src="{{$imgUrl}}" alt="">
									</td>
									<td>
										{{$wishListProduct->name}}
									</td>
									<td>
										@if($wishListProduct->special_price!=$wishListProduct->price)
										<var class="price text-success">
											<span class="currency">{{ config('settings.currency_symbol') }}</span><span class="num" id="productPrice">{{ $wishListProduct->special_price }}</span>
											<del class="price-old"> {{ config('settings.currency_symbol') }}{{ $wishListProduct->price }}</del>
										</var>
										@else
										<var class="price text-danger">
											<span class="currency">{{ config('settings.currency_symbol') }}</span><span class="num" id="productPrice">{{ $wishListProduct->price }}</span>
										</var>
										@endif
									</td>
									<td>
										{!! $wishListProduct->quantity>0 ? '<span class="text-success">In Stock</span>': '<span class="text-danger">Out of Stock</span>' !!}
									</td>
									<td class="text-center">
										<small>Added on: {{date('M d, Y', strtotime($wishListProduct->created_at))}}</small>
										<a href="{{ route('product.show', $wishListProduct->slug) }}" class="badge badge-pill badge-success px-4 py-2">Add to cart</a>
										
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<p class="text-right">
					<a href="{{route('wishlist.clear')}}" class="badge badge-pill badge-danger px-4 py-2 mt-4">Clear Wishlist</a>
				</p>
				@endif
			</main>
		</div>
	</div>
</section>
@include('site.partials.confirmmodal2')


@push('custom-scripts')
<script>
	$(".delete-btn").click(function(event){
		event.preventDefault();
		$("#confirm-modal").modal('show');
		var id = $(this).data('id');
		$("#proceed-btn").on('click',function(){
			document.location.href="{!! route('wishlist.remove', 'wid') !!}".replace("wid", id);
		});
	});	
</script>
@endpush

@stop

