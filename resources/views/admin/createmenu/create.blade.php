@extends('admin.app')
@section('title') {{ $pageTitle}} @endsection
@section('content')
<div class="app-title">
	<div>
		<h1><i class="fa fa-tags mr-2"></i> {{ $pageTitle }}</h1>
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
							<div class="form-row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="status" class="control-label"> Status <span class="m-l-5 text-danger"> *</span></label>
										<select name="status" id="status" class="form-control custom-select mt-15 @error('status') is-invalid @enderror">
											<option value="0">Select a Status</option>
											<option value="published">Published</option>
											<option value="draft">Draft</option>
										</select>
										@error('status') {{ $message }} @enderror
									</div>
								</div>
								
								{{-- <div class="col-md-6">
									<div class="form-group">
										<label for="location" class="control-label"> Location <span class="m-l-5 text-danger"> *</span></label>
										<select name="location" id="location" class="form-control custom-select mt-15 @error('location') is-invalid @enderror">
											<option value="0">Select a Location</option>
											<option value="header">Header</option>
											<option value="footer">Footer</option>
										</select>
										@error('location') {{ $message }} @enderror
									</div>
								</div> --}}
							</div>
							<label for="location" class="control-label"> Location <span class="m-l-5 text-danger"> *</span></label>
							<div class="form-row">
								<div class="form-group mr-2 mb-0">
									<div class="form-check">
										<label for="header" class="form-check-label">
											<input type="checkbox" class="form-check-input" id="header" name="location[]" value="header" >Show in Header
										</label>
									</div>
								</div>
								<div class="form-group  mb-0">
									<div class="form-check">
										<label for="footer" class="form-check-label">
											<input type="checkbox" class="form-check-input" id="footer" name="location[]" value="footer">Show in Footer
										</label>
									</div>
								</div>
							</div>
							<p class="text-danger">@error('location') {{ $message }} @enderror</p>
						</div>
				</div>
				<button class="btn btn-primary float-right"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
			</div>
	</div>
</form>
@endsection