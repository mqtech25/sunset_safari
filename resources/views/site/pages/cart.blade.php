@extends('site.app')
@section('title', 'Shopping Cart')
@section('content')
@php
// dd(\Cart::getContent());
	$cartWeight = 0;
@endphp
<section class="section-pagetop bg-primary">
	<div class="container clearfix">
		<p class="text-white text-center w-100 mb-0"><i class="fa fa-shopping-cart wishlist-icon"></i></p>
		<h3 class="title-page text-uppercase text-center">Cart</h3>
	</div>
</section>
<section class="section-content bg padding-y border-top">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@if(Session::has('message'))
				<p class="alert alert-success">{{ Session::get('message') }}</p>
				@endif
				@if(Session::has('Error'))
				<p class="alert alert-danger">{!! Session::get('Error') !!}</p>
				@endif
			</div>
		</div>
		<div class="row">
			<main class="col-sm-9">
				@if(\Cart::isEmpty())
				<p class="alert alert-warning">Your shopping cart is empty</p>
				@else
				<div class="card p-3">
					<form id="coupon-form">
						@csrf
						<div class="row">
							<div class="col-3 pt-1">
								<span>have a coupon code ?</span>
							</div>
							<div class="col-7">
								<input class="form-control" type="text" id ="coupon_code" name="coupon_code" placeholder="coupon code"/>
							</div>
							<div class="col-2"><input type="submit" class="btn btn-success" value="ADD" id="couponbtn"/></div>
						</div>
					</form>
				</div>

				<div class="card mt-2">
					<table class="table table-hover shopping-cart-wrap">
						<thead class="text-muted">
							<tr>
								<th scope="col">Product</th>
								<th scope="col" width="120">Qunatity</th>
								<th scope="col" width="120">Price</th>
								<th scope="col" width="120">Sub Total</th>
								<th scope="col" class="text-right" width="200">Action</th>
							</tr>
						</thead>
						<tbody>
							<form action="{{route('checkout.cart.update')}}" method="POST">
								@csrf
								@foreach(\Cart::getContent() as $item )
								@php $exp_id = explode("-",$item->id); $cartWeight += floatval(str_replace('&','.',$exp_id[0]) * $item->quantity); @endphp
								<tr>
									<td>
										<figure class="media">
											<figcaption class="media-body">
												<h6 class="title text-truncate"> {{ Str::words($item->name, 20) }}</h6>
												@foreach($item->attributes as $key => $value)
												<dl class="dlist-inline small">
													<dt> {{ ucwords($key) }}</dt>
													<dt> {{ ucwords($value) }} </dt>
												</dl>
												@endforeach
											</figcaption>
										</figure>
									</td>
									<td>
										<input type="number" min="1" class="form-control" value="{{ $item->quantity }}" name="qty[{{ $item->id }}]" id="">
									</td>

									<td>
										<var class="price-wrap">
										<var class="price">{{ config('settings.currency_symbol').$item->price }}</var>
											<small class="text-muted">each</small>
										</var>
									</td>
									<td>
										<var class="price-wrap">
										<var class="price">{{ config('settings.currency_symbol').$item->price*$item->quantity }}</var>
										</var>
									</td>
									<td class="text-right" width="20px">
										<a href="{{ route('checkout.cart.remove', $item->id) }}" class="btn btn-ouline-danger"><i class="fa fa-times"></i></a>
									</td>
								</tr>
								@endforeach
								<tr>
									<td colspan="4"></td>
									<td><input type="submit" class="btn btn-success w-100" name="" id="" value="UPDATE CART"></td>
								</tr>
							</form>
						</tbody>
					</table>
				</div>
				@endif
			</main>
			<aside class="col-sm-3">
				<a href="{{ route('checkout.cart.clear') }}" class="btn btn-danger btn-block mb-4">Clear Cart</a>
				<p class="coupon-alert alert"></p>
				<dt>Sub Total:</dt>
				<dd class="text-right"><strong>{{ config('settings.currency_symbol')}} {{ \Cart::getSubTotal() }}</strong></dd>

				<hr>
				<div class="discount-section">
					<dt>Discount:</dt>
					<dd class="text-right"><strong id="coupon-discount"></strong></dd>
					<hr>
				</div>
				<div class="shipping-section">
					<dt>Shipping:</dt>
					<dd><a href="" id="calculate_shipping_btn">Calculate Shipping</a></dd>
					<div class="form-group" id="shipping_country">
						<select required name="country" id="country" class="form-control">
							@if($countries->count()>0)
								<option value="">Choose Country</option>
							@endif
							@foreach ($countries as $country)
								<option value="{{$country->name}}">{{$country->name}}</option>
							@endforeach
						</select>
					</div>
					<dd class="text-right"><strong id="shipping_amount"></strong></dd>
					<div class="loading_outter">
						<div class="calculation_loading">
							<img src="{{asset("/storage/img/wait.gif")}}" width="30"/>
						</div>
					</div>
					<hr>
				</div>

				<dt>Grand Total:</dt>
				<dd class="text-right"><strong id="grand-total">{{config('settings.currency_symbol')}} {{\Cart::getSubTotal()}}</strong></dd>
				<hr>

				@if(\Cart::getContent()->count()>0)
				<a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg btn-block"> Proceed To Checkout</a>
				@endif
			</aside>
		</div>
	</div>
	{!! session()->put('cart_weight',$cartWeight) !!}
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
	$("#couponbtn").click(function(event){
		event.preventDefault();
		var code = $("#coupon-code").val();
		$.ajax({
            type: "POST",
			url: '{{route('checkout.cart.addcoupon')}}',
			data: $( "#coupon-form" ).serialize()
        }).done(function( data ) {
			data = JSON.parse(data);
			if(data.discount >0){
				$("#coupon-discount").text(data.discount) ;
				$("#grand-total").text(data.total);
				$(".discount-section").slideDown();
				$(".coupon-alert").slideDown();
				$(".coupon-alert").text(data.message);
				$(".coupon-alert").removeClass('alert-danger');
				$(".coupon-alert").addClass('alert-success');
			}else{
				$(".coupon-alert").slideDown();
				$(".discount-section").slideUp();
				$(".coupon-alert").text(data.message);
				$(".coupon-alert").removeClass('alert-success');
				$(".coupon-alert").addClass('alert-danger');
			}
        });
	});


	$("#calculate_shipping_btn").on('click', function(e){
		e.preventDefault();
		$("#shipping_country").toggle(300);
		$("#calculate_shipping_btn").hide();
	});

	$("#shipping_country").on('change',function(){
		var country_name = $("#country option:selected").val();
		$(".loading_outter").show();
		$.ajax({
            type: "post",
            url: "{{route('shipping.cart.calculate')}}",
            data: {name:country_name, cart_weight: '{{$cartWeight}}', _token:'{{csrf_token()}}'},
            success: function (data) {
                data = JSON.parse(data);
				if(data.request_status == 'fail'){
					$("#shipping_amount").html("<span class='text-danger'>"+data.message+"</span>");
					$(".loading_outter").hide();
				}else{
					$("#shipping_amount").html("{{config('settings.currency_symbol')}} "+data.cost);
					$("#grand-total").text(data.cart_total);
					$(".loading_outter").hide();
					$("#shipping_country").hide();
					$("#calculate_shipping_btn").show();
				}
            }
        });
	});


	$(document).ready(function(){
		{!! session()->forget("cart_total_after_discount") !!}
		{!! session()->forget("cart_total_discount") !!}
        {!! session()->forget("discount_code") !!}
        {!! session()->forget("shipping_amount")  !!}
	});
</script>

@stop

