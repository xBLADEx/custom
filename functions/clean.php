<?php
/**
 * Clean
 *
 * @package Custom
 */

/**
 * Clean Header
 */
function custom_clean_header() {
	remove_action( 'wp_head', 'wp_generator' ); // This removes the WordPress version.
	remove_action( 'wp_head', 'wlwmanifest_link' ); // This removes Windows Live Writer (WLW).
	remove_action( 'wp_head', 'rsd_link' ); // This removes ability to edit blog from external services.
	remove_action( 'wp_head', 'feed_links_extra', 3 ); // Removes the type="application/rss+xml" /feed link.
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // Remove shortlink.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Removes rel='prev' and rel='next'.

	// 4.2 WordPress Emoji.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); // Admin
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); // Admin

	// Remove Version
	add_filter( 'style_loader_src', 'custom_remove_cssjs_ver', 10, 2 );
	add_filter( 'script_loader_src', 'custom_remove_cssjs_ver', 10, 2 );

	// Widgets Comments
	add_action( 'widgets_init', 'custom_remove_recent_comments_style' );

	// Remove WP Caption Style Width
	add_filter( 'img_caption_shortcode_width', '__return_false' );
}

add_action( 'after_setup_theme', 'custom_clean_header' );

/**
 * Remove CSS / JS Version Number
 * Remove version number after Scripts and Styles.
 *
 * @param  string $src Number.
 * @return string      Stripped version.
 */
function custom_remove_cssjs_ver( $src ) {
	if ( strpos( $src, '?ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}

	return $src;
}

/**
 * Recent Comments
 * Remove recent comments style tag.
 */
function custom_remove_recent_comments_style() {
	global $wp_widget_factory;

	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
