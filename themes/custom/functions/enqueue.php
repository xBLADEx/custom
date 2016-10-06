<?php
//--------------------------------------------------------------
// Enqueue
//--------------------------------------------------------------

if ( ! function_exists( 'custom_enqueue' ) ) {
	function custom_enqueue() {
		if ( ! is_admin() ) {
			// http://codex.wordpress.org/Function_Reference/wp_enqueue_style
			// wp_enqueue_style( $handle, $src, $deps, $ver, $media );
			// wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300,400', array(), '1.0' );
			wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,900|Halant:400,600', array(), '1.0' );
			// wp_enqueue_style( 'jquery-ui-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css', array(), '1.11.4' );
			wp_enqueue_style( 'custom', THEME_CSS . '/custom.css', array(), '1.0' );
			//wp_enqueue_style( 'custom', get_stylesheet_uri(), array(), '5.5.1' );

			// http://codex.wordpress.org/Function_Reference/wp_enqueue_script
			// wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
			wp_deregister_script( 'jquery' );
			wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', array(), '2.2.0', true );
			// wp_enqueue_script( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', array('jquery'), '1.11.4', true );
			wp_enqueue_script( 'custom', THEME_JS . '/custom.min.js', array(), '5.5.2', true );
		}
	}
	add_action( 'wp_enqueue_scripts', 'custom_enqueue' );
}
