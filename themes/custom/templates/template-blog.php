<?php
/**
 * Template Name: Blog
 *
 * @package Custom
 */

get_header();
custom_display_hero_content();
?>

<div class="g-l-row">
	<?php
	$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

	$args = [
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => '10',
		'orderby'        => 'date',
		'paged'          => $paged,
	];

	// @see http://codex.wordpress.org/Class_Reference/WP_Query.
	$custom_query = new WP_Query( $args );

	if ( $custom_query->have_posts() ) :
		while ( $custom_query->have_posts() ) :
			$custom_query->the_post();
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

		custom_pagination( $custom_query );

		wp_reset_postdata();
	endif;
	?>
</div>

<aside class="">
	<?php dynamic_sidebar( 'Sidebar' ); ?>
</aside>

<?php get_footer(); ?>
