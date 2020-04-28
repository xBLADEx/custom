<?php
/**
 * Slider
 *
 * @package Custom
 */

?>

<?php if ( have_rows( 'slides' ) ) : ?>
	<div class="slick-slider custom-slider">
		<?php
		while ( have_rows( 'slides' ) ) :
			the_row();

			// Get sub fields.
			$image        = get_sub_field( 'image' );
			$heading      = get_sub_field( 'heading' );
			$sub_heading  = get_sub_field( 'sub_heading' );
			$slide_link   = get_sub_field( 'link' );
			$slide_url    = isset( $slide_link['url'] ) ? $slide_link['url'] : '';
			$slide_title  = isset( $slide_link['title'] ) && ! empty( $slide_link['title'] ) ? $slide_link['title'] : __( 'Learn More', 'custom' );
			$slide_target = isset( $slide_link['target'] ) && ! empty( $slide_link['target'] ) ? $slide_link['target'] : '_self';
			?>
			<div class="slick-slider__slide">
				<div class="slick-slider__slide-content">
					<?php if ( $heading ) : ?>
						<p class="slick-slider__heading"><?php echo esc_html( $heading ); ?></p>
					<?php endif; ?>

					<?php if ( $sub_heading ) : ?>
						<p class="slick-slider__sub-heading"><?php echo esc_html( $sub_heading ); ?></p>
					<?php endif; ?>

					<?php if ( $slide_link ) : ?>
						<a
							href="<?php echo esc_url( $slide_url ); ?>"
							class="button button--full-width slick-slider__link"
							target="<?php echo esc_attr( $slide_target ); ?>"
							<?php echo '_self' !== $slide_target ? 'rel="noopener"' : ''; ?>
						>
							<?php echo esc_html( $slide_title ); ?>
						</a>
					<?php endif; ?>
				</div>

				<img src="<?php echo esc_url( $image['sizes']['slider-large'] ); ?>" class="slick-slider__image" alt="">
			</div>
		<?php endwhile; ?>
	</div>
<?php endif; ?>
