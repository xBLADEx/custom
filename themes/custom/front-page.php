<?php
/**
 * Front Page
 *
 * @package Custom
 */

get_header();
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
