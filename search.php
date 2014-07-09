<?php
/* 
====================
	SEARCH
====================
*/
get_header(); ?>
<div class="row">
	<div class="large-12 columns">
		<header class="pageHeader">
			<h1><?php printf( __( 'Search Results for: %s', 'twentyfourteen' ), get_search_query() ); ?></h1>	
		</header>
	</div>
</div>
<div class="row pageContent">
	<div class="large-9 columns">
		<?php if ( have_posts() ) { 
				while ( have_posts() ) { the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
						<?php } ?>
						<p class="date">Date: <time datetime="<?php echo get_the_time('c'); ?>"><?php the_time('m/d/Y'); ?></time></p>
						<p class="categories">In: <?php the_category(', '); ?></p>
					</header>
					<section>
						<?php the_excerpt(); ?>						
					</section>
					<footer>
						<p class="tags"><?php the_tags('<span>','</span><span>','</span>'); ?></p>
					</footer>
				</article>
			<?php } foundation_pagination();
			} else {
				echo "Sorry, no search results found.";
			}
		?>
	</div>
	<?php get_template_part('templates/page', 'sidebarRight'); ?>
</div><?php //.row ?>
<?php get_footer(); ?>