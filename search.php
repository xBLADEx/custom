<?php
/**
 * Search
 *
 * @package Custom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
custom_display_hero_content( 'Search Results' );
?>

<div class="g-row content-sidebar">
	<div>
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<?php get_template_part( 'components/post-title' ); ?>

						<?php get_template_part( 'components/post-thumbnail' ); ?>

						<?php get_template_part( 'components/post-date' ); ?>

						<?php get_template_part( 'components/post-categories' ); ?>
					</header>

					<?php get_template_part( 'components/post-excerpt' ); ?>

					<footer>
						<?php get_template_part( 'components/post-tags' ); ?>
					</footer>
				</article>
				<?php
			endwhile;

			custom_pagination();
		endif;
		?>
	</div>

	<div class="wysiwyg-content">
		<?php dynamic_sidebar( 'Sidebar' ); ?>
	</div>
</div>

<?php get_footer(); ?>
