@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
    <h1><i class="fa fa-files-o"></i> {{ $pageTitle }}</h1>
</div>
@include('admin.partials.flash')
<div class="row user">
	<div class="col-md-3">
		<div class="tile p-0">
			<ul class="nav nav-tabs user-tabs flex-column">
				<li class="nav-item"> 
                    <a class="nav-link {{ old('active', (isset($coupon)&& $coupon->type=='cart_base') ? 'active' : '' ) }}" href="#cartbase" data-toggle="tab">Cart Base</a>
                </li>
                <li class="nav-item"> 
					<a class="nav-link {{ old('active', (isset($coupon)&& $coupon->type=='product_base') ? 'active' : '' ) }}" href="#productbase" data-toggle="tab">Product Base </a>
				</li>
			</ul>
		</div>
    </div>
    <div class="col-md-9">
        @php
            $details = json_decode($coupon->details);
            // dd($details);
        @endphp
        <div class="tab-content">
            <div class="tab-pane {{ old('active', (isset($coupon)&& $coupon->type=='cart_base') ? 'active' : '' ) }}" id="cartbase">
                <div class="tile">
                    <h3 class="tile-title"> {{__('Add Your Cart Base Coupon')}} </h3>
                    <hr>
                    <div class="tile-body">
                        <form action="{{ isset($coupon) ? route('admin.coupons.update') : route('admin.coupons.store') }}" method="POST">
                        @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="control-label" for="code">{{__('Coupon code')}}</label>
                                        <div class="">
                                            <input type="text" placeholder="{{__('Coupon code')}}" id="code" name="code" class="form-control" required
                                            value='{{ old('code', isset($coupon) ? $coupon->code : '' ) }}'>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label">{{__('Minimum Shopping')}}</label>
                                        <div class="">
                                            <input type="number" min="0" step="0.01" placeholder="{{__('Minimum Shopping Amount')}}" name="min_buy" class="form-control" required
                                            value='{{ old('min_buy', (isset($coupon) && isset($details->min_buy)) ? $details->min_buy : '' ) }}'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-9">
                                                <label class="control-label">{{__('Discount')}}</label>
                                                <div class="">
                                                    <input type="number" min="0" step="0.01" placeholder="{{__('Discount')}}" name="discount" class="form-control" required
                                                    value='{{ old('discount', isset($coupon) ? $coupon->discount : '' ) }}'>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <label class="control-label">{{__('Type')}}</label>
                                                <div class="">
                                                    <select class="demo-select2 form-control" name="discount_type">
                                                        <option value="amount" {{ old('discount_type', (isset($coupon)&&$coupon->discount_type=="amount") ? 'selected' : '' ) }}>$</option>
                                                        <option value="percent" {{ old('discount_type', (isset($coupon)&&$coupon->discount_type=="percent") ? 'selected' : '' ) }}>%</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label">{{__('Maximum Discount Amount')}}</label>
                                        <div class="">
                                            <input type="number" min="0" step="0.01" placeholder="{{__('Maximum Discount Amount')}}" name="max_discount" class="form-control" required
                                            value='{{ old('max_discount', (isset($coupon) && isset($details->max_discount)) ? $details->max_discount : '' ) }}'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="control-label" for="start_date">{{__('Start Date')}}</label>
                                        <div class="">
                                            <input type="text" class="form-control date_picker" name="start_date"
                                            value='{{ old('start_date', (isset($coupon)&& $coupon->start_date!=123) ? date('m/d/Y',$coupon->start_date) : '' ) }}'>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label" for="end_date">{{__('End Date')}}</label>
                                        <div class="">
                                            <input type="text" class="form-control date_picker" name="end_date"
                                            value='{{ old('end_date', (isset($coupon)&& $coupon->end_date!=123) ? date('m/d/Y',$coupon->end_date) : '' ) }}'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="type" id="type" value="cart_base">
                                <input type="hidden" name="id" id="id" value='{{$coupon->id}}'>
                                <input type="submit" value="UPDATE" class="btn btn-success btn-md w-00" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane {{ old('active', (isset($coupon)&& $coupon->type=='product_base') ? 'active' : '' ) }}" id="productbase">
                <div class="tile">
                    <h3 class="tile-title"> Add Your Product Base Coupon</h3>
                    <hr>
                    <div class="tile-body">
                        <form action="{{ isset($coupon) ? route('admin.coupons.update') : route('admin.coupons.store') }}" method="POST">
                        @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="control-label" for="code">{{__('Coupon code')}}</label>
                                        <div class="">
                                            <input type="text" placeholder="{{__('Coupon code')}}" id="code" name="code" class="form-control" required
                                            value='{{ old('code', isset($coupon) ? $coupon->code : '' ) }}'>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label">{{__('Discount')}}</label>
                                        <div class="">
                                            <input type="number" min="0" step="0.01" placeholder="{{__('Discount')}}" name="discount" class="form-control" required
                                            value='{{ old('discount', isset($coupon) ? $coupon->discount : '' ) }}'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-11">
                                        <label class="control-label">{{__('Discounted Products')}}</label>
                                        <div class="">
                                            <select required class="multi-product-select"  style="width:100%" name="products[]" multiple="multiple" id="product-ids">
                                                @foreach ($products as $product)
                                                    <option value='{{$product->id}}'>{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <label class="control-label">{{__('Type')}}</label>
                                        <div class="">
                                            <select class="demo-select2 form-control" name="discount_type">
                                                <option value="amount" {{ old('discount_type', (isset($coupon)&&$coupon->discount_type=="amount") ? 'selected' : '' ) }}>$</option>
                                                <option value="percent" {{ old('discount_type', (isset($coupon)&&$coupon->discount_type=="percent") ? 'selected' : '' ) }}>%</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="control-label" for="start_date">{{__('Start Date')}}</label>
                                        <div class="">
                                            <input type="text" class="form-control date_picker" name="start_date" 
                                            value='{{ old('start_date', (isset($coupon)&& $coupon->start_date!=123) ? date('m/d/Y',$coupon->start_date) : '' ) }}'>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label" for="end_date">{{__('End Date')}}</label>
                                        <div class="">
                                            <input type="text" class="form-control date_picker" name="end_date" 
                                            value='{{ old('end_date', (isset($coupon)&& $coupon->end_date!=123) ? date('m/d/Y',$coupon->end_date) : '' ) }}'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="type" id="type" value="product_base">
                                <input type="hidden" name="id" id="id" value='{{$coupon->id}}'>
                                <input type="submit" value="UPDATE" class="btn btn-success btn-md w-00" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
	<script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/js/plugins/bootstrap-datepicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/dropzone/dist/min/dropzone.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/js/plugins/bootstrap-notify.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/js/app.js') }}"></script>
	

<script>
		$(document).ready(function(){
            $('.date_picker').datepicker({
                format: "mm/dd/yyyy",
                autoclose: true,
                todayHighlight: true
            });
            $('.multi-product-select').select2();
            var selectedProducts = <?php echo $coupon->details; ?>;
            $('.multi-product-select').val(selectedProducts).change();
        });
		
</script>
@endpush