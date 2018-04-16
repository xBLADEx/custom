<?php
/**
 * Theme Support
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
var QTags;

if ( 'function' === typeof( QTags ) ) {
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

/**
 * Theme Support
 */
function custom_support() {
	// Featured Images.
	add_theme_support( 'post-thumbnails' );

	/**
	 * Post Formats
	 *
	 * @see http://codex.wordpress.org/Post_Formats.
	 */
	// add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery', 'status' ) );
}

add_action( 'after_setup_theme', 'custom_support' );

// ACF Options Page.
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();
}

/**
* Hide ACF Menu
*
* @author Rich Edmunds
*/
function custom_hide_acf_admin() {
	// Get the current site url
	$site_url = get_bloginfo( 'url' );

	$show_menu = [
		'https://custom.test',
	];

	// If the url matches our dev url show the menu.
	if ( in_array( $site_url, $show_menu, true ) ) {
		// Show the acf menu item
		return true;
	} else {
		// Hide the acf menu item
		return false;
	}
}

add_filter( 'acf/settings/show_admin', 'custom_hide_acf_admin' );

/**
 * ACF Flexible Content
 * Loop through and output ACF flexible content blocks for the current page.
 *
 * @author Rich Edmunds
 */
function custom_display_content_blocks() {
	if ( have_rows( 'content_blocks' ) ) :
		while ( have_rows( 'content_blocks' ) ) :
			the_row();
			// Template part name MUST match layout ID (Name).
			// @example block-media_section
			get_template_part( 'components/block', get_row_layout() );
		endwhile;

		wp_reset_postdata();
	endif;
}

/**
 * Add Page Body CSS Class
 * Add class name of page to the body element.
 *
 * @author Rich Edmunds
 * @param  array $classes The current body classes.
 * @return array $classes Add classes.
 */
function custom_body_classes( $classes ) {
	if ( is_singular( 'page' ) ) {
		global $post;

		$classes[] = 'page-' . $post->post_name;
	}

	return $classes;
}

add_filter( 'body_class', 'custom_body_classes' );

/**
 * SMTP
 *
 * Overrides PHP mailer to send through SMTP.
 * Currently using MailGun.
 *
 * @author Rich Edmunds
 * @see    https://codex.wordpress.org/Plugin_API/Action_Reference/phpmailer_init
 * @see    https://www.mailgun.com/
 * @param  PHPMailer $phpmailer Object to set values.
 */
function custom_phpmailer_smtp( PHPMailer $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->Host       = 'smtp.mailgun.org';
	$phpmailer->SMTPAuth   = true;
	$phpmailer->Port       = 465;
	$phpmailer->Username   = '{websitename}@mg.domain.com';
	$phpmailer->Password   = '{password}';
	$phpmailer->SMTPSecure = 'ssl'; // SSL or TLS.
	$phpmailer->From       = 'no-reply@' . $_SERVER['HTTP_HOST'];
	// $phpmailer->FromName   = '{Full Name}'; // Optional.
}

// add_action( 'phpmailer_init', 'custom_phpmailer_smtp' );

/**
 * Allowed HTML Tags
 * The html tags allowed from a wysiwyg editor.
 *
 * @example wp_kses( $content, custom_allowed_tags() )
 * @author Rich Edmunds
 * @return array Array of allowed tags.
 */
function custom_allowed_tags() {
	return [
		'a'          => [
			'class' => [],
			'href'  => [],
			'rel'   => [],
			'title' => [],
		],
		'abbr'       => [
			'title' => [],
		],
		'b'          => [],
		'blockquote' => [
			'cite' => [],
		],
		'cite'       => [
			'title' => [],
		],
		'code'       => [],
		'del'        => [
			'datetime' => [],
			'title'    => [],
		],
		'dd'         => [],
		'div'        => [
			'class' => [],
			'title' => [],
			'style' => [],
		],
		'dl'         => [],
		'dt'         => [],
		'em'         => [],
		'h1'         => [],
		'h2'         => [],
		'h3'         => [],
		'h4'         => [],
		'h5'         => [],
		'h6'         => [],
		'i'          => [],
		'iframe'     => [
			'src'             => [],
			'height'          => [],
			'width'           => [],
			'frameborder'     => [],
			'allowfullscreen' => [],
		],
		'img'        => [
			'alt'    => [],
			'class'  => [],
			'height' => [],
			'src'    => [],
			'width'  => [],
		],
		'li'         => [
			'class' => [],
		],
		'ol'         => [
			'class' => [],
		],
		'p'          => [
			'class' => [],
		],
		'q'          => [
			'cite'  => [],
			'title' => [],
		],
		'span'       => [
			'class' => [],
			'title' => [],
			'style' => [],
		],
		'strike'     => [],
		'strong'     => [],
		'ul'         => [
			'class' => [],
		],
	];
}
