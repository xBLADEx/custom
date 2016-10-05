<?php
/* 
====================
	ARCHIVE
====================
*/
get_header(); 
?>
<?php get_template_part( 'templates/page', 'title' ); ?>
<div class="row page-content">
    <div class="medium-9 columns">
		<?php 
		if ( have_posts() ) { 
			while ( have_posts() ) { the_post(); ?>
			    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
						<p class="date">Date: <?php the_time( get_option( 'date_format' ) ); ?></p>
						<p class="categories">Categories: <?php the_category( ', ' ); ?></p>
					</header>
					<div>	
						<?php the_excerpt(); ?>
					</div> 
					<footer>
						<p class="tags"><?php the_tags( '<span>', '</span><span>', '</span>' ); ?></p>
					</footer> 
			    </article>
			<?php 
			} 
			blade_pagination();
		} ?>
    </div>
	<aside class="medium-3 columns">
		<?php dynamic_sidebar( 'Sidebar Blog' ); ?>
	</aside>
</div>
<?php get_footer(); ?>