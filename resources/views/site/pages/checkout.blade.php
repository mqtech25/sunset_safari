@extends('site.app')
@section('title', 'Checkout')
@section('content')
<section class="section-pagetop bg-primary">
	<div class="container clearfix">
		<h2 class="title-page">Checkout</h2>
	</div>
</section>
<section class="section-content bg-padding-y">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@if(Session::has('Error'))
				<p class="alert alert-danger">{{ Session::get('Error') }}</p>
				@endif
			</div>
		</div>
		<form action="{{ route('checkout.place.order') }}" method="POST" role="form" name="checkoutform">
			@csrf

			<div class="row">
				<div class="col-md-8">
					<div class="card mt-3">
						<header class="card-header">
							<h4 class="card-title mt-2">Billing Details</h4>
						</header>
						<article class="card-body">
							<div class="form-row">
								<div class="col-11">
									<div class="form-group">
										<select class="form-control" name="billing_address" id="billing_address">
											@if(\Auth::user()->address->count() > 0)
												<option value="0">Choose Address</option>
											@endif
											@forelse (\Auth::user()->address as $address)
												<option value="{{collect($address)->except(['id','user_id','is_primary','created_at','updated_at'])}}">{{$address->getFormatedAddress()}}</option>
											@empty
												<option value="0">No Saved Addresses</option>
											@endforelse
										</select>
									</div>
								</div>
								<div class="col-1">
									<div class="form-group">
										<a class="btn btn-success form-control" id="addAddressBtn">+</i></a>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col form-group">
									<label for="">First Name</label>
									<input required type="text" class="form-control" id="first_name" name="first_name" value="{{Auth::user()->primaryAddress->first_name}}">
								</div>

								<div class="col form-group">
									<label for="last_name">Last Name</label>
									<input required type="text" class="form-control" id="last_name" name="last_name" value="{{Auth::user()->primaryAddress->last_name}}">
								</div>
							</div>
							<div class="form-group">
								<label for="address">Address</label>
								<input required type="text" class="form-control" id="address" name="address" value="{{Auth::user()->primaryAddress->address}}">
							</div>
							<div class="form-group">
								<label for="address">Address Line 2</label>
								<input type="text" class="form-control" id="addressline2" name="addressline2" value="{{Auth::user()->primaryAddress->addressline2}}">
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="post_code">Zip Code</label>
									<input required type="text" class="form-control" id="post_code" name="post_code"  value="{{Auth::user()->primaryAddress->zip_code}}">
								</div>
								<div class="lform-group col-md-6">
									<label for="phone_number">Phone Number</label>
									<input required type="text" class="form-control" id="phone_number" name="phone_number" value="{{Auth::user()->primaryAddress->phone}}">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="country">Country</label>
									{{-- <input required type="text" class="form-control" id="country" name="country"  value="{{Auth::user()->primaryAddress->country}}"> --}}
									<input type="hidden" name="country" id="country" value="{{Auth::user()->primaryAddress->country}}">
									<select id="country_options" class="form-control @error('country') is-invalid @enderror" name="country_options">
										<option> Choose...</option>
										@foreach ($countries as $country)
											<option value="{{$country->id}}">{{$country->name}}</option>
										@endforeach
									</select>
									@error('country')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="form-group col-md-4">
									<label for="state">State</label>
									{{-- <input required type="text" class="form-control" id="state" name="state" value="{{Auth::user()->primaryAddress->state}}"> --}}
									<select name="state" id="state" class="form-control">
										<option value="{{Auth::user()->primaryAddress->state}}">{{Auth::user()->primaryAddress->state}}</option>
									</select>
								</div>
								<div class="form-group col-md-4">
									<label for="city">City</label>
									<input required type="text" class="form-control" id="city" name="city" value="{{Auth::user()->primaryAddress->city}}">
								</div>
							</div>
							<div class="form-group">
								<label for="email_address">Email Address</label>
								<input required type="email" class="form-control" name="email" value="{{Auth::user()->email}}">
							</div>
							<div class="form-group">
								<input type="checkbox" class="" name="ship_different_chk" id="ship_different_chk">
								<label for="ship_different">Ship to different address?</label>
							</div>
							<div id="diff_shipping_form">
								<div class="form-row">
									<div class="col-11">
										<div class="form-group">
											<select class="form-control" name="addresses" id="addresses">
												@if(\Auth::user()->address->count() > 0)
													<option value="0">Choose Address</option>
												@endif
												@forelse (\Auth::user()->address as $address)
													<option value="{{collect($address)->except(['id','user_id','is_primary','created_at','updated_at'])}}">{{$address->getFormatedAddress()}}</option>
												@empty
													<option value="0">No Saved Addresses</option>
												@endforelse
											</select>
										</div>
									</div>
									<div class="col-1">
										<div class="form-group">
											<a class="btn btn-success form-control" id="addAddressBtn">+</i></a>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col form-group">
										<label for="">First Name</label>
										<input type="text" class="form-control" name="shipping_first_name" id="shipping_first_name" value="">
									</div>

									<div class="col form-group">
										<label for="shipping_last_name">Last Name</label>
										<input type="text" class="form-control" name="shipping_last_name" id="shipping_last_name" value="">
									</div>
								</div>
								<div class="form-group">
									<label for="shipping_address">Address</label>
									<input type="text" class="form-control" name="shipping_address" id="shipping_address" value="">
								</div>
								<div class="form-group">
									<label for="shipping_addressline2">Address Line 2</label>
									<input type="text" class="form-control" name="shipping_addressline2" id="shipping_addressline2" value="">
								</div>

								
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="shipping_post_code">Zip Code</label>
										<input type="text" class="form-control" name="shipping_post_code"  value="" id="shipping_post_code">
									</div>
									<div class="lform-group col-md-6">
										<label for="shipping_phone_number">Phone Number</label>
										<input type="text" class="form-control" name="shipping_phone_number" id="shipping_phone_number" value="">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-4">
										<label for="country">Country</label>
										<input type="hidden" name="shipping_country" id="shipping_country">
										<select id="shipping_country_options" class="form-control @error('shipping_country') is-invalid @enderror" name="shipping_country_options">
											<option> Choose...</option>
											@foreach ($countries as $country)
												<option value="{{$country->id}}">{{$country->name}}</option>
											@endforeach
										</select>
										@error('shipping_country')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group col-md-4">
										<label for="shipping_state">state</label>
										<select id="shipping_state" class="form-control @error('shipping_state') is-invalid @enderror" name="shipping_state"></select>
										@error('state')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group col-md-4">
										<label for="shipping_city">City</label>
										<input type="text" class="form-control" name="shipping_city" value="" id="shipping_city">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="order_note">Order Note</label>
								<textarea name="notes" id="" cols="30" rows="6" class="form-control">N/A</textarea>
							</div>
						</article>
					</div>
				</div>

				<div class="col-md-4">
					<div class="row">
						<div class="col-md-12">
							<div class="card mt-3">
								<header class="card-header">
									<h4 class="card-title mt-2">Your Order</h4>
								</header>
								<article class="card-body">
									<dl class="dlist-align">
										<dt>Sub Total:</dt>
										<dd class="text-right h5 b"> {{ config('settings.currency_symbol')}} {{\Cart::getSubTotal()}}</dd>
									</dl>
									@if(session()->get("cart_total_discount") != null)
									<dl class="dlist-align">
										<dt>Discount:</dt>
										<dd class="text-right h5 b"> {{ config('settings.currency_symbol')}} {{ session()->get("cart_total_discount")}}</dd>
									</dl>
									@endif
									@if($shippingData->request_status == 'success')
									<div class="shipping_calc_res">
										<dl class="dlist-align">
											<dt>Shipping:</dt>
											<dd class="text-right h5 b"> {{ config('settings.currency_symbol')}} {{$shippingData->cost}}</dd>
										</dl>
									</div>
									@else
										<div class="shipping_calc_res">
											<hr>
											<p class="text-danger">{{$shippingData->message}}</p>
										</div>
									@endif
									<div id="shipping_section">
										<dl class="dlist-align">
											<dt>Shipping:</dt>
											<dd class="text-right h5 b"> {{ config('settings.currency_symbol')}} <span class="ship_cost"></span></dd>
										</dl>
										<div class="msg"></div>
									</div>
									<hr>
									<dl class="dlist-align">
										<dt>Order Total:</dt>
										@php
											$order_total = \Cart::getSubTotal();
											if(session()->get("cart_total_discount") != null){
												$order_total = $order_total-session()->get("cart_total_discount");
											}
											if(session()->get("shipping_amount") != null){
												$order_total = $order_total+session()->get("shipping_amount");
											}
										@endphp
										<dd class="text-right h5 b"> {{ config('settings.currency_symbol')}} {{ $order_total}}</dd>
									</dl>
								</article>
							</div>

							<div class="card mt-3">
								<header class="card-header">
									<h4 class="card-title mt-2">Choose a way to pay</h4>
								</header>
								<article class="card-body">
									<div class="radio text-center">
										<div class="paymentWrap">
											<div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
												<label class="btn paymentMethod mr-2 active">
													<div class="method paypal" style="background-image: url('{{asset('/storage/payment_img/paypal.png')}}')"></div>
													<input type="radio" name="payment_method" value="Paypal Payment" checked> 
												</label>
												<label class="btn paymentMethod">
													<div class="method square" style="background-image: url('{{asset('/storage/payment_img/square.png')}}')"></div>
													<input type="radio" name="payment_method" value="Square Payment"> 
												</label>
											
											</div>        
										</div>
									</div>
								</article>
							</div>
						</div>

						<div class="col-md-12 mt-4">
							<button type="submit" class="subscribe btn btn-success btn-lg btn-block">Place Order</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>
