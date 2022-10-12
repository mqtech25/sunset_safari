 <!-- ========================= FOOTER =========================  -->

    <footer>
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3">
					<h3>Need help?</h3>
					<a href="tel://{{config('settings.default_phone_number')}}" id="phone">{{config('settings.default_phone_number')}}</a>
					<a href="mailto:{{config('settings.default_email_address')}}" id="email_footer">{{config('settings.default_email_address')}} </a>
				</div>
				<div class="col-md-2 col-sm-3">
					<h3>About</h3>
					<ul>
						<li><a href="#">About us</a>
						</li>
						<li><a href="#">FAQ</a>
						</li>
						<li><a href="#">Login</a>
						</li>
						<li><a href="#">Register</a>
						</li>
						<li><a href="#">Terms and condition</a>
						</li>
					</ul>
				</div>
				<div class="col-md-4 col-sm-6">
					<h3>Twitter feed</h3>
					<div class="latest-tweets" data-number="10" data-username="ansonika" data-mode="fade" data-pager="false" data-nextselector=".tweets-next" data-prevselector=".tweets-prev" data-adaptiveheight="true">
						<!-- data-username="your twitter username" -->
					</div>
					<div class="tweet-control">
						<div class="tweets-prev"></div>
						<div class="tweets-next"></div>
					</div>
					<!-- End .tweet-control -->
				</div>
				<div class="col-md-3 col-sm-12">
					<h3>Newsletter</h3>
					<div id="message-newsletter_2">
					</div>
					<form method="post" action="assets/newsletter.php" name="newsletter_2" id="newsletter_2">
						<div class="form-group">
							<input name="email_newsletter_2" id="email_newsletter_2" type="email" value="" placeholder="Your email" class="form-control">
						</div>
						<input type="submit" value="Subscribe" class="btn_1" id="submit-newsletter_2">
					</form>
				</div>
			</div>
			<!-- End row -->
			<hr>
			<div class="row">
				<div class="col-sm-8">
					<div class="styled-select">
						<select class="form-control" name="lang" id="lang">
							<option value="English" selected>English</option>
							<option value="French">French</option>
							<option value="Spanish">Spanish</option>
							<option value="Russian">Russian</option>
						</select>
					</div>
					<span id="copy">© {{ config('settings.site_name') }} 2022 - All rights reserved</span>
				</div>
				<div class="col-sm-4" id="social_footer">
					<ul>
						<li><a href="#"><i class="icon-facebook"></i></a>
						</li>
						<li><a href="#"><i class="icon-twitter"></i></a>
						</li>
						<li><a href="#"><i class="icon-google"></i></a>
						</li>
						<li><a href="#"><i class="icon-instagram"></i></a>
						</li>
					</ul>
				</div>
			</div>
			<!-- End row -->
		</div>
		<!-- End container -->
	</footer>
	<!-- End footer -->

	<div id="toTop"></div>
	<!-- Back to top button -->

	<!-- Search Menu -->
	<div class="search-overlay-menu">
		<span class="search-overlay-close"><i class="icon_close"></i></span>
		<form role="search" id="searchform" method="get">
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon-search-6"></i>
			</button>
		</form>
	</div>
	<!-- End Search Menu -->
  <!-- ========================= FOOTER END // =========================  -->
  