<?php
/**
 * Page
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
			<article id="page-<?php the_ID(); ?>" <?php post_class( 'wysiwyg-content' ); ?>>
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				}
				?>

				<?php the_content(); ?>
			</article>
			<?php
		endwhile;
	endif;
	?>
</div>

<div class="g-row sitemap">
	<div class="sitemap__column">
		<h2 id="pages"><?php esc_html_e( 'Pages', 'custom' ); ?></h2>
		<p class="sitemap__description"><?php esc_html_e( 'Listed alphabetically.', 'custom' ); ?></p>

		<ul class="sitemap__list">
			<?php
			wp_list_pages(
				[
					'exclude'  => '',
					'title_li' => '',
				]
			);
			?>
		</ul>
	</div>

	<div class="sitemap__column">
		<?php
		$sitemap_paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$sitemap_args  = [
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => '-1',
			'orderby'        => 'date',
			'paged'          => $sitemap_paged,
		];
		$sitemap_query = new WP_Query( $sitemap_args );

		if ( $sitemap_query->have_posts() ) :
			?>
			<h2 id="posts"><?php esc_html_e( 'Posts', 'custom' ); ?></h2>
			<p class="sitemap__description"><?php esc_html_e( 'Listed newest to oldest.', 'custom' ); ?></p>

			<ul class="sitemap__list">
				<?php
				while ( $sitemap_query->have_posts() ) :
					$sitemap_query->the_post();
					?>
					<li id="post-<?php the_ID(); ?>">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
					<?php
				endwhile;

				custom_pagination( $sitemap_query );

				wp_reset_postdata();
				?>
			</ul>
			<?php
		endif;
		?>
	</div>
</div>

<?php custom_display_content_blocks(); ?>

<?php get_footer(); ?>
