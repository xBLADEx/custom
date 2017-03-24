<?php
/**
 * Enqueue
 *
 * @package Custom
 */

/**
 * Enqueue Scripts
 *
 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_style.
 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @see https://fonts.google.com/specimen/Lato?selection.family=Lato:300,400,700,900.
 * @see https://fonts.google.com/specimen/Halant?selection.family=Halant:400,600.
 * @example wp_enqueue_style( $handle, $src, $deps, $ver, $media ).
 * @example wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer ).
 */
function custom_enqueue() {
	if ( ! is_admin() ) {
		// Styles.
		wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,900|Halant:400,600', array(), '1.0' );
		// wp_enqueue_style( 'jquery-ui-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css', array(), '1.11.4' );
		wp_enqueue_style( 'custom', THEME_CSS . '/custom.css', array(), '1.0' );

		// Scripts.
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', array(), '2.2.0', true );
		// wp_enqueue_script( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', array('jquery'), '1.11.4', true );
		wp_enqueue_script( 'custom', THEME_JS . '/custom.js', array(), '6.2.4', true );
	}
}

add_action( 'wp_enqueue_scripts', 'custom_enqueue' );
