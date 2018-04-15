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
	// Post Related.
	add_filter( 'get_image_tag_class', 'custom_image_classes', 0, 4 );
	add_filter( 'get_image_tag', 'custom_image_remove_sizes', 0, 4 );
	add_filter( 'image_send_to_editor', 'custom_image_to_relative', 5, 8 );
	// Remove Version
	add_filter( 'style_loader_src', 'custom_remove_cssjs_ver', 10, 2 );
	add_filter( 'script_loader_src', 'custom_remove_cssjs_ver', 10, 2 );
	// Widgets Comments
	add_action( 'widgets_init', 'custom_remove_recent_comments_style' );
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

/**
 * Remove All Class Names Except Alignment
 *
 * @param  string $class Class.
 * @param  string $id    ID.
 * @param  string $align Align.
 * @param  string $size  Size.
 * @return string        New image tag.
 */
function custom_image_classes( $class, $id, $align, $size ) {
	$align = 'align' . esc_attr( $align );

	return $align;
}

/**
 * Remove Image Attributes Width And Height
 * Remove width and height on insert image into post.
 *
 * @param  string $html  HTML.
 * @param  string $id    ID.
 * @param  string $alt   Alt.
 * @param  string $title New inserted image without size attributes.
 */
function custom_image_remove_sizes( $html, $id, $alt, $title ) {
	return preg_replace(
		[
			'/\s+width="\d+"/i',
			'/\s+height="\d+"/i',
			'/alt=""/i',
		],
		[
			'',
			'',
			'',
			'alt="' . $title . '"',
		],
		$html
	);
}

/**
 * Image SRC Attribute Relative Path
 * Remove absolute URL on insert image into post.
 *
 * @param  string $html    HTML.
 * @param  string $id      ID.
 * @param  string $caption Caption.
 * @param  string $title   Title.
 * @param  string $align   Align.
 * @param  string $url     URL.
 * @param  string $size    Size.
 * @param  string $alt     Alt.
 * @return string          New image inserted clean.
 */
function custom_image_to_relative( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
	$sp          = strpos( $html, 'src=' ) + 5;
	$ep          = strpos( $html, '\"', $sp );
	$imageurl    = substr( $html, $sp, $ep - $sp );
	$relativeurl = str_replace( 'http://', '', $imageurl );
	$sp          = strpos( $relativeurl, '/' );
	$relativeurl = substr( $relativeurl, $sp );
	$html        = str_replace( $imageurl, $relativeurl, $html );

	return $html;
}
