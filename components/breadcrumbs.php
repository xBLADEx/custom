<?php
/**
 * Breadcrumbs
 *
 * Requires Yoast SEO plugin.
 * https://wordpress.org/plugins/wordpress-seo/
 *
 * Activate: SEO > Search Appearance > Breadcrumbs > Enable
 *
 * @package Custom
 */

if ( function_exists( 'yoast_breadcrumb' ) ) {
	yoast_breadcrumb( '<p id="breadcrumbs" class="yoast-breadcrumbs">', '</p>' );
}
