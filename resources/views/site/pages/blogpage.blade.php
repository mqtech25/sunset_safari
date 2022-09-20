@extends('site.app')
@section('title', 'Blog')
@section('content')
<style>
	.user-rating-top-dynamic{
        background-image: url('{{asset("storage/payment_img/star-bg.png")}}');
    }
    .user-rating-back-dynamic{
        background-image: url('{{asset("storage/payment_img/star-bg-dark.png")}}');
    }
</style>
<section class="section-pagetop bg-primary">
	<div class="container clearfix">
		<h2 class="title-page">BLOG</h2>
		
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
					<div class="row">
							@forelse($posts as $post)
							<div class="col-md-4">
								<figure class="card card-product">
									@if ($post->images != '')
									<a href="{{ route('blog.post', $post->slug) }}" class="img-wrap">
										<img class="product-image" src="{{$post->path.'/'.json_decode($post->images)->postthumb}}"> 
									</a>
									@else
									<div class="img-wrap padding-y"><img src="https://via.placeholder.com/300" alt=""></div>
									@endif
									<figcaption class="info-wrap">
										<p><small>{{$post->created_at->format('d-M-Y')}} {{$post->created_at->diffForHumans()}}</small></p>
										<h4 class="title"><a href="{{ route('blog.post', $post->slug) }}">{{ str_limit($post->title, $limit = 50, $end = '.....') }}</a></h4>
										<p class="">
											{!! str_limit(strip_tags($post->description), $limit = 100, $end = '.....') !!}
										</p>
										<hr>
										<p><small class="text-muted">Posted by {{$post->creater->name}}</small></p>
									</figcaption>
								</figure>
							</div>
							@empty
							<p>No Posts found.</p>
							@endforelse
					</div>
					<div class="row">
						{{ $posts->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@push('custom-scripts')
	
@endpush
@stop