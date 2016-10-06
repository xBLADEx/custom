/*
====================
	CUSTOM JQUERY
====================
*/

(function($) {

	'use strict';

	$(function() { // Shorthand Document Ready
		// Mobile Menu
		var mainNav = $('.main-nav');
		$('.menu-icon').on('click', function(e) {
			e.preventDefault();
			mainNav.slideToggle();
		});
		// Slick Slider
		$('.home-slider').slick({
	        dots: true,
	        infinite: true,
	        autoplay: false,
	        speed: 2000,
	        autoplaySpeed: 1000,
	        slidesToShow: 1,
	        slidesToScroll: 1,
	        pauseOnHover: false,
	        fade: false
	    });
		// Initialize Foundation
		$(document).foundation();
	});

}(jQuery));