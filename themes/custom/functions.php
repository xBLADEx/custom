<?php
//--------------------------------------------------------------
// Functions
//--------------------------------------------------------------

define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_IMAGES', THEME_URI . '/images' );
define( 'THEME_CSS', THEME_URI . '/css' );
define( 'THEME_JS', THEME_URI . '/js' );

require_once( 'functions/enqueue.php' );
require_once( 'functions/support.php' );
require_once( 'functions/clean.php' );
require_once( 'functions/post.php' );
require_once( 'functions/register.php' );
require_once( 'functions/admin.php' );
require_once( 'functions/view.php' );
