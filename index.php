<?php
/* 
====================
	INDEX
====================
*/
if ( function_exists( 'get_header' ) ) {
	get_header();
} else {
	header("Location: http://" . $_SERVER['HTTP_HOST'] . "");
	exit;
}
?>
<div class="row page-content">
    <div class="large-12 columns">
		<?php if ( have_posts() ) { ?>
			<?php while ( have_posts() ) { the_post(); ?>
				<?php the_content(); ?>
			<?php } ?>
		<?php } ?>
    </div>
</div>
<?php get_footer(); ?>