<?php
/* 
====================
	PAGE
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
			
				<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if ( has_post_thumbnail()) { ?>
						<a href="<?php the_permalink(); ?>" class="th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail(); ?></a>
					<?php } ?>
					
					<?php the_content(); ?>

				</article>

			<?php } ?>
			
		<?php } ?>

    </div>
	<?php dynamic_sidebar('Sidebar Right'); ?>

</div><?php //.row ?>
<?php get_footer(); ?>