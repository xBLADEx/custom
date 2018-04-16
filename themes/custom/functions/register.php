<?php
/**
 * Register
 *
 * @package Custom
 */

/**
 * Sidebars
 */
function custom_widgets() {
	// Sidebar.
	register_sidebar( [
		'name'          => __( 'Sidebar', 'custom' ),
		'description'   => '',
		'id'            => 'sidebar',
		'class'         => 'sidebar',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	] );
}

add_action( 'widgets_init', 'custom_widgets' );

/**
 * Navigation
 *
 * @see http://codex.wordpress.org/Function_Reference/register_nav_menus.
 */
register_nav_menus( [
	'main_menu' => __( 'Main Menu', 'custom' ),
] );
