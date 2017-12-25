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

require_once( 'functions/enqueue.php' );
require_once( 'functions/support.php' );
require_once( 'functions/clean.php' );
require_once( 'functions/post.php' );
require_once( 'functions/register.php' );
require_once( 'functions/class-custom-nav-menu.php' );
require_once( 'functions/admin.php' );
require_once( 'functions/view.php' );
