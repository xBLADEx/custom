<?php
/**
 * Index
 * Entry point for all function files.
 *
 * @package Custom
 */

$files = [
	'enqueue.php',
	'theme-support.php',
	'clean.php',
	'post-custom.php',
	'register.php',
	'class-custom-nav-menu.php',
	'template-parts.php',
];

foreach ( $files as $file ) {
	require_once $file;
}
