<?php
/**
 * Front Page
 *
 * @package Custom
 */

get_header();
?>

<div class="home-slider">
	<div><img src="<?php echo esc_url( THEME_IMAGES ); ?>/slides/1.jpg" alt=""></div>
	<div><img src="<?php echo esc_url( THEME_IMAGES ); ?>/slides/1.jpg" alt=""></div>
</div>

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
