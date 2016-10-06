<?php
/* 
====================
	SEARCH
====================
*/
get_header(); ?>
<div class="row">
	<div class="medium-12 columns">
		<h1 class="page-title"><?php printf( 'Search Results for: %s', get_search_query() ); ?></h1>
	</div>
</div>
<div class="row page-content">
	<div class="medium-9 columns">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) { the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
						<p class="date">Date: <time datetime="<?php echo get_the_time('c'); ?>"><?php the_time( 'm/d/Y' ); ?></time></p>
						<p class="categories">In: <?php the_category( ', ' ); ?></p>
					</header>
					<div>
						<?php the_excerpt(); ?>
					</div>
					<footer>
						<p class="tags"><?php the_tags( '<span>', '</span><span>', '</span>' ); ?></p>
					</footer>
				</article>
			<?php 
			} blade_pagination();
		} ?>
	</div>
	<aside class="medium-3 columns">
		<?php dynamic_sidebar( 'Sidebar Blog' ); ?>
	</aside>
</div>
<?php get_footer(); ?>