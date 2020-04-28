<?php
/**
 * Block Accordion
 *
 * @package Custom
 */

?>

<?php if ( have_rows( 'block_accordion' ) ) : ?>
	<div class="block-accordion">
		<?php
		while ( have_rows( 'block_accordion' ) ) :
			the_row();

			// Get sub fields.
			$accordion_title   = get_sub_field( 'title' );
			$accordion_content = get_sub_field( 'content' );
			?>
			<details class="block-accordion__item">
				<summary class="block-accordion__title">
					<div class="block-accordion__icons">
						<span class="fas fa-plus-circle block-accordion__icon-close"></span>
						<span class="fas fa-minus-circle block-accordion__icon-open"></span>
					</div>

					<?php echo esc_html( $accordion_title ); ?>
				</summary>

				<div class="block-accordion__content wysiwyg-content">
					<?php echo wp_kses_post( $accordion_content ); ?>
				</div>
			</details>
		<?php endwhile; ?>
	</div>
<?php endif; ?>
