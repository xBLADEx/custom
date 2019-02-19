<?php
/**
 * Front Page
 *
 * @package Custom
 */

get_header();
?>

<div class="g-row">
	<h1><?php esc_html_e( 'Home', 'custom' ); ?></h1>

	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			the_content();
		}
	}
	?>
</div>

<?php get_footer(); ?>
