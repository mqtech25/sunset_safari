@extends('admin.app')
@section('title') {{ $pageTitle}} @endsection
@section('content')
<div class="app-title">
	<div>
		<h1><i class="fa fa-truck"></i> {{ $pageTitle }}</h1>
	</div>
</div>
@include('admin.partials.flash')
<div class="row">
	<div class="col-md-8 mx-auto">
		<div class="tile">
			<h3 class="tile-title">{{ $subTitle }} </h3>
			<form action="{{ isset($shipping)? route('admin.shipping.update'):route('admin.shipping.store') }}" method="POST" role="form">
				@csrf
				@if(isset($shipping))
				<input type="hidden" name="id" id="id" value="{{$shipping->id}}">
				@endif
				<div class="tile-body">
					<div class="row">
						<div class="col-4">
							<div class="form-group">
								<label class="control-label" for="from"> From <span class="m-l-5 text-danger"> *</span></label>
								<input type="number" class="form-control @error('from') is-invalid @enderror" placeholder="{{config('settings.currency_symbol')}} 0.00" required name="from" id="from"
								value="{{ isset($shipping) ? $shipping->from : ''}}"/>
								@error('from') {{ $message }} @enderror
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label class="control-label" for="to"> To <span class="m-l-5 text-danger"> *</span></label>
								<input type="number" class="form-control @error('to') is-invalid @enderror" placeholder="{{config('settings.currency_symbol')}} 0.00" required name="to" id="to"
								value="{{ isset($shipping) ? $shipping->to : ''}}"/>
								@error('to') {{ $message }} @enderror
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label class="control-label" for="cost"> Cost <span class="m-l-5 text-danger"> *</span></label>
								<input type="number" class="form-control @error('cost') is-invalid @enderror" placeholder="{{config('settings.currency_symbol')}} 0.00" required name="cost" id="cost" 
								value="{{ isset($shipping) ? $shipping->cost : ''}}"/>
								@error('cost') {{ $message }} @enderror
							</div>
						</div>
					</div>
					
					<div class="tile-footer">
						<button class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>{{ isset($shipping) ? 'Update Rule' : 'Save Rule'}}</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection