 <!-- ========================= FOOTER =========================  -->

 <footer class="section-footer border-top bg">
	<div class="container">
		<section class="footer-top  padding-y">
			<div class="row">
				<aside class="col-md-6 col-6">
					<h6 class="title">News Letter</h6>
					<p>Subscribe to newsletter for lattest news and updates</p>
					<form action="{{route('subscription.subscribe')}}" method="POST">
						@csrf
						<div class="form-row">
							<div class="col-9">
								<input type="email" name="email" id="email" class="form-control">
								@error('email')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="col-3">
								<input type="submit" name="submit" id="news_submit" value="SUBSCRIBE" class="btn btn-success">
							</div>
						</div>
					</form>
				</aside>
				<aside class="col-md-2 col-6">
					<h6 class="title">Company</h6>
					<ul class="list-unstyled">
						@php
							$pages = \App\Models\Page::select('page_title','page_slug')->where('page_status', 1)->get();
						@endphp
						@foreach ($pages as $cmsPage)
							<li> <a href="{{ route('pages.show', $cmsPage->page_slug) }}">{{$cmsPage->page_title}}</a></li>
						@endforeach
					</ul>
				</aside>
				<aside class="col-md-2 col-6">
					<h6 class="title">Usefull links</h6>
					<ul class="list-unstyled">
						<li> <a href="#"> User Login </a></li>
						<li> <a href="#"> User register </a></li>
						<li> <a href="#"> Account Setting </a></li>
						<li> <a href="#"> My Orders </a></li>
					</ul>
				</aside>
				<aside class="col-md-2 col-6">
					<h6 class="title">Account</h6>
					<ul class="list-unstyled">
						<li> <a href="#"> User Login </a></li>
						<li> <a href="#"> User register </a></li>
						<li> <a href="#"> Account Setting </a></li>
						<li> <a href="#"> My Orders </a></li>
					</ul>
				</aside>
			</div> <!-- row.// -->
		</section>	<!-- footer-top.// -->
		<hr>
		<section class="footer-bottom row">
			<div class="col-md-6">
				<p class="text-muted"> Copyright &copy; {{ date('Y')}} <a href="https://vorsurm.herokuapp.com" traget="_blank"> vorsurm</a> - All Rights Reserved. </p>
			</div>
			<!-- <div class="col-md-2 text-md-center">
				<span class="px-2">demo content</span>
				<span class="px-2">+879-332-9375</span>
				<span class="px-2">Street name 123, Avanue abc</span>
			</div> -->
			<div class="col-md-6 text-md-right text-muted">
				<span class="px-2">Follow Us:</span>
				<a href="{{config('settings.social_facebook')}}"> <i class="fab fa-facebook"></i></a>
				<a href="{{config('settings.social_twitter')}}"> <i class="fab fa-twitter"></i></a>
				<a href="{{config('settings.social_instagram')}}"> <i class="fab fa-instagram"></i> </a>
				<a href="{{config('settings.social_linkedin')}}"> <i class="fab fa-youtube"></i></a>
			</div>
		</section>
	</div><!-- //container -->
</footer>
  <!-- ========================= FOOTER END // =========================  -->