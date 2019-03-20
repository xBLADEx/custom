<?php
/**
 * Slider
 *
 * @package Custom
 */

?>

<?php if ( have_rows( 'slides' ) ) : ?>
	<div class="slick-slider">
		<?php
		while ( have_rows( 'slides' ) ) :
			the_row();

			// Get sub fields.
			$image   = get_sub_field( 'image' );
			$heading = get_sub_field( 'heading' );
			?>
			<div class="slick-slider__slide">
				<div class="g-row">
					<p class="slick-slider__heading"><?php echo esc_html( $heading ); ?></p>
				</div>

				<img src="<?php echo esc_url( $image['sizes']['slider-large'] ); ?>" class="slick-slider__image" alt="">
			</div>
		<?php endwhile; ?>
	</div>
<?php endif; ?>
