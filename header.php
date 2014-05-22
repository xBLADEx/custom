<?php
/* 
====================
	HEADER
====================
*/
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en" ><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title(); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="websiteContainer">
		<div class="headerBackground">
			<div class="row">
	            <div class="large-12 columns">
	            	<?php //get_template_part('templates/form', 'search'); ?>
	                <nav class="mainNav" role="navigation">
	                    <?php get_template_part('templates/menu', 'nav'); ?>
	                </nav>
	            </div>
	        </div>
		</div>
		
