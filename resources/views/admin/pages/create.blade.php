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
					<a class="nav-link active" href="#general" data-toggle="tab">General</a>
                </li>
                <li class="nav-item"> 
					<a class="nav-link" href="#page-content" data-toggle="tab">Content </a>
				</li>
				{{-- <li class="nav-item"> 
					<a class="nav-link" href="#page-banner" data-toggle="tab">Page Banner </a>
				</li> --}}
				<li class="nav-item"> 
					<a class="nav-link" href="#meta-info" data-toggle="tab">Page Meta Information </a>
				</li>
			</ul>
		</div>
    </div>
    <div class="col-md-9">
        <form action="{{ isset($page) ? route('admin.pages.update') : route('admin.pages.store') }}" method="POST">
        @csrf
        <input type="hidden" value="{{$page->id}}" name="id">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <h3 class="tile-title"> Page Information </h3>
                        <hr>
                        <div class="tile-body">
                            <div class="form-group">
								<label for="page_title" class="control-label">Title</label>
                                <input type="text" name="page_title" placeholder="Enter page title" 
                                value="{{ old('page_title', isset($page) ? $page->page_title : '' ) }}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="page_subtitle" class="control-label">Sub Title</label>
                                <input type="text" name="page_subtitle" placeholder="Enter page sub-title" 
                                value="{{ old('page_subtitle', isset($page) ? $page->page_subtitle : '' ) }}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="page_slug" class="control-label">Slug</label>
                                        <input type="text" name="page_slug" placeholder="page slug" 
                                        value="{{ old('page_slug', isset($page) ? $page->page_slug : '' ) }}" class="form-control" >
                                    </div>
                                    <div class="col-6">
                                        <label for="page_status" class="control-label">Staus</label>	
                                        <select name="page_status" id="page-status" class="form-control">
                                            <option value="0" {{ (isset($page) && $page->page_status!=1) ? 'selected' : ''  }}> DRAFT </option>
                                            <option value="1" {{ (isset($page) && $page->page_status==1) ? 'selected' : ''  }}> PUBLISHED </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="page-content">
                    <div class="tile">
                        <div class="tile-body">
                            <div class="form-group">
                                <textarea name="page_content">{{$page->page_content}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="tab-pane" id="page-banner">
                    <div class="tile">
                        <h3 class="tile-title"> Banner Image </h3>
                        <hr>
                        <div class="tile-body">
                           <div class="file-field">
                                <div class="btn btn-primary btn-sm float-left">
                                <span>Choose files</span>
                                <input type="file" multiple>
                                </div>
                                <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Upload one or more files">
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="tab-pane" id="meta-info">
                    <div class="tile">
                        <h3 class="tile-title"> Page Meta </h3>
                        <hr>
                        <div class="tile-body">
                            <div class="form-group">
								<label for="page_meta_title" class="control-label">Meta Title</label>
                                <input type="text" name="page_meta_title" placeholder="Enter page meta title" 
                                value="{{ old('page__meta_title', isset($page) ? $page->page_meta_title : '' ) }}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="page_meta_description" class="control-label">Meta Description</label>
                                <textarea class="form-control" rows="5" name="page_meta_description">{{(isset($page) ? $page->page_meta_description : '' )}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="page_meta_keyword" class="control-label">Keywords</label>	
                                <input type="text" name="page_meta_keyword" id="page-meta-keyword" 
                                value="{{ old('page_meta_keyword', isset($page) ? $page->page_meta_keyword : '' ) }}" class="form-control" data-role="tagsinput">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <div class="form-group pull-right ">
                    <input type="submit" value="UPDATE" class="btn btn-success btn-md w-00" >
                </div>
            </div>
        </form>
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
            var keywords = '<?php echo $page->page_meta_keyword; ?>';
            $("#page-meta-keyword").tagsinput('add', keywords);


            $('#page-status').select2();
            CKEDITOR.replace('page_content',{
                filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Images',
                filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
            });

		let myDropzone = new Dropzone('#dropzone', {
			paramName: "image",
			addRemoveLinks: false,
			maxFilesize: 4,
			parallelUploads: 2,
			uploadMultiple: false,
			url: "{{ route('admin.products.images.upload')}}",
			autoProcessQueue: false,
		});


		myDropzone.on('queuecomplete', function(file){
			window.location.reload();
			showNotification('Completed', 'All product images uploaded', 'success', 'fa-check');
		});


		$('#uploadButton').click(function(){
			if(myDropzone.files.length === 0){
				showNotification('Error', 'Please select files to upload.', 'danger', 'fa-close');
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