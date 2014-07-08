<?php
/* 
====================
	INDEX
====================
*/
get_header(); 
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