<!-- new shipping address model -->
<div class="modal fade" id="shippin_address_modal" tabindex="-1" role="dialog" aria-labelledby="shippin_address_modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="shippin_address_modalTitle">Shipping Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="{{route('save.address')}}" method="POST" id="saveAddressForm">
		@csrf
		<input type="hidden" name="add_shipping_user_id" value="{{\Auth::user()->id}}">
		  <div class="modal-body">
			<div class="form-row">
				<div class="col form-group">
					<label for="add_shipping_first_name">First Name</label>
					<input type="text" class="form-control" name="add_shipping_first_name" value="" required>
				</div>

				<div class="col form-group">
					<label for="add_shipping_last_name">Last Name</label>
					<input type="text" class="form-control" name="add_shipping_last_name" value="" required>
				</div>
			</div>
			<div class="form-group">
				<label for="add_shipping_address">Address</label>
				<input type="text" class="form-control" name="add_shipping_address" value="" required>
			</div>
			<div class="form-group">
				<label for="add_shipping_address">Address Line 2</label>
				<input type="text" class="form-control" name="add_shipping_addressline2" value="" required>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="add_shipping_post_code">Zip Code</label>
					<input type="text" class="form-control" name="add_shipping_post_code"  value="" required>
				</div>
				<div class="lform-group col-md-6">
					<label for="add_shipping_phone_number">Phone Number</label>
					<input type="text" class="form-control" name="add_shipping_phone_number" value="" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="add_shipping_country">Country</label>
					<input type="hidden" name="add_shipping_country" id="add_shipping_country" required>
					<select id="add_shipping_country_options" class="form-control @error('country') is-invalid @enderror" name="add_shipping_country_options">
						<option> Choose...</option>
						@foreach ($countries as $country)
							<option value="{{$country->id}}">{{$country->name}}</option>
						@endforeach
					</select>
					@error('country')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="form-group col-md-4">
					<label for="add_shipping_state">State</label>
					<select required id="add_shipping_state" class="form-control @error('state') is-invalid @enderror" name="add_shipping_state"></select>
					@error('state')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="form-group col-md-4">
					<label for="city">City</label>
					<input required type="text" class="form-control" name="add_shipping_city" value="">
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
			<button type="submit" class="btn btn-success">SAVE</button>
		</div>
	  </form>
    </div>
  </div>
