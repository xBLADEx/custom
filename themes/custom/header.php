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
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'body-site' ); ?>>
	<button class="mobile-menu-icon"><span><?php esc_html_e( 'Menu', 'custom' ); ?></span></button>

	<header class="header-background">
		<div class="row">
			<div class="small-12 medium-3 columns">
				<a href="/" class="logo"><?php get_template_part( 'assets/dist/images/logo.svg' ); ?></a>
			</div>

			<div class="medium-9 columns">
				<nav class="main-nav">
					<?php get_template_part( 'templates/menu-nav' ); ?>
				</nav>

				<?php get_template_part( 'templates/form-search' ); ?>
			</div>
		</div>
	</header>

	<main class="website-container">
