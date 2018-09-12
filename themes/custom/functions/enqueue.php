<?php
/**
 * Enqueue
 *
 * @package Custom
 */

/**
 * Enqueue Scripts
 *
 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 * @see https://developers.google.com/speed/libraries/#jquery
 * @example wp_enqueue_style( $handle, $src, $deps, $ver, $media ).
 * @example wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer ).
 */
function custom_enqueue() {
	// If the cookie is set, load our CSS normally.
	if ( isset( $_COOKIE['custom-css'] ) && 'true' === $_COOKIE['custom-css'] ) {
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700,900%7CMontserrat:300,400,500,700', [], '1.0' );
		wp_enqueue_style( 'custom', esc_url( THEME_CSS ) . '/custom.css', [], '1.0' );
	}

	// Scripts.
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', [], '3.3.1', true );
	wp_enqueue_script( 'custom', esc_url( THEME_JS ) . '/custom.js', [], '1', true );
	wp_enqueue_script( 'font-awesome', 'https://use.fontawesome.com/releases/v5.0.1/js/all.js', [], null, true );
}

add_action( 'wp_enqueue_scripts', 'custom_enqueue' );

/**
 * Add Attributes To Scripts
 * Add defer for Font Awesome.
 */
function custom_add_attribute_defer( $tag, $handle ) {
	// Bail early if not font awesome script.
	if ( 'font-awesome' !== $handle ) {
		return $tag;
	}

	return str_replace( ' src', ' defer src', $tag );
}

add_filter( 'script_loader_tag', 'custom_add_attribute_defer', 10, 2 );

/**
 * Critical CSS
 * Include critical CSS and set cookie.
 *
 * @see https://codex.wordpress.org/Function_Reference/locate_template.
 * @see https://github.com/filamentgroup/loadCSS.
 */
function custom_theme_critical() {
	// If we don't have a cookie set, load our inline styles and set cookie.
	if ( ! isset( $_COOKIE['custom-css'] ) ) :
		?>
		<style>
			<?php locate_template( 'assets/dist/css/custom.css', true ); ?>
		</style>
		<link rel="preload" id="google-fonts-css" href="//fonts.googleapis.com/css?family=Lato:300,400,700,900%7CMontserrat:300,400,500,700" as="style" onload="this.rel='stylesheet'">
		<link rel="preload" id="custom-css" href="<?php echo esc_url( THEME_CSS ); ?>/custom.css" as="style" onload="this.rel='stylesheet'">
		<script>
			// Set Cookie.
			let expires = new Date( +new Date + ( 7 * 24 * 60 * 60 * 1000 ) ).toUTCString();
			document.cookie = 'custom-css=true; expires=' + expires;
		</script>
		<?php
	endif;
}

add_action( 'wp_head', 'custom_theme_critical', 30 );

/**
 * Noscript
 * Include noscript in the footer.
 */
function custom_theme_noscript() {
	// If cookie isn't set, load a noscript fallback.
	if ( ! isset( $_COOKIE['custom-css'] ) ) :
		?>
		<noscript><link rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato:300,400,700,900%7CMontserrat:300,400,500,700"></noscript>
		<noscript><link rel="stylesheet" href="<?php echo esc_url( THEME_CSS ); ?>/custom.css"></noscript>
		<?php
	endif;
}

add_action( 'wp_footer', 'custom_theme_noscript', 30 );
