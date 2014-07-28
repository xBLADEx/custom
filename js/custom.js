jQuery(document).ready(function($){
	// Create Mobile Menu
	var mobileMenu = $('.mainNav').clone();
	mobileMenu.appendTo('.mobileMenu');
	// Toggle Moblie Menu
	$('a.menuIcon').on('click', function(e) {
		e.preventDefault();
		$('.mobileMenu').slideToggle('fast');
	});
	// Initialize Foundation
	$(document).foundation();
});