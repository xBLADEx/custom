<?php
/**
 * Template Name: Sidebar Right
 *
 * @package Custom
 */

get_header();
?>

<div class="row page-content">
	<div class="medium-9 columns">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<?php get_template_part( 'templates/content', 'title' ); ?>
					</header>

					<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>

					<?php the_content(); ?>
				</article>
				<?php
			endwhile;
		endif;
		?>
	</div>

	<aside class="medium-3 columns">
		<?php dynamic_sidebar( 'Sidebar Right' ); ?>
	</aside>
</div>

<?php get_footer(); ?>
