@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
	<h1><i class="fa fa-gift"></i> {{ $pageTitle }} </h1>
	<a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">Create Coupon </a>
</div>
@include('admin.partials.flash')

	<div class="tile">
        <div class="tile-body">
			<table class="table table-hover table-bordered" id="sampleTable" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('Code')}}</th>
                        <th>{{__('Type')}}</th>
                        <th>{{__('Start Date')}}</th>
                        <th>{{__('End Date')}}</th>
                        <th width="10%">{{__('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $key => $coupon)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$coupon->code}}</td>
                            <td>@if ($coupon->type == 'cart_base')
                                    {{ __('Cart Base') }}
                                @elseif ($coupon->type == 'product_base')
                                    {{ __('Product Base') }}
                            @endif</td>
                            <td>{{ date('d-m-Y', $coupon->start_date) }}</td>
                            <td>{{ date('d-m-Y', $coupon->end_date) }}</td>
                            <td class="text-center"> 
								<div class="btn-group">
									<a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> 
									<a href="{{route('admin.coupons.delete',$coupon->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').dataTable();</script>
@endpush