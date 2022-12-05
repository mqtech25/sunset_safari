@extends('admin.app')
@section('title') {{ $pageTitle}} @endsection
@section('content')
<div class="app-title">
	<div>
		<h1><i class="fa fa-sitemap mr-2"></i>{{ $pageTitle}}</h1>
	</div>
</div>
@include('admin.partials.flash')
<form action="{{ route('admin.menuitems.store') }}" method="POST" role="form" enctype="multipart/form-data">
	@csrf
	<div class="row">
			<div class="col-md-8 mx-auto">
				<div class="tile">
					<h3 class="tile-title">{{ $subTitle }}</h3>
					<hr>

						<div class="tile-body">
							<div class="form-group">
								<label class="control-label" for="title"> Title <span class="m-l-5 text-danger"> *</span></label>
								<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="" placeholder="Enter Menu Item Title"/>
								@error('title') {{ $message }} @enderror
							</div>
							<div class="form-group">
								<label for="slug" class="control-label"> Select Slug <span class="m-l-5 text-danger"> *</span></label>
								<select name="slug" id="slug" class="form-control custom-select mt-15 @error('slug') is-invalid @enderror">
									<option value="0">Select a page link</option>
									@foreach ($routeCollection as $value)
	
									@if (\Str::contains($value->getName(), 'site')&& $value->getName()!="")
										
									<option value="{{$value->getName()}}">{{$value->getName()}}</option>
									@endif
										
									@endforeach
			
								</select>
								@error('slug') {{ $message }} @enderror
							</div>
						</div>
				</div>
				<button class="btn btn-primary float-right"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
			</div>
	</div>
</form>

@endsection