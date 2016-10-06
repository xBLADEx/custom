<?php
//--------------------------------------------------------------
// Single
//--------------------------------------------------------------
get_header();
?>
<div class="row page-content">
    <div class="medium-9 columns">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) { the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php get_template_part( 'templates/page', 'title' ); ?>
					<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
					<p class="date">Date: <?php the_time( get_option( 'date_format' ) ); ?></p>
					<p class="categories">Categories: <?php the_category( ', ' ); ?></p>
					<div>
						<?php the_content(); ?>
						<p class="tags"><?php the_tags( '<span>', '</span><span>', '</span>' ); ?></p>
						<?php comments_template(); ?>
					</div>
				</article>
			<?php
			}
		} ?>
    </div>
	<aside class="medium-3 columns">
		<?php dynamic_sidebar( 'Sidebar Blog' ); ?>
	</aside>
</div>
<?php get_footer(); ?>
