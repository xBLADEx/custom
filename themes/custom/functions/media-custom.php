<?php
/**
 * Media Custom
 *
 * @package Custom
 */

/**
 * Add Image Sizes
 * A 1920 x 400 image is in the design. To make the aspect ratio correctly, upload a 1920 x 405.
 * To properly include aspect ratios for the image to appear in the 'srcset' attribute, 3 image sizes should be generated.
 * - Small: 960 width typically.
 * - Medium: 1280 width typically.
 * - Large: 1920+ or the size in design.
 *
 * A soft crop should not be used as it will load the full size uncompressed image.
 *
 * @author  Rich Edmunds
 * @see     https://andrew.hedges.name/experiments/aspect_ratio/
 * @see     https://developer.wordpress.org/reference/functions/add_image_size/#user-contributed-notes
 * @example add_image_size( 'soft', 1920, 400 );
 */
function custom_image_sizes() {
	// Page Hero
	add_image_size( 'hero-small', 960, 200, true );
	add_image_size( 'hero-medium', 1280, 267, true );
	add_image_size( 'hero-large', 1920, 400, true );
}

add_action( 'after_setup_theme', 'custom_image_sizes' );

/**
 * Add Image ACF
 * Return image with proper size and lazyload attributes.
 *
 * @author Rich Edmunds
 * @param  array  $image      ACF image field or image id.
 * @param  string $image_size Image size, default medium_large.
 * @param  array  $classes    List of class names, default empty array.
 */
function custom_display_image_acf( $image, $image_size = 'medium_large', $classes = [] ) {
	// Bail early if empty.
	if ( empty( $image ) ) {
		return;
	}

	$image_id        = is_array( $image ) ? $image['id'] : $image;
	$image_alt       = is_array( $image ) ? $image['alt'] : get_post_meta( $image, '_wp_attachment_image_alt', true );
	$image_sizes     = wp_get_attachment_image_srcset( $image_id, $image_size );
	$classes_default = [ 'lazyload' ];
	$classes_merged  = wp_parse_args( $classes, $classes_default );
	$classes         = implode( ' ', $classes_merged );
	?>
	<img
		src="<?php echo esc_url( THEME_IMAGES ); ?>/blank.png"
		class="<?php echo esc_attr( $classes ); ?>"
		alt="<?php echo esc_attr( $image_alt ); ?>"
		data-srcset="<?php echo esc_attr( $image_sizes ); ?>"
		data-sizes="auto"
	>
	<?php
}

/**
 * Add Image Background
 * Return attributes lazyload background image.
 *
 * @author Rich Edmunds
 * @param  mixed  $image      ACF image field array or featured image id.
 * @param  string $image_size Image size, default medium_large.
 * @param  array  $classes    List of class names, default empty array.
 */
function custom_the_image_background_acf( $image, $image_size = 'medium_large', $classes = [] ) {
	// Bail early if empty.
	if ( empty( $image ) ) {
		return;
	}

	$image_id        = is_array( $image ) ? $image['id'] : $image;
	$image_sizes     = wp_get_attachment_image_srcset( $image_id, $image_size );
	$classes_default = [ 'h-cover-background lazyload' ];
	$classes_merged  = wp_parse_args( $classes, $classes_default );
	$classes         = implode( ' ', $classes_merged );

	// Build / Output attributes
	echo 'class="' . esc_attr( $classes ) . '" data-bgset="' . esc_attr( $image_sizes ) . '" data-sizes="auto"';
}

/**
 * Increase Max Image Width
 * Used by wp_get_attachment_image_srcset.
 */
function custom_max_srcset_image_width() {
	return 1920;
}

add_filter( 'max_srcset_image_width', 'custom_max_srcset_image_width', 10 );
