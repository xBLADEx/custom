jQuery(document).ready(function($){
	// Create Mobile Menu
	var mobileMenu = $('.mainNav').clone();
	mobileMenu.appendTo('.mobileMenu');
	// Toggle Moblie Menu
	$('a.menuIcon').on('click', function(e) {
		e.preventDefault();
		$('.mobileMenu').slideToggle('fast');
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