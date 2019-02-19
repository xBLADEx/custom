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
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<a href="#main" class="skip-navigation"><?php esc_html_e( 'Skip navigation to main content.', 'custom' ); ?></a>

	<header class="g-header">
		<div class="g-row g-header__container">
			<div class="g-header__logo-container">
				<a href="<?php echo esc_url( home_url() ); ?>" class="g-header__logo">
					<span class="h-visual-hide"><?php esc_html_e( 'Custom', 'custom' ); ?></span>
					<?php get_template_part( 'assets/dist/images/logo.svg' ); ?>
				</a>
			</div>

			<div class="g-header__navigation">
				<nav class="navigation">
					<button class="button--reset navigation__menu-trigger" data-js-menu-trigger>
						<span class="fas fa-bars"></span>
						<span class="h-visual-hide"><?php esc_html_e( 'Menu', 'custom' ); ?></span>
					</button>

					<?php get_template_part( 'components/navigation' ); ?>
				</nav>
			</div>
		</div>
	</header>

	<main id="main" class="g-l-main">
