<?php
/**
 * Block Content
 *
 * Flexible content block with Title, Content, Image, and Image Position.
 *
 * @package Custom
 */

// ACF
$title          = get_sub_field( 'content_title' ); // Text
$content        = get_sub_field( 'content_content' ); // WYSIWYG Editor
$image          = get_sub_field( 'content_image' ); // Image
$image_position = get_sub_field( 'content_image_position' ); // Options: Left, Right. Default: Left.

// Modifier
$block_modifier_position = $image ? $image_position : 'center';
?>

<div class="block-content block-content--<?php echo esc_attr( $block_modifier_position ); ?>">
	<?php custom_display_image_acf( $image, 'large', [ 'block-content__image', "block-content__image--$image_position" ] ); ?>

	<?php if ( $content ) : ?>
		<div class="wysiwyg-content block-content__content block-content__content--<?php echo esc_attr( $block_modifier_position ); ?>">
			<?php if ( $title ) : ?>
				<h2><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>

			<?php echo wp_kses_post( $content ); ?>
		</div>
	<?php endif; ?>
</div>
