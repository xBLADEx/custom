<?php
/* 
====================
	FUNCTIONS - ADMIN
====================
*/
/* 
====================
	REMOVE QUICKTAGS
====================
*/
if ( ! function_exists( 'custom_remove_quicktags' ) ) {
	function custom_remove_quicktags( $qt_init ) {
		// Whatever is in the below string displays in the editor. !Important! No spaces after the comma.
		$qt_init['buttons'] = 'link';
		return $qt_init;
	}
	add_filter( 'quicktags_settings', 'custom_remove_quicktags' );
}
/* 
====================
	ADD QUICKTAGS
====================
*/
if ( ! function_exists( 'custom_add_quicktags' ) ) {
	function custom_add_quicktags() { ?>
		<script>
			if ( typeof( QTags ) == 'function' ) {
				QTags.addButton( 'eg_div6', 'div 6', '<div class="medium-6 columns">\n', '\n</div>', 'd', 'Div 6', 1 );
				QTags.addButton( 'eg_div', 'div', '<div class="">\n', '\n</div>', 'd', 'Division', 1 );
				QTags.addButton( 'eg_h2', 'H2', '<h2>', '</h2>', '2', 'Heading 2', 1 );
				QTags.addButton( 'eg_h3', 'H3', '<h3>', '</h3>', '3', 'Heading 3', 1 );
				QTags.addButton( 'eg_h4', 'H4', '<h4>', '</h4>', '4', 'Heading 4', 1 );
				QTags.addButton( 'eg_paragraph', 'p', '<p>', '</p>', 'p', 'Paragraph', 1 );
		        QTags.addButton( 'eg_span', 'span', '<span>', '</span>', 'span', 'Span', 1 );
		        QTags.addButton( 'eg_bold', 'bold', '<span class="bold">', '</span>', 'bold', 'Bold', 1 );
		        QTags.addButton( 'eg_italic', 'italic', '<span class="italic">', '</span>', 'italic', 'Italic', 1 );
				QTags.addButton( 'eg_break', 'br', '<br>', '', 'b', 'Line Break', 20 );
				QTags.addButton( 'eg_hrule', 'hr', '<hr>\n', '', 'h', 'Horizontal Rule', 20 );
				QTags.addButton( 'eg_ordered', 'ol', '<ol>\n', '\n</ol>', 'o', 'Ordered List', 20 );
				QTags.addButton( 'eg_unordered', 'ul', '<ul>\n', '\n</ul>', 'u', 'Unordered List', 20 );
				QTags.addButton( 'eg_listitem', 'li', '<li>', '</li>', 'l', 'List Item', 20 );
			}
		</script>
	<?php
	}
	add_action( 'admin_print_footer_scripts', 'custom_add_quicktags' );
}
/* 
====================
	LOGIN LOGO
====================
*/
if ( ! function_exists( 'custom_login_logo' ) ) {
	function custom_login_logo() { // http://codex.wordpress.org/Customizing_the_Login_Form 
	?>
	    <style>
	        body.login div#login h1 a {
	            background-image: url('<?php echo THEME_IMAGES; ?>/logo-login.jpg');
	            padding-bottom: 30px;
	        }
	    </style>
	<?php 
	}
	add_action( 'login_enqueue_scripts', 'custom_login_logo' );
}