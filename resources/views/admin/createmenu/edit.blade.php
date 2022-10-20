@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
	<div>
		<h1><i class="fa fa-tags"></i> {{ $pageTitle }} </h1>
	</div>
</div>
@include('admin.partials.flash')
<div class="row">
	<div class="col-md-8 mx-auto">
		<form action="{{ route('admin.createmenu.update') }}" method="POST" role="form" enctype="multipart/form-data">
			@csrf
			<div class="row">
					<div class="col-md-8 mx-auto">
						<div class="tile">
							<h3 class="tile-title">{{ $subTitle }}</h3>
							<hr>

								<div class="tile-body">
									<div class="form-group">
										<label class="control-label" for="title"> Title <span class="m-l-5 text-danger"> *</span></label>
										<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title', $targetMenu->title) }}" placeholder="Enter Menu Title"/>
										<input type="hidden" name="id", value="{{ $targetMenu->id }}">										
										@error('title') {{ $message }} @enderror
									</div>
									<div class="form-row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="status" class="control-label"> Status <span class="m-l-5 text-danger"> *</span></label>
												<select name="status" id="status" class="form-control custom-select mt-15 @error('status') is-invalid @enderror">
													<option value="0">Select a Status</option>
													<option value="published" {{($targetMenu->status == "published")?'selected':''}}>Published</option>
													<option value="draft" {{($targetMenu->status == "draft")?'selected':''}}>Draft</option>
												</select>
												@error('status') {{ $message }} @enderror
											</div>
										</div>
										{{-- <div class="col-md-6">
											<div class="form-group">
												<label for="location" class="control-label"> Location <span class="m-l-5 text-danger"> *</span></label>
												<select name="location" id="location" class="form-control custom-select mt-15 @error('location') is-invalid @enderror">
													<option value="0">Select a Location</option>
													<option value="header" {{$targetMenu->location=="header"?"selected":''}}>Header</option>
													<option value="footer" {{$targetMenu->location=="footer"?"selected":''}}>Footer</option>
												</select>
												@error('location') {{ $message }} @enderror
											</div>
										</div> --}}
									</div>
									<label for="location" class="control-label"> Location <span class="m-l-5 text-danger"> *</span></label>
									<div class="form-row">
										{{-- @foreach ($locations as $location) --}}
										<div class="form-group mr-2 mb-0">
											<div class="form-check">
												<label for="header" class="form-check-label">
													<input type="checkbox" class="form-check-input" id="header" name="location[]" value="header" {{(in_array('header',$locations))?"checked":""}} >Show in Header
												</label>
											</div>
										</div>
										<div class="form-group  mb-0">
											<div class="form-check">
												<label for="footer" class="form-check-label">
													<input type="checkbox" class="form-check-input" id="footer" name="location[]" value="footer" {{(in_array('footer',$locations))?"checked":""}}>Show in Footer
												</label>
											</div>
										</div>
										{{-- @endforeach --}}
									</div>
									<p class="text-danger">@error('location') {{ $message }} @enderror</p>
								</div>
						</div>
						<button class="btn btn-primary float-right"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
					</div>
			</div>
		</form>
	</div>
</div>
@endsection