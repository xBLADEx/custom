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
	<div class="large-9 columns" role="main">
		<?php if ( have_posts() ) { ?>
			<?php while ( have_posts() ) { the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<h3><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'foundation' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<?php if ( is_sticky() ) { ?>
							<span class="right radius secondary label"><?php _e( 'Sticky', 'foundation' ); ?></span>
						<?php } ?>
						<p>Written by <?php the_author_link(); ?> on <?php the_time(get_option('date_format')); ?></p>
					</header>
					<?php if ( has_post_thumbnail()) { ?>
						<a href="<?php the_permalink(); ?>" class="th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail(); ?></a>
					<?php } ?>
					<?php the_excerpt(); ?>
					<hr>
				</article>
			<?php }
				// Previous/next post navigation.
				foundation_pagination();
			} else {
				//get_template_part( 'content', 'none' );
				echo "No Content";
			}
		?>
	</div>
	<?php dynamic_sidebar('Sidebar Right'); ?>
</div><?php //.row ?>
<?php get_footer(); ?>
