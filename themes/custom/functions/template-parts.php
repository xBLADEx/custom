<?php
/**
 * Template Parts
 * Theme functions for templates.
 *
 * @package Custom
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

	// Set a hero fallback image.
	$page_hero_image = $page_hero_image ? $page_hero_image : get_field( 'global_hero_image', 'options' );

	// Is title set in the function, use it, else use the ACF field, fallback to the post title.
	$title = $title ? $title : ( $page_title ? $page_title : get_the_title() );
	?>
	<div class="g-page-header">
		<div <?php custom_the_image_background_acf( $page_hero_image, 'hero-small', [ 'g-page-header__background' ] ); ?>></div>

		<div class="g-row">
			<?php get_template_part( 'components/breadcrumbs' ); ?>
			<h1><?php echo esc_html( $title ); ?></h1>
		</div>
	</div>
	<?php
}

/**
 * Display Social Media
 *
 * @author Rich Edmunds
 * @param string $modifier Class name BEM modifier.
 */
function custom_display_social_icons( $modifier = '' ) {
	$global_facebook  = get_field( 'global_facebook', 'options' );
	$global_twitter   = get_field( 'global_twitter', 'options' );
	$global_youtube   = get_field( 'global_youtube', 'options' );
	$global_instagram = get_field( 'global_instagram', 'options' );
	$modifier         = $modifier ? "c-social-media--{$modifier}" : '';
	$social_media     = [
		[
			'link' => $global_facebook,
			'icon' => 'facebook',
			'name' => 'Facebook',
		],
		[
			'link' => $global_twitter,
			'icon' => 'twitter',
			'name' => 'Twitter',
		],
		[
			'link' => $global_youtube,
			'icon' => 'youtube',
			'name' => 'YouTube',
		],
		[
			'link' => $global_instagram,
			'icon' => 'instagram',
			'name' => 'Instagram',
		],
	];
	?>
	<ul class="c-social-media <?php echo esc_attr( $modifier ); ?>">
		<?php foreach ( $social_media as $media ) : ?>
			<li class="c-social-media__item">
				<a
					href="<?php echo esc_url( $media['link'] ); ?>"
					class="c-social-media__link"
					data-color="<?php echo esc_attr( $media['icon'] ); ?>"
					rel="noopener"
					target="_blank"
				>
					<span class="fab fa-<?php echo esc_attr( $media['icon'] ); ?>"></span>
					<span class="h-visual-hide"><?php echo esc_html( $media['name'] ); ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}
