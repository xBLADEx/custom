<?php
/* 
====================
	SEARCH
====================
*/
get_header(); ?>
<div class="row">
	<div class="large-12 columns">
		<header class="page-header" role="banner">
			<h1><?php printf( 'Search Results for: %s', get_search_query() ); ?></h1>	
		</header>
	</div>
</div>
<div class="row page-content">
	<div class="medium-9 columns">
		<?php if ( have_posts() ) { 
				while ( have_posts() ) { the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
					<header>
						<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
						<?php } ?>
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
			<?php } blade_pagination();
			} else {
				echo "Sorry, no search results found.";
			}
		?>
	</div>
	<aside class="medium-3 columns" role="complementary">
		<?php dynamic_sidebar( 'Sidebar Blog' ); ?>
	</aside>
</div>
<?php get_footer(); ?>