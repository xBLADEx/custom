<?php
/**
 * Template Parts
 * Theme functions for templates.
 *
 * @package Base
 */

/**
 * Hero Content
 *
 * @author Rich Edmunds
 * @param  string $title Main heading title.
 */
function custom_display_hero_content( $title = '' ) {
	// Bail early if not a string.
	if ( ! is_string( $title ) ) {
		return;
	}

	$page_hero_image = get_field( 'page_hero_image' );
	$page_title      = get_field( 'page_title' );
	$page_sub_title  = get_field( 'page_sub_title' );
	$page_link       = get_field( 'page_link' );

	// Set a hero fallback image.
	$page_hero_image = $page_hero_image ? $page_hero_image : get_field( 'global_hero_image', 'options' );

	// Is title set in the function, use it, else use the ACF field, fallback to the post title.
	$title = $title ? $title : ( $page_title ? $page_title : get_the_title() );

	// Get the page link name.
	$link_id    = url_to_postid( $page_link );
	$link_title = get_the_title( $link_id );
	?>
	<div class="g-page-header">
		<div <?php custom_the_image_background_acf( $page_hero_image, 'hero-small', [ 'g-page-header__background' ] ); ?>></div>

		<div class="g-l-wrapper">
			<h1><?php echo esc_html( $title ); ?></h1>

			<?php if ( $page_sub_title ) : ?>
				<h2><?php echo esc_html( $page_sub_title ); ?></h2>
			<?php endif; ?>

			<?php if ( $page_link ) : ?>
				<a href="<?php echo esc_url( $page_link ); ?>" class="button"><?php echo esc_html( $link_title ); ?></a>
			<?php endif; ?>
		</div>
	</div>
	<?php
}

/**
 * Display Social Media
 */
function custom_display_social_icons() {
	$global_facebook  = get_field( 'global_facebook', 'options' );
	$global_twitter   = get_field( 'global_twitter', 'options' );
	$global_youtube   = get_field( 'global_youtube', 'options' );
	$global_instagram = get_field( 'global_instagram', 'options' );
	?>
	<ul class="c-social-media">
		<li class="c-social-media__item"><a href="<?php echo esc_url( $global_facebook ); ?>" class="c-social-media__link" rel="noopener" target="_blank"><span class="fab fa-facebook"></span></a></li>
		<li class="c-social-media__item"><a href="<?php echo esc_url( $global_twitter ); ?>" class="c-social-media__link" rel="noopener" target="_blank"><span class="fab fa-twitter"></span></a></li>
		<li class="c-social-media__item"><a href="<?php echo esc_url( $global_youtube ); ?>" class="c-social-media__link" rel="noopener" target="_blank"><span class="fab fa-youtube"></span></a></li>
		<li class="c-social-media__item"><a href="<?php echo esc_url( $global_instagram ); ?>" class="c-social-media__link" rel="noopener" target="_blank"><span class="fab fa-instagram"></span></a></li>
	</ul>
	<?php
}
