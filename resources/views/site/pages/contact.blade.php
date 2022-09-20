@extends('site.app')
@section('title', 'Contact')
@section('content')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<section class="section-pagetop bg-primary">
	<div class="container clearfix">
		<p class="text-white text-center w-100 mb-0"><i class="fa fa-envelope wishlist-icon"></i></p>
		<h3 class="title-page text-uppercase text-center">Contact Us</h3>
	</div>
</section>
<section class="section-content bg padding-y border-top">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@if(Session::has('message'))
				<p class="alert alert-success">{{ Session::get('message') }}</p>
				@elseif(Session::has('error'))
				<p class="alert alert-danger">{{ Session::get('error') }}</p>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<h2 class="text-center pb-4">We'd <i class="fa fa-heart"></i> to help!</h2>
				<div class="card mt-2">
					<div class="row">
						<div class="col-sm-12 col-md-8">
							<form action="{{route('contact.email')}}" class="p-5" method="POST">
								@csrf
								<div class="form-group">
									<label for="name" class="form-label">Name</label>
									<input type="text" placeholder="Name" class="form-control" name="name" id="">
								</div>
								<div class="form-group">
									<label for="name" class="form-label">Email</label>
									<input type="email" placeholder="Email" class="form-control" name="email" id="">
								</div>
								<div class="form-group">
									<label for="name" class="form-label">Message</label>
									<textarea class="form-control" placeholder="Your message" name="message" id="" rows="6"></textarea>
								</div>
								<div class="g-recaptcha my-2" id="feedback-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
								<div class="form-group">
									<input type="submit" class="form-control btn btn-success" value="SEND">
								</div>
							</form>
						</div>
						<div class="col-sm-4 col-md-4">
							<div class="contact-details p-5"></div>
							<p class="py-4"><i class="fa fa-phone"></i> <span class="ml-4">{{config('settings.default_phone_number')}}</span></p>
							<p class="py-4"><i class="fa fa-envelope"></i> <span class="ml-4">{{config('settings.default_email_address')}}</span></p>
							<p class="py-4"><i class="fa fa-map-marker"></i> <span class="ml-4 text-center">{{config('settings.default_site_address')}}</span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop

