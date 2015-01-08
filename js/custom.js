jQuery(document).ready(function($){
	// Mobile Menu
	$('.menu-icon').on('click', function(e){
		e.preventDefault();
		$('.main-nav').slideToggle();
	});
	// Slick Slider
	$('.home-slider').slick({
        dots: true,
        infinite: true,
        autoplay: false,
        speed: 2000,
        autoplaySpeed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1
    });
	// IE 9 Placeholder Fix
	$('[placeholder]').focus(function() {
	  var input = $(this);
	  if (input.val() == input.attr('placeholder')) {
	    input.val('');
	    input.removeClass('placeholder');
	  }
	}).blur(function() {
	  var input = $(this);
	  if (input.val() == '' || input.val() == input.attr('placeholder')) {
	    input.addClass('placeholder');
	    input.val(input.attr('placeholder'));
	  }
	}).blur();
	// Clear Placeholder Text
	$('[placeholder]').parents('form').submit(function() {
	  $(this).find('[placeholder]').each(function() {
	    var input = $(this);
	    if (input.val() == input.attr('placeholder')) {
	      input.val('');
	    }
	  })
	});
	// Initialize Foundation
	$(document).foundation();
});