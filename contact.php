<?php
/* 
====================
	TEMPLATE NAME: Contact
====================
*/
get_header(); 
?>
<div class="row pageContent">
    <div class="large-12 columns">
    	<?php get_template_part('templates/page', 'header'); ?>
    	<div class="row">
    		<div class="medium-6 columns">
    			<?php get_template_part('templates/form', 'contact'); ?>
    		</div>
    		<div class="medium-6 columns">
				<?php if ( have_posts() ) { ?>
					<?php while ( have_posts() ) { the_post(); ?>			
						<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
							<?php } ?>					
							<?php the_content(); ?>
						</div>
					<?php } ?>			
				<?php } ?>
			</div>
		</div>
    </div>
</div><?php //.row ?>
<?php get_footer(); ?>