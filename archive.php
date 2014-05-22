<?php
/* 
====================
	ARCHIVE
====================
*/
get_header(); 
?>
<div class="row">
	<div class="large-12 columns">
		<header class="pageHeader">
			<h1><?php the_title(); ?></h1>		
		</header>
	</div>
</div>
<div class="row pageContent">
    <div class="large-9 columns" role="main">
    <?php if ( have_posts() ) {
    	while ( have_posts() ) { the_post(); ?>    
	    <article id="post-<?php the_ID(); ?>">
			<header>
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'blog-featured' ); ?></a>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<div class="meta"><p class="published">Published under <?php the_category(','); ?> on <time datetime="<?php echo get_the_time('c'); ?>"><?php the_time('m/d/Y'); ?></time></p></div>
			</header>
			<section class="entry-content clearfix">	
				<?php the_excerpt(); ?>
			</section> 
			<footer>
				<p class="tags"><?php the_tags('<span class="tags-title">Tags:</span> ', ' ', ''); ?></p>
			</footer> 
		    <p class="comments"></p>
	    </article>
	    <hr>
	<?php } ?>  
    <?php } else { ?>
		<article id="post-not-found">
			<header>
				<h1>Not Found</h1>
			</header>
			<section class="post_content">
				<p>Sorry, no posts.</p>
			</section>
			<footer></footer>
		</article> 
    <?php } ?>
    </div>
<?php dynamic_sidebar('Sidebar Right'); ?>
</div>
<?php get_footer(); ?>