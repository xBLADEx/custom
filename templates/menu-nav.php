<?php
/* 
====================
	NAVIGATION
====================
*/
?>
<?php // http://codex.wordpress.org/Function_Reference/wp_nav_menu
wp_nav_menu( array(
	'theme_location'	=> 'mainNav',
	'menu'				=> '',
	'container'       	=> false,
	'container_class' 	=> '',
	'container_id'    	=> '',
	'menu_class'      	=> '',
	'menu_id'         	=> '',
	'echo'            	=> true,
	'fallback_cb' 		=> 'wp_page_menu',
	'before'          	=> '',
	'after'           	=> '',
	'link_before'     	=> '',
	'link_after'      	=> '',
	'items_wrap' 		=> '<ul class="navbar">%3$s</ul>',
	'depth' 			=> 2,
	'walker' 			=> new Custom_Navigation_Walker()
) ); 
?>