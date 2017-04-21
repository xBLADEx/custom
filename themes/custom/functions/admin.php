<?php
/**
 * Admin
 *
 * @package Custom
 */

// Do not allow file edit.
define( 'DISALLOW_FILE_EDIT', true );

// Insert images default link type to none.
update_option( 'image_default_link_type', 'none' );

/**
 * Remove Quicktags
 *
 * @param  array $qt_init Element.
 * @return array          Editor tags.
 */
function custom_remove_quicktags( $qt_init ) {
	// Whatever is in the below string displays in the editor. Important: No spaces after the comma.
	$qt_init['buttons'] = 'link,ul,ol,li,code';

	return $qt_init;
}

add_filter( 'quicktags_settings', 'custom_remove_quicktags' );

/**
 * Add Custom Quicktags
 */
function custom_add_quicktags() {
	?>
	<script>
	if ( typeof( QTags ) == 'function' ) {
		QTags.addButton( 'eg_div', 'div', '<div class="">\n', '\n</div>', 'd', 'Division', 1 );
		QTags.addButton( 'eg_h2', 'h2', '<h2>', '</h2>', '2', 'Heading 2', 1 );
		QTags.addButton( 'eg_h3', 'h3', '<h3>', '</h3>', '3', 'Heading 3', 1 );
		QTags.addButton( 'eg_h4', 'h4', '<h4>', '</h4>', '4', 'Heading 4', 1 );
		QTags.addButton( 'eg_paragraph', 'p', '<p>', '</p>', 'p', 'Paragraph', 1 );
		QTags.addButton( 'eg_span', 'span', '<span>', '</span>', 'span', 'Span', 1 );
		QTags.addButton( 'eg_bold', 'bold', '<span class="bold">', '</span>', 'bold', 'Bold', 1 );
		QTags.addButton( 'eg_italic', 'italic', '<span class="italic">', '</span>', 'italic', 'Italic', 1 );
		QTags.addButton( 'eg_break', 'br', '<br>', '', 'b', 'Line Break', 20 );
		QTags.addButton( 'eg_hrule', 'hr', '<hr>\n', '', 'h', 'Horizontal Rule', 20 );
	}
	</script>
	<?php
}

add_action( 'admin_print_footer_scripts', 'custom_add_quicktags' );

// ACF Options Page.
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();
}
