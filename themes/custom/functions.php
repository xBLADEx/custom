<?php
/**
 * Functions
 *
 * @package Custom
 */

define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_IMAGES', THEME_URI . '/assets/dist/images' );
define( 'THEME_CSS', THEME_URI . '/assets/dist/scss' );
define( 'THEME_JS', THEME_URI . '/assets/dist/js' );

require get_parent_theme_file_path( 'functions/index.php' );
