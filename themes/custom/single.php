<?php
/**
 * Single
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
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<?php get_template_part( 'templates/page', 'title' ); ?>

						<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>

						<p class="date"><?php esc_html_e( 'Date:', 'custom' ); ?> <?php the_time( get_option( 'date_format' ) ); ?></p>

						<p class="categories"><?php esc_html_e( 'Categories:', 'custom' ); ?> <?php the_category( ', ' ); ?></p>
					</header>

					<div>
						<?php the_content(); ?>

						<p class="tags"><?php the_tags( '<span>', '</span><span>', '</span>' ); ?></p>

						<?php comments_template(); ?>
					</div>
				</article>
				<?php
			endwhile;
		endif;
		?>
	</div>

	<aside class="medium-3 columns">
		<?php dynamic_sidebar( 'Sidebar Blog' ); ?>
	</aside>
</div>

<?php get_footer(); ?>
