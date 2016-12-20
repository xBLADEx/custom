<?php
/**
 * View
 *
 * @package Custom
 */

if ( ! function_exists( 'blank_search' ) ) {

	/**
	 * Blank Search
	 *
	 * @param  string $query Query.
	 * @return string        Query.
	 */
	function blank_search( $query ) {
	    // If "s" request variable is set but empty.
	    if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) && $query->is_main_query() ) {
	        $query->is_search = true;
	        $query->is_home = false;
	    }
	    return $query;
	}

	add_filter( 'pre_get_posts', 'blank_search' );

}

// Shortcodes.
add_shortcode( 'name', 'function_name' ); // Use Shortcode: [name].
/**
 * Shortcode
 *
 * @return string HTML.
 */
function function_name() {
	ob_start();
	?>

	<?php
	return ob_get_clean();
}
