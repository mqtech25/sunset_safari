@extends('site.app')
@section('title', 'SUNSET - Service')
@push('extra-style')
	<!-- SPECIFIC CSS -->
	<link href="{{ asset('frontend/css/date_time_picker.css')}}" rel="stylesheet">
	<link href="{{ asset('frontend/css/timeline.css')}}" rel="stylesheet">
@endpush

@section('content')
	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/sub_header_list_museum_in.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Enjoy Maldive</h1>
				<p>"Usu habeo equidem sanctus no ex melius labitur conceptam eos"</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">
			<div class="row">
				<div class="col-md-8">

					<div class="owl-carousel owl-theme carousel_detail add_bottom_15">
						<div class="item"><img src="img/carousel/carousel_in_1.jpg" alt="">
						</div>
						<div class="item"><img src="img/carousel/carousel_in_2.jpg" alt="">
						</div>
						<div class="item"><img src="img/carousel/carousel_in_3.jpg" alt="">
						</div>
					</div>

					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">Overview</a>
						</li>
						<li><a href="#tab_2" data-toggle="tab">Reviews</a>
						</li>
						<li><a href="#tab_3" data-toggle="tab">Map</a>
						</li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane fade in active" id="tab_1">

							<p> Nec magna primis labores ex, vim cu mazim vocent. Ius modus posse invenire ei, corpora detraxit pro an, malis dolores ut has. Nam ut elit ferri patrioque, zril partem principes cum id. Sea ne assum minim quaestio, at hinc saepe graeco qui. In nec ludus repudiare scribentur, vix agam fabellas ne. Sit dicta aliquid ornatus an, sea laoreet pericula ea. Invenire voluptatum in pro, vel enim latine ne, percipit convenire eu eam.
							</p>
							<div class="row">
								<div class="col-md-6">
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="icon-ok-4"></i>
										</div>
										<div class="feature-box-info">
											<h4>Invenire voluptatum</h4>
											<p>
												Lorem ipsum dolor sit amet, ei per elitr persecuti adipiscing, ne discere temporibus nam.
											</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="icon-ok-4"></i>
										</div>
										<div class="feature-box-info">
											<h4>Nec ludus repudiare</h4>
											<p>
												Lorem ipsum dolor sit amet, ei per elitr persecuti adipiscing, ne discere temporibus nam.
											</p>
										</div>
									</div>
								</div>
								<!-- End col -->

								<div class="col-md-6">
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="icon-ok-4"></i>
										</div>
										<div class="feature-box-info">
											<h4>Vix agam fabellas</h4>
											<p>
												Lorem ipsum dolor sit amet, ei per elitr persecuti adipiscing, ne discere temporibus nam.
											</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="icon-ok-4"></i>
										</div>
										<div class="feature-box-info">
											<h4>Sea laoreet pericula</h4>
											<p>
												Lorem ipsum dolor sit amet, ei per elitr persecuti adipiscing, ne discere temporibus nam.
											</p>
										</div>
									</div>
								</div>
								<!-- End col -->
							</div>
							<!-- End row -->

							<hr>

							<h3>Program <span>(4 days)</span></h3>
							<p>
								Iudico omnesque vis at, ius an laboramus adversarium. An eirmod doctus admodum est, vero numquam et mel, an duo modo error. No affert timeam mea, legimus ceteros his in. Aperiri honestatis sit at. Eos aeque fuisset ei, case denique eam ne. Augue invidunt has ad, ullum debitis mea ei, ne aliquip dignissim nec.
							</p>
							<ul class="cbp_tmtimeline">
								<li>
									<time class="cbp_tmtime" datetime="09:30"><span>30 min.</span><span>09:30</span>
									</time>
									<div class="cbp_tmicon">
										1
									</div>
									<div class="cbp_tmlabel">
										<div class="hidden-xs">
											<img src="img/tour_plan_1.jpg" alt="" class="img-circle thumb_visit">
										</div>
										<h4>Augue invidunt has</h4>
										<p>
											Vero consequat cotidieque ad eam. Ea duis errem qui, impedit blandit sed eu. Ius diam vivendo ne.
										</p>
									</div>
								</li>
								<li>
									<time class="cbp_tmtime" datetime="11:30"><span>2 hours</span><span>11:30</span>
									</time>
									<div class="cbp_tmicon">
										2
									</div>
									<div class="cbp_tmlabel">
										<div class="hidden-xs">
											<img src="img/tour_plan_2.jpg" alt="" class="img-circle thumb_visit">
										</div>
										<h4>An eirmod doctus admodum</h4>
										<p>
											Vero consequat cotidieque ad eam. Ea duis errem qui, impedit blandit sed eu. Ius diam vivendo ne.
										</p>
									</div>
								</li>
								<li>
									<time class="cbp_tmtime" datetime="13:30"><span>1 hour</span><span>13:30</span>
									</time>
									<div class="cbp_tmicon">
										3
									</div>
									<div class="cbp_tmlabel">
										<div class="hidden-xs">
											<img src="img/tour_plan_3.jpg" alt="" class="img-circle thumb_visit">
										</div>
										<h4>Eos aeque fuisset</h4>
										<p>
											Vero consequat cotidieque ad eam. Ea duis errem qui, impedit blandit sed eu. Ius diam vivendo ne.
										</p>
									</div>
								</li>
								<li>
									<time class="cbp_tmtime" datetime="14:30"><span>2 hours</span><span>14:30</span>
									</time>
									<div class="cbp_tmicon">
										4
									</div>
									<div class="cbp_tmlabel">
										<div class="hidden-xs">
											<img src="img/tour_plan_4.jpg" alt="" class="img-circle thumb_visit">
										</div>
										<h4>No affert timeam mea</h4>
										<p>
											Vero consequat cotidieque ad eam. Ea duis errem qui, impedit blandit sed eu. Ius diam vivendo ne.
										</p>
									</div>
								</li>
							</ul>

						</div>
						<!-- End tab_1 -->

						<div class="tab-pane fade" id="tab_2">

							<div id="summary_review">
								<div class="review_score"><span>8,9</span>
								</div>
								<div class="review_score_2">
									<h4>Fabulous  <span>(Based on 34 reviews)</span></h4>
									<p>
										Vero consequat cotidieque ad eam. Ea duis errem qui, impedit blandit sed eu. Ius diam vivendo ne.
									</p>
								</div>
							</div>
							<!-- End review summary -->

							<div class="reviews-container">

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar1.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
										</div>
										<div class="rev-info">
											Admin – April 03, 2016:
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
								<!-- End review-box -->

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar2.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
										</div>
										<div class="rev-info">
											Ahsan – April 01, 2016:
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
								<!-- End review-box -->

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar3.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
										</div>
										<div class="rev-info">
											Sara – March 31, 2016:
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
								<!-- End review-box -->

							</div>
							<!-- End review-container -->

							<hr>

							<div class="add-review">
								<h4>Leave a Review</h4>
								<div id="message-review"></div>
								<form method="post" action="assets/review.php" id="review" autocomplete="off">
									<input type="hidden" id="tour_name_review" name="tour_name_review" value="General Louvre Tour">
									<div class="row">
										<div class="form-group col-md-6">
											<label>Name *</label>
											<input type="text" name="name_review" id="name_review" placeholder="" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Lastname *</label>
											<input type="text" name="lastname_review" id="lastname_review" placeholder="" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Email *</label>
											<input type="email" name="email_review" id="email_review" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Rating </label>
											<select name="rating_review" id="rating_review" class="form-control">
												<option value="">Select</option>
												<option value="1">1 (lowest)</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5 (medium)</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10 (highest)</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label>Your Review</label>
											<textarea name="review_text" id="review_text" class="form-control" style="height:130px;"></textarea>
										</div>
										<div class="form-group col-md-6">
											<label>Are you human? 3 + 1 =</label>
											<input type="text" id="verify_review" class=" form-control" placeholder="Are you human? 3 + 1 =">
										</div>
										<div class="form-group col-md-12">
											<input type="submit" value="Submit" class="btn_1" id="submit-review">
										</div>
									</div>
								</form>
							</div>

						</div>
						<!-- End tab_2 -->

						<div class="tab-pane fade" id="tab_3">
							<div id="map"></div>
							<!-- end map-->

							<div class="box_map">
								<i class="icon_set_1_icon-25"></i>
								<h4>By Train/tube</h4>
								<p>Per cu esse assentior delicatissimi, qui adipiscing dissentiunt mediocritatem in, dicat voluptaria no eam. No est alia eloquentiam. Has rebum vulputate adversarium no. Pro cibo delenit scripserit id.</p>
							</div>


							<div class="box_map">
								<i class="icon_set_1_icon-26"></i>
								<h4>By bus</h4>
								<p>Per cu esse assentior delicatissimi, qui adipiscing dissentiunt mediocritatem in, dicat voluptaria no eam. No est alia eloquentiam. Has rebum vulputate adversarium no. Pro cibo delenit scripserit id.</p>
							</div>

							<div class="box_map">
								<i class="icon_set_1_icon-21"></i>
								<h4>By Taxi/cabs</h4>
								<p>Per cu esse assentior delicatissimi, qui adipiscing dissentiunt mediocritatem in, dicat voluptaria no eam. No est alia eloquentiam. Has rebum vulputate adversarium no. Pro cibo delenit scripserit id.</p>
							</div>

						</div>
						<!-- End tab_3 -->
					</div>
					<!-- End tabs -->
				</div>
				<!-- End Col -->

				<aside class="col-md-4">
					<div class="box_style_1">
						<div class="price">
							<strong>$649</strong><small>per person</small>
						</div>
						<ul class="list_ok">
							<li>Sea te propriae lobortis</li>
							<li>Aperiri electram</li>
							<li>12 Quando omnium</li>
							<li>4 Vide urbanitas</li>
						</ul>
						<small>*Free for childs under 8 years old</small>
					</div>
					<div class="box_style_2">
						<h3>Book Your Tour<span>Free service - Confirmed immediately</span></h3>
						<div id="message-booking"></div>
						<form method="post" action="assets/check_avail.php" id="check_avail" autocomplete="off">
							<input type="hidden" id="tour_name" name="tour_name" value="General Louvre Tour">
							<table id="tickets" class="table">
								<thead>
									<tr>
										<th>Tickets</th>

										<th>Quantity</th>
										<th class="text-center"><span class="subtotal">Subtotal</span>

										</th>
									</tr>
								</thead>
								<tfoot>
									<tr class="total_row">
										<td colspan="2"><strong>TOTAL</strong>
										</td>
										<td class="text-center">
											<input name="total" id="total" value="">
										</td>
									</tr>
								</tfoot>
								<tbody>
									<tr>
										<td><strong>Adult</strong><a href="#" class="tooltip-1" data-placement="top" title="" data-original-title="16 - 65 years old"><sup class="icon-info-4"></sup></a>
											<span class="price">$8.25</span>
										</td>
										<td>
											<div class="styled-select">
												<select class="form-control" name="adults" id="adults">
													<option value="">Select</option>
													<option value="0">0</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
												</select>
											</div>
										</td>
										<td class="text-center"><span class="subtotal">$0</span>
										</td>
									</tr>
									<tr>
										<td><strong>Senior</strong><a href="#" class="tooltip-1" data-placement="top" title="" data-original-title="Over 65 years old"><sup class="icon-info-4"></sup></a><span class="price">$6.75</span>
										</td>
										<td>
											<div class="styled-select">
												<select class="form-control" name="senior" id="senior">
													<option value="">Select</option>
													<option value="0">0</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
												</select>
											</div>
										</td>
										<td class="text-center"><span class="subtotal">$0</span>
										</td>
									</tr>
									<tr>
										<td><strong>Student</strong> <span class="price">$6.75</span> </td>
										<td>
											<div class="styled-select">
												<select class="form-control" name="student" id="student">
													<option value="">Select</option>
													<option value="0">0</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
												</select>
											</div>
										</td>
										<td class="text-center"><span class="subtotal">$0</span>
										</td>
									</tr>
								</tbody>
							</table>

							<div class="form-group">
								<label>When?</label>
								<input type="text" class="form-control" id="date_pick" name="date_pick" data-date-format="M d, D" placeholder="Select a date">
							</div>
							<div class="form-group">
								<label>Name and Lastname</label>
								<input type="text" class="form-control" id="name_lastname_booking" name="name_lastname_booking" placeholder="Name and Lastname">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" id="email_booking" name="email_booking" placeholder="Email">
							</div>
							<div class="form-group">
								<label>Telephone</label>
								<input type="text" class="form-control" id="telephone_booking" name="telephone_booking" placeholder="Telephone">
							</div>
							<div class="form-group add_bottom_30">
								<label>Are you human? 3 + 1 =</label>
								<input type="text" id="verify_booking" class=" form-control" placeholder="Are you human? 3 + 1 =">
							</div>
							<div class="form-group">
								<input type="submit" value="Book now" class="btn_full" id="submit-booking">
							</div>

						</form>
						<hr>
						<a href="#0" class="btn_outline"> or Contact us</a>
						<a href="tel://004542344599" id="phone_2"><i class="icon_set_1_icon-91"></i>+45 423 445 99</a>

					</div>
				</aside>
			</div>
			<!-- End row -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	<div class="container margin_30">
		<h3 class="second_title">Related tours</h3>
		<div class="owl-carousel owl-theme carousel add_bottom_30">

			<div>
				<div class="img_wrapper">
					<div class="price_grid">
						<sup>$</sup>23
					</div>
					<!-- End tools i-->
					<div class="img_container">
						<a href="detail-page.html">
							<img src="img/tour_list_1.jpg" width="800" height="533" class="img-responsive" alt="">
							<div class="short_info">
								<h3>Las Vegas</h3>
								<em>Duration 3 days</em>
								<p>
									A quam morbi ut arcu, eget neque molestie, ullamcorper congue pharetra, hendrerit odio consectetuer.
								</p>
								<div class="score_wp">
									<div class="score">7.5</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<!-- End img_wrapper -->
			</div>

			<div>
				<div class="img_wrapper">
					<div class="price_grid">
						<sup>$</sup>32
					</div>
					<!-- End tools i-->
					<div class="img_container">
						<a href="detail-page.html">
							<img src="img/tour_list_5.jpg" width="800" height="533" class="img-responsive" alt="">
							<div class="short_info">
								<h3>Rome - Vatican</h3>
								<em>Duration 3 days</em>
								<p>
									A quam morbi ut arcu, eget neque molestie, ullamcorper congue pharetra, hendrerit odio consectetuer.
								</p>
								<div class="score_wp">
									<div class="score">7.5</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<!-- End img_wrapper -->
			</div>

			<div>
				<div class="img_wrapper">
					<div class="price_grid">
						<sup>$</sup>20
					</div>
					<!-- End tools i-->
					<div class="img_container">
						<a href="detail-page.html">
							<img src="img/tour_list_6.jpg" width="800" height="533" class="img-responsive" alt="">
							<div class="short_info">
								<h3>Maldive</h3>
								<em>Duration 3 days</em>
								<p>
									A quam morbi ut arcu, eget neque molestie, ullamcorper congue pharetra, hendrerit odio consectetuer.
								</p>
								<div class="score_wp">
									<div class="score">7.5</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<!-- End img_wrapper -->
			</div>

			<div>
				<div class="img_wrapper">
					<div class="price_grid">
						<sup>$</sup>22
					</div>
					<!-- End tools i-->
					<div class="img_container">
						<a href="detail-page.html">
							<img src="img/tour_list_7.jpg" width="800" height="533" class="img-responsive" alt="">
							<div class="short_info">
								<h3>London</h3>
								<em>Duration 3 days</em>
								<p>
									A quam morbi ut arcu, eget neque molestie, ullamcorper congue pharetra, hendrerit odio consectetuer.
								</p>
								<div class="score_wp">
									<div class="score">7.5</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<!-- End img_wrapper -->
			</div>

		</div>
		<!-- End carousel -->
	</div>
	<!-- End container -->
@stop

@push('custom-scripts')
<!-- SPECIFIC SCRIPTS -->
<script src="{{ asset('frontend/js/bootstrap-datepicker.js')}}"></script>
<script>
    $('#date_pick').datepicker();
</script>
<script src="{{ asset('frontend/js/sidebar_carousel_detail_page_func.js')}}"></script>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="{{ asset('frontend/js/map.js')}}"></script>
<script src="{{ asset('frontend/js/infobox.js')}}"></script>
@endpush