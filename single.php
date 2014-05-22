<?php
/* 
====================
	SINGLE
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

		<?php if ( have_posts() ) { ?>

			<?php while ( have_posts() ) { the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header>
						<h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'foundation' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<p><?php _e('Written by', 'foundation' );?> <?php the_author_link(); ?> on <?php the_time(get_option('date_format')); ?></p>
					</header>

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

				<hr />
				
			<?php } ?>
			
		<?php } ?>

    </div>
	<?php dynamic_sidebar('Sidebar Right'); ?>

</div><?php //.row ?>
<?php get_footer(); ?>