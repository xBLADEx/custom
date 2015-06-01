<?php
/* 
====================
	FUNCTIONS - ENQUEUE
====================
*/

if ( ! function_exists( 'custom_enqueue' ) ) {
	function custom_enqueue() { 
		if ( ! is_admin() ) { 
			// http://codex.wordpress.org/Function_Reference/wp_enqueue_style
			// wp_enqueue_style( $handle, $src, $deps, $ver, $media );
			// wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300,400', array(), '1.0' );
			wp_enqueue_style( 'normalize', THEME_CSS . '/normalize.css', array(), '3.0.1' );
			wp_enqueue_style( 'foundation', THEME_CSS . '/foundation.css', array(), '5.5.1' );
			// wp_enqueue_style( 'jquery-ui-css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css', array(), '1.11.2' );
			wp_enqueue_style( 'slick', THEME_CSS . '/slick.css', array(), '1.0' );
			wp_enqueue_style( 'custom', get_stylesheet_uri(), array(), '5.5.1' );
			// http://codex.wordpress.org/Function_Reference/wp_enqueue_script
			// wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
			wp_deregister_script( 'jquery' );
			wp_enqueue_script( 'jquery', THEME_JS . '/vendor/jquery.js', array(), '2.1.1', true );
			// wp_enqueue_script( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js', array(), '1.11.2', true );
			wp_enqueue_script( 'foundation', THEME_JS . '/foundation.min.js', array(), '5.5.1', true );
			wp_enqueue_script( 'modernizr', THEME_JS . '/vendor/modernizr.js', array(), '2.8.3', true );
			wp_enqueue_script( 'slick', THEME_JS . '/slick.min.js', array(), '1.3.6', true );
			wp_enqueue_script( 'custom', THEME_JS . '/custom.js', array(), '1.0', true );
		}
	}
	add_action( 'wp_enqueue_scripts', 'custom_enqueue' );
}