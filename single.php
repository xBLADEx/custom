<?php
/* 
====================
	SINGLE
====================
*/
get_header(); 
?>
<div class="row pageContent">
    <div class="large-9 columns">
		<?php if ( have_posts() ) {
			while ( have_posts() ) { the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
					<?php get_template_part( 'templates/page', 'header' ); ?>
					<?php if ( has_post_thumbnail() ) { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail(); ?></a>
					<?php } ?>
					<p class="date">Date: <?php the_time( get_option( 'date_format' ) ); ?></p>
					<p class="categories">Categories: <?php the_category( ', ' ); ?></p>
					<div>
						<?php the_content(); ?>						
					</div>
					<footer>
						<p class="tags"><?php the_tags( '<span>', '</span><span>', '</span>' ); ?></p>
						<?php comments_template(); ?>
					</footer>
				</article>				
			<?php } ?>			
		<?php } ?>
    </div>
	<?php get_template_part( 'templates/page', 'sidebarRight' ); ?>
</div><?php //.row ?>
<?php get_footer(); ?>