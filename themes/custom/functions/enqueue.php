<?php
/**
 * Enqueue
 *
 * @package Custom
 */

/**
 * Enqueue Scripts
 *
 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_style.
 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @see https://fonts.google.com/specimen/Lato?selection.family=Lato:300,400,700,900.
 * @see https://fonts.google.com/specimen/Halant?selection.family=Halant:400,600.
 * @example wp_enqueue_style( $handle, $src, $deps, $ver, $media ).
 * @example wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer ).
 */
function custom_enqueue() {
	// Styles.
	// wp_enqueue_style( 'jquery-ui-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css', array(), '1.11.4' );
	// wp_enqueue_style( 'custom', THEME_CSS . '/custom.css', array(), '1.0' );

	// If the cookie is set, load our CSS normally.
	if ( isset( $_COOKIE['custom-css'] ) && 'true' === $_COOKIE['custom-css'] ) {
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700,900%7CHalant:400,600', array(), '1.0' );
		wp_enqueue_style( 'custom', THEME_CSS . '/custom.css', array(), '1.0' );
	}

	// Scripts.
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', array(), '2.2.0', true );
	// wp_enqueue_script( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', array('jquery'), '1.11.4', true );
	wp_enqueue_script( 'custom', THEME_JS . '/custom.js', array(), '6.2.4', true );
}

add_action( 'wp_enqueue_scripts', 'custom_enqueue' );


/**
 * Critical CSS
 *
 * Include critical CSS and set cookie.
 *
 * @see https://codex.wordpress.org/Function_Reference/locate_template.
 */
function custom_theme_critical() {
	// If we don't have a cookie set, load our inline styles and set cookie.
	if ( ! isset( $_COOKIE['custom-css'] ) || 'true' !== $_COOKIE['custom-css'] ) :
		?>
		<style>
			<?php locate_template( 'assets/scss/critical.css', true ); ?>
		</style>
		<link rel="preload" id="google-fonts-css" href="//fonts.googleapis.com/css?family=Lato:300,400,700,900%7CHalant:400,600" as="style" onload="this.rel='stylesheet'">
		<link rel="preload" id="custom-css" href="/wp-content/themes/custom/assets/scss/custom.css" as="style" onload="this.rel='stylesheet'">
		<script>
			<?php locate_template( 'assets/js/critical.js', true ); ?>
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
 *
 * Include noscript in the footer.
 */
function custom_theme_noscript() {
	// If cookie isn't set, load a noscript fallback.
	if ( ! isset( $_COOKIE['custom-css'] ) || 'true' !== $_COOKIE['custom-css'] ) :
		?>
		<noscript><link rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato:300,400,700,900%7CHalant:400,600"></noscript>
		<noscript><link rel="stylesheet" href="/wp-content/themes/custom/assets/scss/custom.css"></noscript>
		<?php
	endif;
}

add_action( 'wp_footer', 'custom_theme_noscript', 30 );
