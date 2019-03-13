<?php
/**
 * Post Title
 *
 * @package Custom
 */

?>

<h2 class="post-title">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php the_title(); ?>
	</a>
</h2>
