<?php
/**
 * View
 *
 * @package Custom
 */

/**
 * Shortcode Example
 *
 * @example [name].
 * @return string HTML.
 */
function custom_shortcode_name() {
	ob_start();
	?>

	<?php
	return ob_get_clean();
}

add_shortcode( 'name', 'custom_shortcode_name' );

/**
 * Add CSS Class Page Name
 *
 * @author Rich Edmunds
 * @param  array $classes The current body classes.
 * @return array $classes Add classes.
 */
function custom_body_classes( $classes ) {
	if ( is_singular( 'page' ) ) {
		global $post;

		$classes[] = 'page-' . $post->post_name;
	}

	return $classes;
}

add_filter( 'body_class', 'custom_body_classes' );
