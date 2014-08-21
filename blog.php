<?php
/* 
====================
	TEMPLATE NAME: Blog
====================
*/
get_header(); 
?>
<?php get_template_part( 'templates/page', 'header' ); ?>
<div class="row pageContent">
    <div class="large-9 columns">
    <?php
    	$args = array(
			'post_type' 		=> 'post',
			'post_status'		=> 'publish',
			'posts_per_page'	=> '10',
			'orderby'			=> 'date',
		); 
	?>
    <?php $custom_query = new WP_Query( $args ); // http://codex.wordpress.org/Class_Reference/WP_Query ?>
    <?php if ( $custom_query->have_posts() ) { ?>	
    	<?php while ( $custom_query->have_posts() ) { $custom_query->the_post(); ?>
		<div class="postContainer">
		    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<?php if ( has_post_thumbnail() ) { ?>
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
					<?php } ?>
					<p class="date">Date: <?php the_time( get_option( 'date_format' ) ); ?></p>
					<p class="categories">In: <?php the_category( ', ' ); ?></p>
				</header>
				<div>
					<?php the_excerpt(); ?>
				</div> 
				<footer>
					<p class="tags"><?php the_tags( '<span>', '</span><span>', '</span>' ); ?></p>
				</footer>
		    </article>
	    </div>
	    <?php } ?>
	    <?php blade_pagination(); ?>
	    <?php wp_reset_postdata(); ?>
    <?php } ?>
    </div>
	<?php get_template_part( 'templates/page', 'sidebarRight' ); ?>
</div>
<?php get_footer(); ?>