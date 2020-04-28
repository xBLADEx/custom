<?php
/**
 * Navigation
 *
 * @see http://codex.wordpress.org/Function_Reference/wp_nav_menu.
 * @package Custom
 */

wp_nav_menu(
	[
		'theme_location'  => 'main_menu',
		'menu'            => '',
		'container'       => false,
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => '',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => false,
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="menu" class="navigation__menu" data-js-menu>%3$s</ul>',
		'depth'           => 2,
		'walker'          => new Custom_Nav_Menu(),
	]
);
