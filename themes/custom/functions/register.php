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
	// Sidebar Right.
	register_sidebar(
		array(
			'name'          => __( 'Sidebar Right', 'custom' ),
			'id'            => 'sidebar-right',
			'description'   => '',
			'class'         => 'sidebar-right',
			'before_widget' => '<div class="sidebar-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>',
		)
	);

	// Sidebar Left.
	register_sidebar(
		array(
			'name'          => __( 'Sidebar Left', 'custom' ),
			'id'            => 'sidebar-left',
			'description'   => '',
			'class'         => 'sidebar-left',
			'before_widget' => '<div class="sidebar-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>',
		)
	);

	// Sidebar Blog.
	register_sidebar(
		array(
			'name'          => __( 'Sidebar Blog', 'custom' ),
			'id'            => 'sidebar-blog',
			'description'   => '',
			'class'         => 'sidebar-blog',
			'before_widget' => '<div class="sidebar-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>',
		)
	);
}

add_action( 'widgets_init', 'custom_widgets' );


/**
 * Navigation
 *
 * @see http://codex.wordpress.org/Function_Reference/register_nav_menus.
 */
register_nav_menus(
	array(
		'main_nav'      => __( 'Main Navigation', 'custom' ),
		'secondary_nav' => __( 'Secondary Navigation', 'custom' ),
	)
);
