<?php
/* 
====================
	ARCHIVE
====================
*/
get_header(); 
?>
<?php get_template_part( 'templates/page', 'header' ); ?>
<div class="row pageContent">
    <div class="large-9 columns">
    <?php if ( have_posts() ) { ?>
    	<?php while ( have_posts() ) { the_post(); ?>    
	    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
			<header>
				<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<?php if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
				<?php } ?>
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
		<?php } ?>  
    <?php } else { ?>
		<article>
			<header>
				<h1>Article Not Found!</h1>
				<p>Sorry, no posts.</p>
			</header>
		</article> 
    <?php } ?>
    </div>
	<?php get_template_part( 'templates/page', 'sidebarRight' ); ?>
</div>
<?php get_footer(); ?>