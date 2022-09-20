@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('backend/dropzone/dist/min/dropzone.min.css') }}" type="text/css">
@endsection

@section('content')
<div class="app-title">
	<h1><i class="fa fa-sliders"></i> {{ $pageTitle }} </h1>
</div>
@include('admin.partials.flash')

<div class="row user">
	<div class="col-md-3">
		<div class="tile p-0">
			<ul class="nav nav-tabs user-tabs flex-column">
				<li class="nav-item"> 
					<a class="nav-link active" href="#general" data-toggle="tab">General</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-9">
		<div class="tab-content">
			<div class="tab-pane active" id="general">
				<div class="tile">
					<h3 class="tile-title">Upload Image</h3>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<form action="" class="dropzone" id="dropzoneform" style="border: 2px dashed rgba(0,0,0,0.3)">
								<input type="hidden" name="banner_id" value="{{ isset($banner) ? $banner->id : ''}}">
								{{ csrf_field() }}
							</form>
						</div>
					</div>
					<form action="{{ isset($banner) ? route('admin.banners.update') : route('admin.banners.store') }}" method="POST">
						@csrf
						<h3 class="tile-title mt-3"> Banner Information </h3>
						<hr>
						<div class="tile-body">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label for="banner_title" class="control-label">Banner Title</label>
										<input type="text" name="banner_title" placeholder="Enter banner title" value="{{ old('banner_title', isset($banner) ? $banner->banner_title : '' ) }}"  class="form-control @error('banner_title') is-invalid @enderror" >
										<input type="hidden" name="id" value="{{ isset($banner) ? $banner->id : '' }}">

										<div class="invalid-feedback active">
											<i class="fa fa-exclamation-circle fa-fw"></i> 
											@error('name') <span>{{ $message }}</span> @enderror
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="name" class="control-label">Banner Sub-Title</label>
										<input type="text" name="banner_subtitle" placeholder="Enter banner title" value="{{ old('banner_subtitle', isset($banner) ? $banner->banner_subtitle : '' ) }}" class="form-control @error('banner_subtitle') is-invalid @enderror" >
										<input type="hidden" name="id" value="{{ isset($banner) ? $banner->id : '' }}">
										<div class="invalid-feedback active">
											<i class="fa fa-exclamation-circle fa-fw"></i> 
											@error('name') <span>{{ $message }}</span> @enderror
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-4">
									<div class="form-group">
										<label for="banner_order" class="control-label">Banner Order</label>
										<input type="text" name="banner_order" placeholder="Enter banner order" value="{{ old('banner_order', isset($banner) ? $banner->banner_order : '' ) }}" class="form-control @error('banner_order') is-invalid @enderror" >

										<input type="hidden" name="id" value="{{ isset($banner) ? $banner->id : '' }}">
										<div class="invalid-feedback active">
											<i class="fa fa-exclamation-circle fa-fw"></i> 
											@error('banner_order') <span>{{ $message }}</span> @enderror
										</div>
									</div>
								</div>
								<div class="col-2">
									<div class="form-group pt-4">
										<div class="form-check">
											<label for="" class="form-check-label">
												<input type="checkbox" name="banner_status" class="form-check-input" {{ isset($banner) ? ($banner->banner_status == 1 ? 'checked' : '') : ''}} >Status
											</label>
										</div>
									</div>
								</div>
							</div>
							
							@if(isset($banner) && $banner->banner_image != NULL)
							<hr>
							<div class="row">
								<div class="col-md-3">
									<div class="card">
										<div class="card-body">
											<img src="{{ asset('storage/'.$banner->banner_image) }}" alt="image" id="brandLogo" class="img-fluid">
										</div>
									</div>
								</div>
							</div>
							@endif
						</div>
						<div class="tile-footer">
							<div class="row d-print-none mt-2">
								<div class="col-12 text-right">
									<button class="btn btn-success" type="submit" id="uploadButton">
										<i class="fa fa-fw fa-lg fa-check-circle"></i>
										{{ isset($banner) ? 'Update Banner' : 'Save Banner' }}
									</button>
									<a href="{{ route('admin.banners.index') }}" class="btn btn-danger">
										<i class="fa fa-fw fa-lg fa-arrow-left"></i> Go Back
									</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	@endsection
	@push('scripts')
	<script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/dropzone/dist/min/dropzone.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/js/plugins/bootstrap-notify.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/js/app.js') }}"></script>
	

	<script>
		Dropzone.autoDiscover = false;

		$(document).ready(function(){
			
		let myDropzone = new Dropzone('#dropzoneform', {
			paramName: "image",
			addRemoveLinks: false,
			maxFilesize: 4,
			parallelUploads: 2,
			uploadMultiple: false,
			url: "{{ route('admin.banners.images.upload')}}",
			autoProcessQueue: true,
		});


		
		

		$('#uploadButton').click(function(){
			if(myDropzone.files.length === 0){
				// showNotification('Error', 'Please select files to upload.', 'danger', 'fa-close');
			}else{
				myDropzone.processQueue();
			}
		});


		function showNotification(title, message, type, icon){

			$.notify({
				title: title + ' : ',
				message: message,
				icon: 'fa ' + icon
			},{
				type: type,
				allow_dismiss: true,
				placement: {
					from: "top",
					align: "right"
				}
			});
		}

	});
		
</script>
@endpush