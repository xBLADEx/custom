//--------------------------------------------------------------
// CUSTOM
//--------------------------------------------------------------

const mainNav = $('.main-nav');
const menuIcon = $('.mobile-menu-icon');

menuIcon.on('click', e => {
	e.preventDefault();
	mainNav.slideToggle();
});
