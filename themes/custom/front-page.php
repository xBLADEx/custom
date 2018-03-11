<?php
/**
 * Front Page
 *
 * @package Custom
 */

get_header();
?>

<div class="g-page-content">
	<div class="g-l-row">
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
