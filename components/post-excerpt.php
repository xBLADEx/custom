<?php
/**
 * Post Excerpt
 *
 * @package Custom
 */

$excerpt = $post->post_excerpt;
?>

<div class="post-excerpt wysiwyg-content">
	<?php
	if ( $excerpt ) {
		?>
		<p><?php echo esc_html( $excerpt ); ?></p>
		<?php
	} else {
		the_excerpt();
	}
	?>
</div>
