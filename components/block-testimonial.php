<?php
/**
 * Block Testimonial
 *
 * @package Custom
 */

$testimonial = get_field( 'block_testimonial' );
$name        = get_field( 'block_testimonial_name' );
$block_id    = "block-testimonial-{$block['id']}";
$block_align = $block['align'] ? "align{$block['align']}" : '';
?>

<blockquote
	id="<?php echo esc_attr( $block_id ); ?>"
	class="block-testimonial <?php echo esc_attr( $block_align ); ?>"
>
	<p><?php echo esc_html( $testimonial ); ?></p>

	<cite>
		<span><?php echo esc_html( $name ); ?></span>
	</cite>
</blockquote>
