<?php
/**
 * Index
 *
 * @package Custom
 */

if ( function_exists( 'get_header' ) ) {
	get_header();
} else {
	header( 'Location: https://' . $_SERVER['HTTP_HOST'] );
	exit;
}
?>

<div class="row page-content">
	<div class="medium-12 columns">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				the_content();
			}
		}
		?>
	</div>
</div>

<?php get_footer(); ?>
