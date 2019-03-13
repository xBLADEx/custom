<?php
/**
 * Single
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
					<?php get_template_part( 'components/post-date' ); ?>

					<?php get_template_part( 'components/post-categories' ); ?>
				</header>

				<div class="wysiwyg-content">
					<?php the_content(); ?>
				</div>

				<footer>
					<?php get_template_part( 'components/post-tags' ); ?>
				</footer>
			</article>
			<?php
		endwhile;
	endif;
	?>

	<div class="">
		<?php dynamic_sidebar( 'Sidebar' ); ?>
	</div>
</div>

<?php get_footer(); ?>
