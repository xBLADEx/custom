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
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php get_template_part('templates/page', 'header'); ?>
					<p class="date">Date: <time datetime="<?php echo get_the_time('c'); ?>"><?php the_time('m/d/Y'); ?></time></p>
					<p><?php _e('Written by', 'foundation' );?> <?php the_author_link(); ?> on <?php the_time(get_option('date_format')); ?></p>
					<?php if ( has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" class="th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail(); ?></a>
					<?php } ?>
					<?php the_content(); ?>
					<footer>
						<p><?php wp_link_pages(); ?></p>
						<h6><?php _e('Posted Under:', 'foundation' );?> <?php the_category(', '); ?></h6>
						<?php the_tags('<span class="radius secondary label">','</span><span class="radius secondary label">','</span>'); ?>
						<?php get_template_part('author-box'); ?>
						<?php comments_template(); ?>
					</footer>
				</article>				
			<?php } ?>			
		<?php } ?>
    </div>
	<?php get_template_part('templates/page', 'sidebarRight'); ?>
</div><?php //.row ?>
<?php get_footer(); ?>