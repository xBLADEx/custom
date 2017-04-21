<?php
/**
 * Template Name: Contact
 *
 * @package Custom
 */

get_header();
?>

<div class="row page-content">
	<div class="medium-12 columns">
		<?php get_template_part( 'templates/page', 'title' ); ?>

		<div class="row">
			<div class="medium-6 columns">
				<?php get_template_part( 'templates/form', 'contact' ); ?>
			</div>

			<div class="medium-6 columns">
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
				endif; ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
