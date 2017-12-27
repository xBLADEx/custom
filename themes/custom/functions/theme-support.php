<?php
/**
 * Support
 *
 * @package Custom
 */

/**
 * Theme Support
 */
function custom_support() {
	// Featured Images.
	add_theme_support( 'post-thumbnails' );

	// Automatic Feed Links & Post Formats.
	// add_theme_support( 'automatic-feed-links' );

	/**
	 * Post Formats
	 *
	 * @see http://codex.wordpress.org/Post_Formats.
	 */
	// add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery', 'status' ) );
}

add_action( 'after_setup_theme', 'custom_support' );

/**
 * Image Sizes
 */
// add_image_size( 'name', 150, 80 );

/**
* Hide ACF Menu
*
* @author Rich Edmunds
*/
function base_hide_acf_admin() {
	// Get the current site url
	$site_url = get_bloginfo( 'url' );

	$show_menu = [
		'https://custom.test',
	];

	// If the url matches our dev url show the menu.
	if ( in_array( $site_url, $show_menu ) ) {
		// Show the acf menu item
		return true;
	} else {
		// Hide the acf menu item
		return false;
	}
}

add_filter( 'acf/settings/show_admin', 'base_hide_acf_admin' );
