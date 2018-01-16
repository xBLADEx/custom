<?php
/**
 * 404
 *
 * @package Custom
 */

get_header();

custom_display_hero_content( 'Page Not Found!' );
?>

<div class="row page-content">
	<div class="medium-12 columns">
		<p><?php esc_html_e( 'This page no longer exists.', 'custom' ); ?></p>
	</div>
</div>

<?php get_footer(); ?>
