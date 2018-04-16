<?php
/**
 * Template Name: Contact
 *
 * @package Custom
 */

get_header();
?>

<div class="g-page-content">
	<div class="g-l-row">
		<?php get_template_part( 'templates/content', 'title' ); ?>

		<?php get_template_part( 'components/form-contact' ); ?>

		<div class="">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					?>
					<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content(); ?>
					</div>
					<?php
				endwhile;
			endif;
			?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
