<?php
//--------------------------------------------------------------
// Header
//--------------------------------------------------------------
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title('-', true, 'right'); ?></title>
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-194x194.png" sizes="194x194">
	<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-TileImage" content="/mstile-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'body-site' ); ?>>
	<a href="#" class="menu-icon"><span>Menu</span></a>
	<header class="header-background">
		<div class="row">
			<div class="small-12 medium-3 columns">
				<a href="/" class="logo"><img src="<?php echo THEME_IMAGES; ?>/logo.png" alt=""></a>
			</div>
            <div class="medium-9 columns">
            	<?php //get_template_part('templates/form', 'search'); ?>
                <nav class="main-nav">
                    <?php get_template_part( 'templates/menu', 'nav' ); ?>
                </nav>
            </div>
        </div>
	</header>
	<?php
	/*if ( ! is_front_page() ) {
		switch ( $post->post_name ) {
			case 'url':
				get_template_part( 'templates/header', 'name' );
				break;
			default:
				get_template_part( 'templates/header', 'default' );
		}
	}*/
	?>
	<main class="website-container">
