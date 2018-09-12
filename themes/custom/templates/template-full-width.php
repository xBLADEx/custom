<?php
/**
 * Template Name: Full Width
 *
 * @package Custom
 */

get_header();
custom_display_hero_content();
?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
		<div id="page-<?php the_ID(); ?>" <?php post_class( 'wysiwyg-content' ); ?>>
			<?php the_content(); ?>
		</div>
		<?php
	endwhile;
endif;
?>

<?php get_footer(); ?>
