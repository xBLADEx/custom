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
	    // IE 9 Placeholder Fix
	    if ( ! Modernizr.input.placeholder ) {
			$('[placeholder]').focus(function() {
				var input = $(this);
				if ( input.val() == input.attr('placeholder') ) { input.val(''); }
			}).blur(function() {
				var input = $(this);
				if ( input.val() == '' || input.val() == input.attr('placeholder') ) { input.val(input.attr('placeholder')); }
			}).blur();
			// Clear Placeholder Text
			$('[placeholder]').parents('form').submit(function() {
				$(this).find('[placeholder]').each(function() {
					var input = $(this);
					if ( input.val() == input.attr('placeholder') ) { input.val(''); }
				});
			});
		}
		// Initialize Foundation
		$(document).foundation();
	});

	var BrowserDetect = {
		init: function () {
			this.browser = this.searchString(this.dataBrowser) || "Other";
			this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "Unknown";
		},
		searchString: function (data) {
			for (var i = 0; i < data.length; i++) {
				var dataString = data[i].string;
				this.versionSearchString = data[i].subString;

				if (dataString.indexOf(data[i].subString) !== -1) {
					return data[i].identity;
				}
			}
		},
		searchVersion: function (dataString) {
			var index = dataString.indexOf(this.versionSearchString);
			if (index === -1) {
				return;
			}

			var rv = dataString.indexOf("rv:");
			if (this.versionSearchString === "Trident" && rv !== -1) {
				return parseFloat(dataString.substring(rv + 3));
			} else {
				return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
			}
		},

		dataBrowser: [
		{string: navigator.userAgent, subString: "Chrome", identity: "Chrome"},
		{string: navigator.userAgent, subString: "MSIE", identity: "Explorer"},
		{string: navigator.userAgent, subString: "Trident", identity: "Explorer"},
		{string: navigator.userAgent, subString: "Firefox", identity: "Firefox"},
		{string: navigator.userAgent, subString: "Safari", identity: "Safari"},
		{string: navigator.userAgent, subString: "Opera", identity: "Opera"}
		]

	};

	BrowserDetect.init();
	if ( BrowserDetect.browser == 'Explorer' && BrowserDetect.version <= 9 ) {
		var message = $("<p class='browser-banner'>You are using an outdated browser. Please <a href='http://browsehappy.com/' target='_blank'>upgrade your browser</a> to improve your experience.</p>");
		message.prependTo('body');
	}
	//document.write("You are using <b>" + BrowserDetect.browser + "</b> with version <b>" + BrowserDetect.version + "</b>");

}(jQuery));