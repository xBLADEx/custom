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

/**
 * Login Logo
 *
 * @see http://codex.wordpress.org/Customizing_the_Login_Form.
 */
function custom_login_logo() {
	?>
	<style>
	body.login div#login h1 a {
		background-image: url('<?php echo esc_attr( THEME_IMAGES ); ?>/logo-login.jpg');
		padding-bottom: 30px;
	}
	</style>
	<?php
}

add_action( 'login_enqueue_scripts', 'custom_login_logo' );

/**
 * Theme Options
 */
class Custom_Theme_Options {
	/**
	 * Options
	 *
	 * @var string
	 */
	public $options;

	/**
	 * Construct
	 */
	public function __construct() {
		// Delete Option: $this->options = delete_option( 'custom_theme_setting' );.
		$this->options = get_option( 'custom_theme_setting' );
		$this->register_settings_fields();
	}

	/**
	 * Add Menu
	 *
	 * @see https://codex.wordpress.org/Function_Reference/add_menu_page.
	 */
	public function add_menu_page() {
		add_options_page(
			'Theme Options', 	// Page Title.
			'Theme Options', 	// Menu Title.
			'manage_options',	// Capability.
			'theme-options',	// Slug.
			array( 'Custom_Theme_Options', 'display_options_page' ) // Function.
		);
	}

	/**
	 * Options Page
	 * Add menu page.
	 */
	public function display_options_page() {
		?>
		<div class="wrap">
			<h2>Theme Options</h2>
			<form action="options.php" method="POST">
				<?php
					settings_fields( 'custom_theme_setting' ); // register_setting() 1st arg Group Name.
					do_settings_sections( 'theme-options' );
					submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register Settings Fields
	 */
	public function register_settings_fields() {
		register_setting( // 1 & 2. Codex says use same name, 3. Optional - Used for sanitizing / validating.
			'custom_theme_setting', // Group.
			'custom_theme_setting',	// Name - Used with get_option() / update_option().
			array( $this, 'custom_validation' )
		); // See: https://codex.wordpress.org/Function_Reference/register_setting.

		add_settings_section(
			'rich_main_section', // ID.
			'Theme Settings', // Title displayed within <h3>.
			array( $this, 'rich_main_section_cb' ), // Callback.
			'theme-options' // Page - Needs to match the slug url.
		);

		add_settings_field(
			'theme_email_heading', // Name heading or title also ID.
			'Contact Form Email: ',
			array( $this, 'theme_email_field_cb' ), // Callback.
			'theme-options', // Page.
			'rich_main_section' // Section - add_settings_section 1st arg.
		);
	}

	/**
	 * Callback
	 *
	 * @param  string $input Field input.
	 * @return string        Fields.
	 */
	public function custom_validation( $input ) {
		// Create new array() to store options.
		$output = array();

		// Loop and check all options.
		foreach ( $input as $key => $value ) {
			// If option has value, proceed.
			if ( isset( $input[$key] ) ) {
				// Clean HTML tags.
				$output[$key] = strip_tags( stripslashes( $input[$key] ) );
			}
		}

		return $output;
	}

	/**
	 * Description
	 */
	public function rich_main_section_cb() {
		echo 'Input your email for the contact form. For multiple emails use a comma to separate.';
	}

	/**
	 * Email Field
	 */
	public function theme_email_field_cb() {
		echo "<input class='regular-text' name='custom_theme_setting[theme_email_heading]' type='text' value='{$this->options['theme_email_heading']}' >";
	}
}

add_action( 'admin_menu', function() {
	Custom_Theme_Options::add_menu_page(); // The double colon :: calls a function without instantiating the entire class.
});

add_action( 'admin_init', function() {
	new Custom_Theme_Options(); // This will automatically call the __construct() function.
});

// ACF Options Page.
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();
}
