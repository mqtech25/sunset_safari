@extends('admin.app')
@section('title') {{ $pageTitle}} @endsection
@section('content')
<div class="app-title">
	<div>
		<h1><i class="fa fa-sitemap mr-2"></i>{{ $pageTitle}}</h1>
	</div>
</div>
@include('admin.partials.flash')
<form action="{{ route('admin.createmenu.store') }}" method="POST" role="form" enctype="multipart/form-data">
	@csrf
	<div class="row">
			<div class="col-md-8 mx-auto">
				<div class="tile">
					<h3 class="tile-title">{{ $subTitle }}</h3>
					<hr>

						<div class="tile-body">
							<div class="form-group">
								<label class="control-label" for="title"> Title <span class="m-l-5 text-danger"> *</span></label>
								<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="" placeholder="Enter Menu Title"/>
								@error('title') {{ $message }} @enderror
							</div>
							<div class="form-group">
								<label for="status" class="control-label"> Status <span class="m-l-5 text-danger"> *</span></label>
								<select name="status" id="status" class="form-control custom-select mt-15 @error('status') is-invalid @enderror">
									<option value="0">Select a Status</option>
									@foreach ($routeCollection as $value)
	
									@if (!\Str::contains($value->getName(), 'admin')&&!\Str::contains($value->getName(), 'ckfinder')
									&&!\Str::contains($value->getName(), '_ignition')&& $value->getName()!="")
										
									<option value="{{$value->getName()}}">{{$value->getName()}}</option>
									@endif
										
									@endforeach
			
								</select>
								@error('status') {{ $message }} @enderror
							</div>
						</div>
				</div>
				<button class="btn btn-primary float-right"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
			</div>
	</div>
</form>

@endsection