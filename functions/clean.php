<?php
/* 
====================
	FUNCTIONS - CLEAN
====================
*/

remove_action( 'wp_head', 'feed_links_extra', 3 ); // Removes the type="application/rss+xml" /feed link
remove_action( 'wp_head', 'wp_generator' ); // This removes the WordPress version
remove_action( 'wp_head', 'rsd_link' ); // This removes Windows Live Writer (WLW)
remove_action( 'wp_head', 'wlwmanifest_link' ); // This removes Windows Live Writer (WLW)
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Removes rel='prev' and rel='next'
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // Remove shortlink
// 4.2 WordPress Emoji
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
// POST RELATED
add_filter( 'img_caption_shortcode', 'reverie_cleaner_caption', 10, 3 );
add_filter( 'get_image_tag_class', 'reverie_image_tag_class', 0, 4 );
add_filter( 'get_image_tag', 'reverie_image_editor', 0, 4 );
add_filter( 'the_content', 'reverie_img_unautop', 30 );
/* 
====================
	REMOVE CSS / JS VERSION
====================
*/
if ( ! function_exists( 'remove_cssjs_ver' ) ) {
	function remove_cssjs_ver( $src ) { // Remove version number after Scripts and Styles
	    if ( strpos( $src, '?ver=' ) ) {
	        $src = remove_query_arg( 'ver', $src );
	    }
	    return $src;
	}
	add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
	add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
}

if ( ! function_exists( 'remove_recent_comments_style' ) ) {
	function remove_recent_comments_style() { // Remove recent comments style tag
		global $wp_widget_factory;  
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
	}
	add_action( 'widgets_init', 'remove_recent_comments_style' );
}
/* 
====================
	TITLE TAG
====================
*/
if ( ! function_exists( 'custom_title' ) ) {
	function custom_title( $title, $sep ) {
		if ( is_feed() ) { return $title; }
		global $page, $paged;
		// Add the blog name
		$title .= " " . get_bloginfo( 'name', 'display' );
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}
		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
		}
		return $title;
	}
	add_filter( 'wp_title', 'custom_title', 10, 2 );
}
/* 
====================
	POST RELATED
====================
*/
// Customized the output of caption, you can remove the filter to restore back to the WP default output. 
// Courtesy of DevPress. http://devpress.com/blog/captions-in-wordpress/
if ( ! function_exists( 'reverie_cleaner_caption' ) ) {
	function reverie_cleaner_caption( $output, $attr, $content ) {
		// We're not worried abut captions in feeds, so just return the output here.
		if ( is_feed() ) { return $output; }
		// Set up the default arguments.
		$defaults = array(
			'id' => '',
			'align' => 'alignnone',
			'width' => '',
			'caption' => ''
		);
		// Merge the defaults with user input.
		$attr = shortcode_atts( $defaults, $attr );
		// If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags.
		if ( 1 > $attr['width'] || empty( $attr['caption'] ) ) { return $content; }
		// Set up the attributes for the caption <div>.
		$attributes = ' class="figure ' . esc_attr( $attr['align'] ) . '"';
		// Open the caption <div>.
		$output = '<figure' . $attributes .'>';
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
/* 
====================
	CLEAN INSERTED IMAGES ATTRIBUTES
====================
*/
// Clean the output of attributes of images in editor. 
// Courtesy of SitePoint. http://www.sitepoint.com/wordpress-change-img-tag-html/
if ( ! function_exists( 'reverie_image_tag_class' ) ) {
	function reverie_image_tag_class( $class, $id, $align, $size ) {
		$align = 'align' . esc_attr($align);
		return $align;
	}
}
// Remove width and height in editor, for a better responsive world.
if ( ! function_exists( 'reverie_image_editor' ) ) {
	function reverie_image_editor( $html, $id, $alt, $title ) {
		return preg_replace(array(
				'/\s+width="\d+"/i',
				'/\s+height="\d+"/i',
				'/alt=""/i'
			),
			array(
				'',
				'',
				'',
				'alt="' . $title . '"'
			),
			$html);
	}
}
// Wrap images with figure tag. 
// Courtesy of Interconnectit. http://interconnectit.com/2175/how-to-remove-p-tags-from-images-in-wordpress/
if ( ! function_exists( 'reverie_img_unautop' ) ) {
	function reverie_img_unautop( $pee ) {
	    $pee = preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<figure>$1</figure>', $pee);
	    return $pee;
	}
}