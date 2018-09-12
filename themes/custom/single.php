<?php
/**
 * Single
 *
 * @package Custom
 */

get_header();
custom_display_hero_content();
?>

<div class="g-l-row">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail();
					}
					?>

					<p class="date"><?php esc_html_e( 'Date:', 'custom' ); ?> <?php the_time( get_option( 'date_format' ) ); ?></p>

					<p class="categories"><?php esc_html_e( 'Categories:', 'custom' ); ?> <?php the_category( ', ' ); ?></p>
				</header>

				<div class="wysiwyg-content">
					<?php the_content(); ?>
				</div>

				<p class="tags"><?php the_tags( '<span>', '</span><span>', '</span>' ); ?></p>
			</article>
			<?php
		endwhile;
	endif;
	?>

	<aside class="">
		<?php dynamic_sidebar( 'Sidebar' ); ?>
	</aside>
</div>

<?php get_footer(); ?>
