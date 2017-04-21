<?php
/**
 * Clean
 *
 * @package Custom
 */

/**
 * Clean Header
 */
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Removes the type="application/rss+xml" /feed link.
remove_action( 'wp_head', 'wp_generator' ); // This removes the WordPress version.
remove_action( 'wp_head', 'rsd_link' ); // This removes Windows Live Writer (WLW).
remove_action( 'wp_head', 'wlwmanifest_link' ); // This removes Windows Live Writer (WLW).
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Removes rel='prev' and rel='next'.
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // Remove shortlink.
// 4.2 WordPress Emoji.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
// Post Related.
add_filter( 'img_caption_shortcode', 'reverie_cleaner_caption', 10, 3 );
add_filter( 'get_image_tag_class', 'reverie_image_tag_class', 0, 4 );
add_filter( 'get_image_tag', 'reverie_image_editor', 0, 4 );
add_filter( 'image_send_to_editor', 're_image_to_relative', 5, 8 );

/**
 * Remove Open Sans Font
 */
function custom_remove_wp_open_sans() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
}

add_action( 'wp_enqueue_scripts', 'custom_remove_wp_open_sans' );

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

add_filter( 'style_loader_src', 'custom_remove_cssjs_ver', 10, 2 );

add_filter( 'script_loader_src', 'custom_remove_cssjs_ver', 10, 2 );

/**
 * Recent Comments
 * Remove recent comments style tag.
 */
function custom_remove_recent_comments_style() {
	global $wp_widget_factory;

	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}

add_action( 'widgets_init', 'custom_remove_recent_comments_style' );

/**
 * Title Tag
 *
 * @param  string $title Title.
 * @param  string $sep   Separator.
 * @return string        New title.
 */
function custom_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name.
	$title .= ' ' . get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		// Translators: Page number.
		$title .= " $sep " . sprintf( __( 'Page %s', 'custom' ), max( $paged, $page ) );
	}

	return $title;
}

add_filter( 'wp_title', 'custom_title', 10, 2 );


// Post Related.
if ( ! function_exists( 'reverie_cleaner_caption' ) ) {
	/**
	 * Clean Caption
	 * Customized the output of caption, you can remove the filter to restore back to the WP default output.
	 * See: http://devpress.com/blog/captions-in-wordpress/
	 *
	 * @param  string $output  Output.
	 * @param  string $attr    Attribute.
	 * @param  string $content Content.
	 * @return string          New ouput.
	 */
	function reverie_cleaner_caption( $output, $attr, $content ) {
		// We're not worried abut captions in feeds, so just return the output here.
		if ( is_feed() ) {
			return $output;
		}

		// Set up the default arguments.
		$defaults = array(
			'id' => '',
			'align' => 'alignnone',
			'width' => '',
			'caption' => '',
		);

		// Merge the defaults with user input.
		$attr = shortcode_atts( $defaults, $attr );

		// If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags.
		if ( 1 > $attr['width'] || empty( $attr['caption'] ) ) {
			return $content;
		}

		// Set up the attributes for the caption <div>.
		$attributes = ' class="figure ' . esc_attr( $attr['align'] ) . '"';

		// Open the caption <div>.
		$output = '<figure' . $attributes . '>';

		// Allow shortcodes for the content the caption was created for.
		$output .= do_shortcode( $content );

		// Append the caption text.
		$output .= '<figcaption>' . $attr['caption'] . '</figcaption>';

		// Close the caption </div>.
		$output .= '</figure>';

		// Return the formatted, clean caption.
		return $output;
	}
}

// Clean Inserted Image Attributes.
if ( ! function_exists( 'reverie_image_tag_class' ) ) {
	/**
	 * Image Tag Class
	 * Clean the output of attributes of images in editor.
	 * See: http://www.sitepoint.com/wordpress-change-img-tag-html/
	 *
	 * @param  string $class Class.
	 * @param  string $id    ID.
	 * @param  string $align Align.
	 * @param  string $size  Size.
	 * @return string        New image tag.
	 */
	function reverie_image_tag_class( $class, $id, $align, $size ) {
		$align = 'align' . esc_attr( $align );

		return $align;
	}
}

if ( ! function_exists( 'reverie_image_editor' ) ) {
	/**
	 * Image Editor
	 * Remove width and height in editor, for a better responsive world.
	 *
	 * @param  string $html  HTML.
	 * @param  string $id    ID.
	 * @param  string $alt   Alt.
	 * @param  string $title New inserted image without size attributes.
	 */
	function reverie_image_editor( $html, $id, $alt, $title ) {
		return preg_replace(
			array(
				'/\s+width="\d+"/i',
				'/\s+height="\d+"/i',
				'/alt=""/i',
			),
			array(
				'',
				'',
				'',
				'alt="' . $title . '"',
			),
			$html
		);
	}
}

/**
 * Image To Relative
 * Remove Absolute URL on insert image
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
function re_image_to_relative( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
	$sp = strpos( $html, 'src=' ) + 5;
	$ep = strpos( $html, '\"', $sp );

	$imageurl = substr( $html, $sp, $ep-$sp );

	$relativeurl = str_replace( 'http://', '', $imageurl );
	$sp = strpos( $relativeurl, '/' );
	$relativeurl = substr( $relativeurl, $sp );

	$html = str_replace( $imageurl, $relativeurl, $html );

	return $html;
}
