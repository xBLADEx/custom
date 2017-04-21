<?php
/**
 * Page
 *
 * @package Custom
 */

get_header();
?>

<div class="row page-content">
	<div class="medium-12 columns">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php get_template_part( 'templates/content', 'title' ); ?>

					<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>

					<?php the_content(); ?>
				</article>
				<?php
			endwhile;
		endif;
		?>
	</div>
</div>

<?php get_footer(); ?>
