<?php
/**
 * 404
 *
 * @package Custom
 */

get_header();

custom_display_hero_content( 'Page Not Found!' );
?>

<div class="g-row">
	<p><?php esc_html_e( 'This page no longer exists.', 'custom' ); ?></p>
</div>

<?php get_footer(); ?>
