@extends('site.app')
@section('title', 'SUNSET - Homepage')

@section('content')


	<!-- SubHeader =============================================== -->
	<section class="header-video">
		<div id="hero_video">
			<div id="animate_intro">
				<h3>Enjoy a Perfect Tour</h3>
				<p>
					Find the best Tours and Excursion at the best price
				</p>
			</div>
		</div>
		<img src="{{asset('frontend/images/video_fix.png')}}" alt="" class="header-video--media" data-video-src="frontend/video/dubai_desert" data-teaser-source="frontend/video/dubai_desert" data-provider="" data-video-width="1920" data-video-height="750">
	</section>
	<!-- End Header video -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">

			<div class="main_title">
				<h2>Our <span>Top</span> Travel Tours</h2>
				<p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-6 wow fadeIn animated" data-wow-delay="0.2s">
					<div class="img_wrapper">
						<div class="ribbon">
							<span>Popular</span>
						</div>
						<div class="price_grid">
							<sup>$</sup>450
						</div>
						<div class="img_container">
							<a href="detail-page.html">
								<img src="{{asset('frontend/images/tour_list_1.jpg')}}" width="800" height="533" class="img-responsive" alt="">
								<div class="short_info">
									<h3>Las Vegas</h3>
									<em>Duration 3 days</em>
									<p>
										A quam morbi ut arcu, eget neque molestie, ullamcorper congue pharetra, hendrerit odio consectetuer.
									</p>
									<div class="score_wp">Superb
										<div class="score">7.5</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- End img_wrapper -->
				</div>

				<div class="col-md-4 col-sm-6 wow fadeIn animated" data-wow-delay="0.2s">
					<div class="img_wrapper">
						<div class="ribbon">
							<span>Popular</span>
						</div>
						<div class="price_grid">
							<sup>$</sup>520
						</div>
						<div class="img_container">
							<a href="detail-page.html">
								<img src="{{asset('frontend/images/tour_list_2.jpg')}}" width="800" height="533" class="img-responsive" alt="">
								<div class="short_info">
									<h3>London</h3>
									<em>Duration 3 days</em>
									<p>
										A quam morbi ut arcu, eget neque molestie, ullamcorper congue pharetra, hendrerit odio consectetuer.
									</p>
									<div class="score_wp">Superb
										<div class="score">7.5</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- End img_wrapper -->
				</div>

				<div class="col-md-4 col-sm-6 wow fadeIn animated" data-wow-delay="0.2s">
					<div class="img_wrapper">
						<div class="ribbon">
							<span>Popular</span>
						</div>
						<div class="price_grid">
							<sup>$</sup>610
						</div>
						<div class="img_container">
							<a href="detail-page.html">
								<img src="{{asset('frontend/images/tour_list_5.jpg')}}" width="800" height="533" class="img-responsive" alt="">
								<div class="short_info">
									<h3>Rome - Vatican</h3>
									<em>Duration 3 days</em>
									<p>
										A quam morbi ut arcu, eget neque molestie, ullamcorper congue pharetra, hendrerit odio consectetuer.
									</p>
									<div class="score_wp">Superb
										<div class="score">7.5</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- End img_wrapper -->
				</div>

				<div class="col-md-4 col-sm-6 wow fadeIn animated" data-wow-delay="0.2s">
					<div class="img_wrapper">
						<div class="ribbon">
							<span>Popular</span>
						</div>
						<div class="price_grid">
							<sup>$</sup>750
						</div>
						<div class="img_container">
							<a href="detail-page.html">
								<img src="{{asset('frontend/images/tour_list_6.jpg')}}" width="800" height="533" class="img-responsive" alt="">
								<div class="short_info">
									<h3>Maldive</h3>
									<em>Duration 3 days</em>
									<p>
										A quam morbi ut arcu, eget neque molestie, ullamcorper congue pharetra, hendrerit odio consectetuer.
									</p>
									<div class="score_wp">Superb
										<div class="score">7.5</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- End img_wrapper -->
				</div>

				<div class="col-md-4 col-sm-6 wow fadeIn animated" data-wow-delay="0.2s">
					<div class="img_wrapper">
						<div class="ribbon">
							<span>Popular</span>
						</div>
						<div class="price_grid">
							<sup>$</sup>520
						</div>
						<div class="img_container">
							<a href="detail-page.html">
								<img src="{{asset('frontend/images/tour_list_7.jpg')}}" width="800" height="533" class="img-responsive" alt="">
								<div class="short_info">
									<h3>London</h3>
									<em>Duration 3 days</em>
									<p>
										A quam morbi ut arcu, eget neque molestie, ullamcorper congue pharetra, hendrerit odio consectetuer.
									</p>
									<div class="score_wp">Superb
										<div class="score">7.5</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- End img_wrapper -->
				</div>

				<div class="col-md-4 col-sm-6 wow fadeIn animated" data-wow-delay="0.2s">
					<div class="img_wrapper">
						<div class="ribbon">
							<span>Popular</span>
						</div>
						<div class="price_grid">
							<sup>$</sup>440
						</div>
						<div class="img_container">
							<a href="detail-page.html">
								<img src="{{asset('frontend/images/tour_list_9.jpg')}}" width="800" height="533" class="img-responsive" alt="">
								<div class="short_info">
									<h3>Dubai</h3>
									<em>Duration 3 days</em>
									<p>
										A quam morbi ut arcu, eget neque molestie, ullamcorper congue pharetra, hendrerit odio consectetuer.
									</p>
									<div class="score_wp">Superb
										<div class="score">7.5</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- End img_wrapper -->
				</div>

			</div>
			<!-- End row -->

			<div class="main_title_2">
				<h3>View other <span>popular</span> tours</h3>
				<p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
			</div>
			<div class="row list_tours">
				<div class="col-sm-6">
					<h3>New Tours</h3>
					<ul>
						<li>
							<div>
								<a href="detail-page.html">
									<figure><img src="{{asset('frontend/images/thumb_tabs_1.jpg')}}" alt="thumb" class="img-rounded" width="60" height="60">
									</figure>
									<h4>Adipisci voluptatum ea</h4>
									<small>Duration 1hr 20 minutes</small>
									<span class="price_list">$23</span>
								</a>
							</div>
						</li>
						<li>
							<div>
								<a href="detail-page.html">
									<figure><img src="{{asset('frontend/images/thumb_tabs_2.jpg')}}" alt="thumb" class="img-rounded" width="60" height="60">
									</figure>
									<h4>Splendide suscipiantur</h4>
									<small>Duration 1hr 20 minutes</small>
									<span class="price_list">$23</span>
								</a>
							</div>
						</li>
						<li>
							<div>
								<a href="detail-page.html">
									<figure><img src="{{asset('frontend/images/thumb_tabs_3.jpg')}}" alt="thumb" class="img-rounded" width="60" height="60">
									</figure>
									<h4>Vide omnium perpetua</h4>
									<small>Duration 1hr 20 minutes</small>
									<span class="price_list">$23</span>
								</a>
							</div>
						</li>
					</ul>
				</div>

				<div class="col-sm-6">
					<h3>Special offers</h3>
					<ul>
						<li>
							<div>
								<a href="detail-page.html">
									<figure><img src="{{asset('frontend/images/thumb_tabs_4.jpg')}}" alt="thumb" class="img-rounded" width="60" height="60">
									</figure>
									<h4>Quo quidam vidisse</h4>
									<small>Duration 1hr 20 minutes</small>
									<span class="price_list"><em>$23</em>$19</span>
								</a>
							</div>
						</li>
						<li>
							<div>
								<a href="detail-page.html">
									<figure><img src="{{asset('frontend/images/thumb_tabs_5.jpg')}}" alt="thumb" class="img-rounded" width="60" height="60">
									</figure>
									<h4>Integre alterum</h4>
									<small>Duration 1hr 20 minutes</small>
									<span class="price_list"><em>$23</em>$19</span>
								</a>
							</div>
						</li>
						<li>
							<div>
								<a href="detail-page.html">
									<figure><img src="{{asset('frontend/images/thumb_tabs_6.jpg')}}" alt="thumb" class="img-rounded" width="60" height="60">
									</figure>
									<h4>Tation mollis appetere</h4>
									<small>Duration 1hr 20 minutes</small>
									<span class="price_list"><em>$23</em>$19</span>
								</a>
							</div>
						</li>
					</ul>
				</div>

			</div>
			<!-- End row -->

			<p class="text-center add_bottom_45">
				<a href="grid.html" class="btn_1">Explore all tours (24)</a>
			</p>

		</div>
	</section>
	<!-- End section -->

	<section class="container margin_60">
		<div class="main_title">
			<h3>Why choose BesTours</h3>
			<p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="box_how">
					<div class="icon_how"><span class="icon_set_1_icon-81"></span>
					</div>
					<h4>Best price guarantee</h4>
					<p>Lorem ipsum dolor sit amet, et cum civibus referrentur, at propriae forensibus qui. Duo aliquip necessitatibus ne.</p>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box_how">
					<div class="icon_how"><span class="icon_set_1_icon-94"></span>
					</div>
					<h4>Professional local guides</h4>
					<p>Lorem ipsum dolor sit amet, et cum civibus referrentur, at propriae forensibus qui. Duo aliquip necessitatibus ne.</p>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box_how">
					<div class="icon_how"><span class="icon_set_1_icon-92"></span>
					</div>
					<h4>Certifcate of Excellence</h4>
					<p>Lorem ipsum dolor sit amet, et cum civibus referrentur, at propriae forensibus qui. Duo aliquip necessitatibus ne.</p>
				</div>
			</div>
		</div>
		<!-- End Row -->
	</section>
	<!-- End Container -->

	<section class="promo_full">
		<div class="promo_full_wp">
			<div>
				<h3>What Clients say<span>Id tale utinam ius, an mei omnium recusabo iracundia.</span></h3>
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<div class="owl-carousel owl-theme carousel_testimonials">
								<div>
									<div class="box_overlay">
										<div class="pic">
											<figure><img src="{{asset('frontend/images/testimonial_1.jpg')}}" alt="" class="img-circle">
											</figure>
											<h4>Roberta<small>12 October 2015</small></h4>
										</div>
										<div class="comment">
											"Mea ad postea meliore fuisset. Timeam repudiare id eum, ex paulo dictas elaboraret sed, mel cu unum nostrud."
										</div>
									</div>
									<!-- End box_overlay -->
								</div>

								<div>
									<div class="box_overlay">
										<div class="pic">
											<figure><img src="{{asset('frontend/images/testimonial_1.jpg')}}" alt="" class="img-circle">
											</figure>
											<h4>Roberta<small>12 October 2015</small></h4>
										</div>
										<div class="comment">
											"No nam indoctum accommodare, vix ei discere civibus philosophia. Vis ea dicant diceret ocurreret."
										</div>
									</div>
									<!-- End box_overlay -->
								</div>

								<div>
									<div class="box_overlay">
										<div class="pic">
											<figure><img src="{{asset('frontend/images/testimonial_1.jpg')}}" alt="" class="img-circle">
											</figure>
											<h4>Roberta<small>12 October 2015</small></h4>
										</div>
										<div class="comment">
											"No nam indoctum accommodare, vix ei discere civibus philosophia. Vis ea dicant diceret ocurreret."
										</div>
									</div>
									<!-- End box_overlay -->
								</div>

							</div>
							<!-- End carousel_testimonials -->
						</div>
						<!-- End col-md-8 -->
					</div>
					<!-- End row -->
				</div>
				<!-- End container -->
			</div>
			<!-- End promo_full_wp -->
		</div>
		<!-- End promo_full -->
	</section>
	<!-- End section -->

@stop

@push('custom-scripts')
<script>
    'use strict';
    HeaderVideo.init({
        container: $('.header-video'),
        header: $('.header-video--media'),
        videoTrigger: $("#video-trigger"),
        autoPlayVideo: true
    });
</script>
@endpush