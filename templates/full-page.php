<?php
/* 
====================
	Template Name: Full Page
====================
*/
get_header(); 
?>
<div class="row">
	<div class="large-12 columns">
		<header>
			<h1><?php the_title(); ?></h1>		
		</header>
	</div>
</div>
<div class="row">
	
    <div class="large-12 columns">
		<?php if ( have_posts() ) { ?>

			<?php while ( have_posts() ) { the_post(); ?>
				<article>
					<?php the_content(); ?>				
				</article>
			<?php } ?>
			
		<?php } ?>

    </div>

</div><?php //.row ?>
<?php get_footer(); ?>