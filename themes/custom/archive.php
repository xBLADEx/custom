<?php
/**
 * Archive
 *
 * @package Custom
 */

get_header();
custom_display_hero_content();
?>

<div class="g-row">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

					<?php get_template_part( 'components/post-thumbnail' ); ?>

					<?php get_template_part( 'components/post-date' ); ?>

					<?php get_template_part( 'components/post-categories' ); ?>
				</header>

				<div>
					<?php the_excerpt(); ?>
				</div>

				<footer>
					<?php get_template_part( 'components/post-tags' ); ?>
				</footer>
			</article>
			<?php
		endwhile;

		custom_pagination();
	endif;
	?>

	<aside class="">
		<?php dynamic_sidebar( 'Sidebar' ); ?>
	</aside>
</div>

<?php get_footer(); ?>
