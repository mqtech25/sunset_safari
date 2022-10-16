@extends('admin.app')
@section('title') {{ $pageTitle}} @endsection
@section('content')
<div class="app-title">
	<div>
		<h1><i class="fa fa-tags mr-2"></i> {{ $pageTitle }}</h1>
	</div>
</div>
@include('admin.partials.flash')
<form action="{{ route('admin.categories.store') }}" method="POST" role="form" enctype="multipart/form-data">
	@csrf
<div class="row">
		<div class="col-md-8 mx-auto">
			<div class="tile">
				<h3 class="tile-title">{{ $subTitle }}</h3>
				<hr>

					<div class="tile-body">
						<div class="form-group">
							<label class="control-label" for="name"> Title <span class="m-l-5 text-danger"> *</span></label>
							<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="" placeholder="Enter Menu Title"/>
							@error('name') {{ $message }} @enderror
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="parent" class="control-label"> Status <span class="m-l-5 text-danger"> *</span></label>
									<select name="parent_id" id="parent" class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror">
										<option value="0">Select a Status</option>
									</select>
									@error('parent_id') {{ $message }} @enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="parent" class="control-label"> Location <span class="m-l-5 text-danger"> *</span></label>
									<select name="parent_id" id="parent" class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror">
										<option value="0">Select a Location</option>
									</select>
									@error('parent_id') {{ $message }} @enderror
								</div>
							</div>
						</div>
					</div>
			</div>
			<button class="btn btn-primary float-right"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
		</div>
</div>
</form>
@endsection