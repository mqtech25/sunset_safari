/* ==============================================
First carousel + Second carousel
=============================================== */
(function ($) {
	"use strict";
$('.carousel_detail').owlCarousel({
	animateOut: 'fadeOut',
	animateIn: 'fadeIn',
	responsiveClass: true,
	margin: 0,
	items: 1,
	responsiveClass: true,
	responsive: {
		600: {
			items: 1
		},
		1000: {
			items: 1,
			nav: false
		}
	}
});
$('.carousel').owlCarousel({
	loop: false,
	autoplay: false,
	smartSpeed: 300,
	nav: false,
	margin: 0,
	responsiveClass: true,
	responsive: {
		0: {
			items: 1
		},
		600: {
			items: 2
		},
		1200: {
			items: 4,
			dots: false
		}
	}
});
})(window.jQuery);
