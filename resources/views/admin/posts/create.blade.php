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
				<li class="nav-item"> 
					<a class="nav-link" href="#meta-info" data-toggle="tab">Meta Information </a>
				</li>
			</ul>
        </div>
        <div class="tile">
            <h3 class="tile-title"> Featured Image </h3>
            <hr>
            <div class="tile-body">
                <form action="" class="dropzone" id="dropzone" style="border: 2px dashed rgba(0,0,0,0.3)">
                    <input type="hidden" name="post_id" value="{{ isset($post) ? $post->id : ''}}">
                    {{ csrf_field() }}
                </form>
            </div>
            @if(isset($post) && $post->images != null)
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body d-flex justify-content-center">
                            <img src="{{ $post->path.'/'.json_decode($post->images)->postthumb }}" alt="image" id="postthumb" class="img-fluid admin-post-thumb">
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.posts.images.deletebulk', $post->id) }}" class="card-link float-right text-danger">
                                <i class="fa fa-fw fa-lg fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="col-md-9">
        <form action="{{ isset($post) ? route('admin.posts.update') : ''}}" method="POST">
        @csrf
        <input type="hidden" value="{{$post->id}}" name="id">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <h3 class="tile-title"> Post Info </h3>
                        <hr>
                        <div class="tile-body">
                            <div class="form-group">
								<label for="title" class="control-label">Title</label>
                                <input type="text" name="title" placeholder="Enter page title" 
                                value="{{ old('title', isset($post) ? $post->title : '' ) }}" class="form-control" >
                                @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="slug" class="control-label">Slug</label>
                                        <input type="text" name="slug" placeholder="page slug" 
                                        value="{{ old('slug', isset($post) ? $post->slug : '' ) }}" class="form-control" >
                                        @error('slug')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="status" class="form-label">Status</label>	
                                        <select name="status" id="status" class="form-control">
                                            <option value="0" {{ (isset($post) && $post->status!=1) ? 'selected' : ''  }}> DRAFT </option>
                                            <option value="1" {{ (isset($post) && $post->status==1) ? 'selected' : ''  }}> PUBLISHED </option>
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
                                <textarea name="description">{{$post->description}}</textarea>
                                @error('description')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="meta-info">
                    <div class="tile">
                        <h3 class="tile-title"> Post Meta </h3>
                        <hr>
                        <div class="tile-body">
                            <div class="form-group">
								<label for="meta_title" class="control-label">Meta Title</label>
                                <input type="text" name="meta_title" placeholder="Enter post meta title" 
                                value="{{ old('meta_title', isset($post) ? $post->meta_title : '' ) }}" class="form-control" >
                                @error('meta_title')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="meta_description" class="control-label">Meta Description</label>
                                <textarea class="form-control" rows="5" name="meta_description">{{(isset($post) ? $post->meta_description : '' )}}</textarea>
                                @error('meta_description')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="meta_tags" class="control-label">Keywords</label>	
                                <input type="text" name="meta_tags" id="post-meta-tags" 
                                value="{{ old('meta_tags', isset($post) ? $post->meta_tags : '' ) }}" class="form-control" data-role="tagsinput">
                                @error('meta_tags')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
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
            var keywords = '<?php echo $post->meta_tags; ?>';
            $("#post-meta-tags").tagsinput('add', keywords);


            $('#status').select2();
            CKEDITOR.replace('description',{
                filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Images',
                filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
            });

		let myDropzone = new Dropzone('#dropzone', {
			paramName: "image",
			addRemoveLinks: false,
			maxFilesize: 4,
			parallelUploads: 1,
			uploadMultiple: false,
			url: "{{ route('admin.posts.images.upload')}}",
			autoProcessQueue: true,
		});

        myDropzone.on('complete', function(){
            showNotification('Completed', 'Images Uploaded', 'success', 'fa-check');
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