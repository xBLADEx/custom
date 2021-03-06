<?php
/**
 * Functions
 *
 * @package Custom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_IMAGES', THEME_URI . '/assets/dist/images' );
define( 'THEME_CSS', THEME_URI . '/assets/dist/css' );
define( 'THEME_JS', THEME_URI . '/assets/dist/js' );
define( 'VERSION_CSS', filemtime( get_template_directory() . '/assets/dist/css/custom.css' ) );
define( 'VERSION_JS', filemtime( get_template_directory() . '/assets/dist/js/custom.js' ) );
define( 'GOOGLE_FONTS', '//fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Montserrat:wght@300;400;700&display=swap' );
define( 'RECAPTCHA_SITE_KEY', '' );
define( 'RECAPTCHA_SECRET_KEY', '' );

require get_parent_theme_file_path( 'functions/index.php' );
