<?php
/**
 * Post Thumbnail
 *
 * @package Custom
 */

$global_post_image = get_field( 'global_post_image', 'options' );

if ( has_post_thumbnail() ) {
	the_post_thumbnail( 'medium_large', [ 'class' => 'lazyload post-thumbnail' ] );
} else {
	custom_display_image_acf( $global_post_image, '', [ 'post-thumbnail' ] );
}
