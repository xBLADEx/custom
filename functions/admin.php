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
/* 
====================
	THEME OPTIONS
====================
*/
class Custom_Theme_Options {

	public $options;

	public function __construct() {
		//$this->options = delete_option( 'custom_theme_setting' );
		$this->options = get_option( 'custom_theme_setting' );
		$this->register_settings_fields();
	}

	public function add_menu_page() {
		add_options_page( // https://codex.wordpress.org/Function_Reference/add_menu_page
			'Theme Options', 	// Page Title
			'Theme Options', 	// Menu Title
			'manage_options',	// Capability 
			'theme-options',	// Slug
			array( 'Custom_Theme_Options', 'display_options_page' ) // Function
		); 
	}

	// Add Menu Page - Options Page
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

	public function register_settings_fields() {
		
		register_setting( // 1 & 2. Codex says use same name, 3. Optional - Used for sanitizing / validating
			'custom_theme_setting', // Group
			'custom_theme_setting',	// Name - Used with get_option() / update_option()
			array( $this, 'custom_validation' )
		); // https://codex.wordpress.org/Function_Reference/register_setting
		
		add_settings_section( // 1. ID, 2. Title displayed within <h3>, 3. Callback, 4. Page - Needs to match the slug url
			'rich_main_section',
			'Theme Settings',
			array( $this, 'rich_main_section_cb' ),
			'theme-options'
		); 

		add_settings_field( // 1. Name heading or title also ID, 3. Callback, 4. Page, 5. Section - add_settings_section 1st arg.
			'theme_email_heading',
			'Contact Form Email: ',
			array( $this, 'theme_email_field_cb' ), 
			'theme-options', 
			'rich_main_section'
		);

	}

	// CALLBACKS
	public function custom_validation( $input ) {
		//$input['custom_theme_setting'] = strip_tags( stripslashes( $input['custom_theme_setting'] ) );
		//return $input;

		// Create new array() to store options
		$output = array();
		// Loop and check all options
		foreach ( $input as $key => $value ) {
			// If option has value, proceed
			if ( isset( $input[$key] ) ) {
				// Clean HTML tags
				$output[$key] = strip_tags( stripslashes( $input[$key] ) );
			}
		}
		return $output;
	}

	public function rich_main_section_cb() {
		echo 'Input your email for the contact form. For multiple emails use a comma to separate.';
	}

	// Email Field
	public function theme_email_field_cb() {
		echo "<input class='regular-text' name='custom_theme_setting[theme_email_heading]' type='text' value='{$this->options['theme_email_heading']}' >";
	}
	
}

add_action( 'admin_menu', function() {
	Custom_Theme_Options::add_menu_page(); // The double colon :: calls a function without instantiating the entire class
});

add_action( 'admin_init', function() { 
	new Custom_Theme_Options(); // This will automatically call the __construct() function.
});