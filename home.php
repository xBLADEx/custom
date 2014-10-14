<?php
/* 
====================
	TEMPLATE NAME: Home
====================
*/
get_header(); 
?>
<?php //echo do_shortcode( '[flexslider]' ); ?>
<?php //echo get_post_meta( $post->ID, 'key', true ); ?>
<?php 
/*<div class="home-slider">
	<div><img src="<?php echo get_template_directory_uri(); ?>/images/slides/1.jpg" alt=""></div>
	<div><img src="<?php echo get_template_directory_uri(); ?>/images/slides/2.jpg" alt=""></div>
</div>*/
?>
<div class="row">
    <div class="large-12 columns">
		<?php if ( have_posts() ) { ?>
			<?php while ( have_posts() ) { the_post(); ?>
				<?php the_content(); ?>
			<?php } ?>			
		<?php } ?>
    </div>
</div><?php //.row ?>
<?php get_footer(); ?>