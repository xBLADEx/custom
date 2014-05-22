<?php
/* 
====================
	INDEX
====================
*/
/* Standard loop for the front-page */
get_header(); 
?>

<div class="row">

    <div class="large-9 columns" role="main">

		<?php if ( have_posts() ) { ?>

			<?php while ( have_posts() ) { the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php } ?>

		<?php } else { ?>

			<h2><?php _e('No posts.', 'foundation' ); ?></h2>
			<p class="lead"><?php _e('Sorry about this, I couldn\'t seem to find what you were looking for.', 'foundation' ); ?></p>
			
		<?php } ?>

		<?php foundation_pagination(); ?>

    </div>
	<?php get_sidebar(); ?>

</div><?php //.row ?>
<?php get_footer(); ?>