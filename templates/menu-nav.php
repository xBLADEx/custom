<?php
wp_nav_menu( array(
	'theme_location' => 'mainNav',
	//'after' => '',
	'depth' => 2,
	'items_wrap' => '<ul class="navbar">%3$s</ul>',
	'fallback_cb' => 'required_menu_fallback', // workaround to show a message to set up a menu
	'walker' => new Custom_Navigation_Walker()
) ); ?>