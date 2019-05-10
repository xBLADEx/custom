<?php
/**
 * Template Name: Contact
 *
 * @package Custom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
custom_display_hero_content();
?>

<div class="g-row">
	<?php get_template_part( 'components/form-contact' ); ?>

	<div class="">
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
	</div>
</div>

<?php get_footer(); ?>
