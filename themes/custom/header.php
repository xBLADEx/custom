<?php
/**
 * Header
 *
 * @package Custom
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '-', true, 'right' ); ?></title>
	<style>
		<?php include( 'assets/scss/critical.css' ); ?>
	</style>

	<link rel="preload" id="google-fonts-css" href="//fonts.googleapis.com/css?family=Lato:300,400,700,900%7CHalant:400,600" media="all" as="style" onload="this.rel='stylesheet'">
	<noscript><link rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato:300,400,700,900%7CHalant:400,600" media="all"></noscript>

	<link rel="preload" id="custom-css" href="/wp-content/themes/custom/assets/scss/custom.css" media="all" as="style" onload="this.rel='stylesheet'">
	<noscript><link rel="stylesheet" href="/wp-content/themes/custom/assets/scss/custom.css" media="all"></noscript>

	<script>
		<?php include( 'assets/js/critical.js' ); ?>
	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class( 'body-site' ); ?>>
	<button class="mobile-menu-icon"><span><?php esc_html_e( 'Menu', 'custom' ); ?></span></button>

	<header class="header-background">
		<div class="row">
			<div class="small-12 medium-3 columns">
				<a href="/" class="logo"><?php include_once( 'assets/images/logo.svg' ); ?></a>
			</div>

			<div class="medium-9 columns">
				<nav class="main-nav">
					<?php get_template_part( 'templates/menu', 'nav' ); ?>
				</nav>
			</div>
		</div>
	</header>

	<main class="website-container">
