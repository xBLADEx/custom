<?php
/* 
====================
	Template Name: Sidebar Left
====================
*/
get_header(); 
?>

<div class="row">

<?php dynamic_sidebar('Sidebar Left'); ?>

    <div class="large-9 columns">

		<?php if ( have_posts() ) { ?>

			<?php while ( have_posts() ) { the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php } ?>
			
		<?php } ?>

    </div>

</div><?php //.row ?>
<?php get_footer(); ?>