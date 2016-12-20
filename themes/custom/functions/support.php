<?php
/**
 * Support
 *
 * @package Custom
 */

if ( ! function_exists( 'custom_support' ) ) {

	/**
	 * Theme Support
	 */
	function custom_support() {
		// Featured Images.
		add_theme_support( 'post-thumbnails' );
		// Automatic Feed Links & Post Formats.
		// add_theme_support( 'automatic-feed-links' );
		// Post Formats http://codex.wordpress.org/Post_Formats.
		// add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery', 'status' ) );
	}

	add_action( 'after_setup_theme', 'custom_support' );
}

// Image Size.
// add_image_size( 'name', 150, 80 );
