<?php
/**
 * Functions
 *
 * @package Custom
 */

define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_IMAGES', THEME_URI . '/assets/dist/images' );
define( 'THEME_CSS', THEME_URI . '/assets/dist/css' );
define( 'THEME_JS', THEME_URI . '/assets/dist/js' );
define( 'GOOGLE_FONTS', '//fonts.googleapis.com/css?family=Lato:300,400,700%7CMontserrat:300,400,700' );

require get_parent_theme_file_path( 'functions/index.php' );
