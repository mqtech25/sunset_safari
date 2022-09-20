@extends('site.app')
@section('title', 'Search')
@section('content')
<section class="section-pagetop bg-primary">
	<div class="container clearfix">
		<h2 class="title-page">Search Results</h2>
	</div>
</section>
<section class="section-content bg padding-y">
	<div class="container">
		<div id="code_prod_complex">
			<div class="row">
				@forelse($resultentProducts as $product)
				<div class="col-md-4">
					<figure class="card card-product">
						@if ($product->images->count() > 0)
						<div class="img-wrap padding-y"><img src="{{ $product->mainProductThumbImage()}}" alt=""></div>
						@else
						<div class="img-wrap padding-y"><img src="https://via.placeholder.com/176" alt=""></div>
						@endif
						<figcaption class="info-wrap">
							<h4 class="title"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h4>
						</figcaption>
						<div class="bottom-wrap">
							<a href="" class="btn btn-sm btn-success float-right"><i class="fa fa-cart-arrow-down"></i> Add to cart</a>
							@if ($product->sale_price != 0)
							<div class="price-wrap h5">
								<span class="price"> {{ config('settings.currency_symbol').$product->sale_price }} </span>
								<del class="price-old"> {{ config('settings.currency_symbol').$product->price }}</del>
							</div>
							@else
							<div class="price-wrap h5">
								<span class="price"> {{ config('settings.currency_symbol').$product->price }} </span>
							</div>
							@endif
						</div>
					</figure>
				</div>
				@empty
				<p>No Products found.</p>
				@endforelse
			</div>
			{{ $resultentProducts->appends(['search_category' => $_GET['search_category'],'search_keyword' => $_GET['search_keyword']])->links() }}
		</div>
	</div>
</section>
@stop