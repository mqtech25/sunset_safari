@extends('site.app')
@section('title', 'Blog')
@section('content')
<style>
	.post-image{
		max-height: <?php echo config('settings.single_post_image_height').'px'?>;
	}
</style>
<section class="section-pagetop bg-primary">
	<div class="container clearfix">
		<h2 class="title-page">{{$post->title}}</h2>
		
	</div>
</section>
<section class="section-content bg padding-y">
	<div class="container">
		<div id="code_prod_complex">
			<div class="row">
				@if(Session::has('message'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Success!</strong> {{ Session::get('message') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@elseif(Session::has('error'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>!</strong> {{ Session::get('error') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
				<div class="col-md-12">
					@if($post->images != '' && config('settings.blog_featured_image') == '1')
					<div class="row my-3">
						<div class="col-12 px-0">
							<div class="">
								<img class="w-100 post-image" src="{{$post->path.'/'.json_decode($post->images)->full}}" alt="">
							</div>
						</div>
					</div>
					@endif
					<div class="row">
							{!! $post->description !!}
					</div>
					<div class="row">
						<p class="text-muted">Posted On: {{$post->created_at->format('d-M-Y')}} <br>By: {{$post->creater->name}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@push('custom-scripts')
	
@endpush
@stop