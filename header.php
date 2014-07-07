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
	<meta charset="UTF-8">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title(); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<main>
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
		
