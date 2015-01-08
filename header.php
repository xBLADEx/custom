<?php
/* 
====================
	HEADER
====================
*/
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title(); ?></title>
	<link rel="icon" href="<?php bloginfo( 'template_directory' ); ?>/images/favicon.ico" type="image/x-icon">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<main id="website-container" role="main">
		<a href="#" class="menu-icon"><span>Menu</span></a>
		<header class="header-background">
			<div class="row">
				<div class="small-12 medium-3 columns">
					<a href="/" class="logo"><img src="<?php bloginfo( 'template_directory' ); ?>/images/logo.png" alt=""></a>
				</div>
	            <div class="medium-9 columns">
	            	<?php //get_template_part('templates/form', 'search'); ?>
	                <nav class="main-nav" role="navigation">
	                    <?php get_template_part( 'templates/menu', 'nav' ); ?>
	                </nav>
	            </div>
	        </div>
		</header>