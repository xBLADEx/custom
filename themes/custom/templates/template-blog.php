<?php
/**
 * Template Name: Blog
 *
 * @package Custom
 */

get_header();
custom_display_hero_content();
?>

<div class="g-row">
	<?php
	$custom_paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

	$args = [
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => '10',
		'orderby'        => 'date',
		'paged'          => $custom_paged,
	];

	$custom_query = new WP_Query( $args );

	if ( $custom_query->have_posts() ) :
		while ( $custom_query->have_posts() ) :
			$custom_query->the_post();
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

		custom_pagination( $custom_query );

		wp_reset_postdata();
	endif;
	?>

	<div class="">
		<?php dynamic_sidebar( 'Sidebar' ); ?>
	</div>
</div>

<?php get_footer(); ?>
