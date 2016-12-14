<?php
/**
 * Front Page
 *
 * @package Custom
 */

get_header();
?>
<div class="home-slider">
	<div><img src="<?php echo esc_url( THEME_IMAGES ); ?>/slides/1.jpg" alt=""></div>
	<div><img src="<?php echo esc_url( THEME_IMAGES ); ?>/slides/1.jpg" alt=""></div>
</div>
<div class="row">
	<div class="medium-12 columns">
		<h1>&lt;h1&gt; Heading Title Example</h1>
		<h2>&lt;h2&gt; Heading Title Example</h2>
		<h3>&lt;h3&gt; Heading Title Example</h3>
		<h4>&lt;h4&gt; Heading Title Example</h4>
		<h5>&lt;h5&gt; Heading Title Example</h5>
		<h6>&lt;h6&gt; Heading Title Example</h6>
		<p>This is a paragraph. This is a paragraph. This is a paragraph. This is a paragraph. This is a paragraph.</p>
		<p><a href="#" class="button">This is a button</a></p>
	</div>
</div>

<div class="row page-content">
	<div class="medium-12 columns">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) { the_post();
				the_content();
			}
		} ?>
	</div>
</div>
<?php get_footer(); ?>