</div>
@push('custom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
	$(document).ready(function() {
		$("#saveAddressForm").validate();
		$("#checkoutform").validate();

		$("#country_options option:contains(" + "{{Auth::user()->primaryAddress->country}}" + ")").attr('selected', 'selected');
	});
	$("#ship_different_chk").change(function(){
		$("#diff_shipping_form").toggle(500);

		if(this.checked){
			$('#shipping_first_name').attr('required','required');
			$('#shipping_last_name').attr('required','required');
			$('#shipping_address').attr('required','required');
			$('#shipping_post_code').attr('required','required');
			$('#shipping_phone_number').attr('required','required');
			$('#shipping_city').attr('required','required');
			$('#shipping_country').attr('required','required');
			$('#shipping_state').attr('required','required');
		}else{
			$('#shipping_first_name').removeAttr('required');
			$('#shipping_last_name').removeAttr('required');
			$('#shipping_address').removeAttr('required');
			$('#shipping_post_code').removeAttr('required');
			$('#shipping_phone_number').removeAttr('required');
			$('#shipping_city').removeAttr('required');
			$('#shipping_country').removeAttr('required');
			$('#shipping_state').removeAttr('required');
		}
	});

	$("#addAddressBtn").on('click', function(){
		$("#shippin_address_modal").modal('show');
	});

	$("#billing_address").change(function(){
		var val = $(this).val();
		var data = JSON.parse(val);
		var countryName = data.country;
		var cart_weight = "{{session()->get('cart_weight')}}";
		if($('#ship_different_chk').prop('checked') != true){
			$.ajax({
				type: "post",
				url: "{{route('shipping.cart.calculate')}}",
				data: {name:countryName, cart_weight: cart_weight, _token:'{{csrf_token()}}'},
				success: function (data) {
					data = JSON.parse(data);
					if(data.request_status == 'fail'){
						$("#shipping_section .msg").show();
						$("#shipping_section .dlist-align").hide();
						$(".shipping_calc_res").hide();
						$("#shipping_section .msg").html("<hr><span class='text-danger'>"+data.message+"</span>");
					}else{
						$("#shipping_section .msg").hide();
						$("#shipping_section .dlist-align").show();
						$(".shipping_calc_res").hide();
						$("#shipping_section .dlist-align .ship_cost").text(data.cost);
					}
				}
			});
		}


		$('#first_name').val(data.first_name);
		$('#last_name').val(data.last_name);
		$('#address').val(data.address);
		$('#addressline2').val(data.addressline2);
		$('#post_code').val(data.zip_code);
		$('#phone_number').val(data.phone);
		$('#city').val(data.city);
		$("#country").val(data.country);
		$("#country_options option:contains(" + data.country + ")").attr('selected', 'selected');
		$("#state").html('<option>'+data.state+'</option>');
	});

	$("#addresses").change(function(){
		var val = $(this).val();
		var data = JSON.parse(val);
		var countryName = data.country;
		var cart_weight = "{{session()->get('cart_weight')}}";
		
		$.ajax({
            type: "post",
            url: "{{route('shipping.cart.calculate')}}",
            data: {name:countryName, cart_weight: cart_weight, _token:'{{csrf_token()}}'},
            success: function (data) {
				data = JSON.parse(data);
				if(data.request_status == 'fail'){
					$("#shipping_section .msg").show();
					$("#shipping_section .dlist-align").hide();
					$(".shipping_calc_res").hide();
					$("#shipping_section .msg").html("<hr><span class='text-danger'>"+data.message+"</span>");
				}else{
					$("#shipping_section .msg").hide();
					$("#shipping_section .dlist-align").show();
					$(".shipping_calc_res").hide();
					$("#shipping_section .dlist-align .ship_cost").text(data.cost);
				}
            }
        });


		$('#shipping_first_name').val(data.first_name);
		$('#shipping_last_name').val(data.last_name);
		$('#shipping_address').val(data.address);
		$('#shipping_addressline2').val(data.addressline2);
		$('#shipping_post_code').val(data.zip_code);
		$('#shipping_phone_number').val(data.phone);
		$('#shipping_city').val(data.city);
		$("#shipping_country").val(data.country);
		$("#shipping_country_options option:contains(" + data.country + ")").attr('selected', 'selected');
		$("#shipping_state").html('<option>'+data.state+'</option>');
	});
	

	$("#add_shipping_country_options").change(function(){
        var country_id = $(this).val();
		var country_name = $("#add_shipping_country_options option:selected").text();
        $("#add_shipping_country").val(country_name);
        $.ajax({
            type: "post",
            url: "{{route('getstates')}}",
            data: {id:country_id, _token:'{{csrf_token()}}'},
            success: function (data) { 
                var states = JSON.parse(data);
                var stateOptions ='<option>Choose State</option>';
                states.forEach(function(item,index){
                    stateOptions+= "<option value='"+item.name+"'>"+item.name+"</option>"
                });
				$("#add_shipping_state").html(stateOptions);
            }
		});
		
	});
	
	$("#shipping_country_options").change(function(){
        var country_id = $(this).val();
        var country_name = $("#shipping_country_options option:selected").text();
		var cart_weight = "{{session()->get('cart_weight')}}";
        $("#shipping_country").val(country_name);
        $.ajax({
            type: "post",
            url: "{{route('getstates')}}",
            data: {id:country_id, _token:'{{csrf_token()}}'},
            success: function (data) {
                var states = JSON.parse(data);
                var stateOptions ='<option>Choose State</option>';
                states.forEach(function(item,index){
                    stateOptions+= "<option value='"+item.name+"'>"+item.name+"</option>"
                });
				$("#shipping_state").html(stateOptions);
				
				$.ajax({
					type: "post",
					url: "{{route('shipping.cart.calculate')}}",
					data: {name:country_name, cart_weight: cart_weight, _token:'{{csrf_token()}}'},
					success: function (data) {
						data = JSON.parse(data);
						if(data.request_status == 'fail'){
							$("#shipping_section .msg").show();
							$("#shipping_section .dlist-align").hide();
							$(".shipping_calc_res").hide();
							$("#shipping_section .msg").html("<hr><span class='text-danger'>"+data.message+"</span>");
						}else{
							$("#shipping_section .msg").hide();
							$("#shipping_section .dlist-align").show();
							$(".shipping_calc_res").hide();
							$("#shipping_section .dlist-align .ship_cost").text(data.cost);
						}
					}
				});
            }
        });
	});
	
	$("#country_options").change(function(){
        var country_id = $(this).val();
        var country_name = $("#country_options option:selected").text();
		var cart_weight = "{{session()->get('cart_weight')}}";
        $("#country").val(country_name);
        $.ajax({
            type: "post",
            url: "{{route('getstates')}}",
            data: {id:country_id, _token:'{{csrf_token()}}'},
            success: function (data) {
                var states = JSON.parse(data);
                var stateOptions ='<option>Choose State</option>';
                states.forEach(function(item,index){
                    stateOptions+= "<option value='"+item.name+"'>"+item.name+"</option>"
                });
				$("#state").html(stateOptions);
				
				$.ajax({
					type: "post",
					url: "{{route('shipping.cart.calculate')}}",
					data: {name:country_name, cart_weight: cart_weight, _token:'{{csrf_token()}}'},
					success: function (data) {
						data = JSON.parse(data);
						if(data.request_status == 'fail'){
							$("#shipping_section .msg").show();
							$("#shipping_section .dlist-align").hide();
							$(".shipping_calc_res").hide();
							$("#shipping_section .msg").html("<hr><span class='text-danger'>"+data.message+"</span>");
						}else{
							$("#shipping_section .msg").hide();
							$("#shipping_section .dlist-align").show();
							$(".shipping_calc_res").hide();
							$("#shipping_section .dlist-align .ship_cost").text(data.cost);
						}
					}
				});
            }
        });
    });
</script>
@endpush
@stop