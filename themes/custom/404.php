<?php
/**
 * 404
 *
 * @package Custom
 */

get_header();
?>

<div class="row page-content">
	<div class="medium-12 columns">
		<h1><?php esc_html_e( '404 Page Not Found!', 'custom' ); ?></h1>

		<p><?php esc_html_e( 'This page no longer exists.', 'custom' ); ?></p>
	</div>
</div>

<?php get_footer(); ?>
