<?php
/* 
====================
	Template Name: Sidebar Right
====================
*/
get_header(); 
?>

<div class="row">

    <div class="large-9 columns">

		<?php if ( have_posts() ) { ?>

			<?php while ( have_posts() ) { the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php } ?>
			
		<?php } ?>

    </div>
	<?php dynamic_sidebar('Sidebar Right'); ?>

</div><?php //.row ?>
<?php get_footer(); ?>