<?php
/**
 * Class Custom Theme Options
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
			__( 'Theme Options', 'custom' ), // Page Title.
			__( 'Theme Options', 'custom' ), // Menu Title.
			'manage_options', // Capability.
			'theme-options', // Slug.
			array( 'Custom_Theme_Options', 'display_options_page' ) // Function.
		);
	}

	/**
	 * Options Page
	 *
	 * Add menu page.
	 */
	public function display_options_page() {
		?>
		<div class="wrap">
			<h2><?php esc_html_e( 'Theme Options', 'custom' ); ?></h2>
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
			__( 'Theme Settings', 'custom' ), // Title displayed within <h3>.
			array( $this, 'rich_main_section_cb' ), // Callback.
			'theme-options' // Page - Needs to match the slug url.
		);

		add_settings_field(
			'theme_email_heading', // Name heading or title also ID.
			__( 'Contact Form Email: ', 'custom' ),
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
		esc_html_e( 'Input your email for the contact form. For multiple emails use a comma to separate.', 'custom' );
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
