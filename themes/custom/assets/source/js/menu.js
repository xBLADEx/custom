//--------------------------------------------------------------
// MENU
//--------------------------------------------------------------

const menuTrigger = document.querySelector('[data-js-menu-trigger]');
const menu = document.querySelector('[data-js-menu]');

function toggleMenu() {
	menu.classList.toggle('is-active');
}

if (menuTrigger && menu) {
	menuTrigger.addEventListener('click', toggleMenu);
}
