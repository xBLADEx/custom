<?php
//--------------------------------------------------------------
// View
//--------------------------------------------------------------

//--------------------------------------------------------------
// Blank Search Fix
//--------------------------------------------------------------
if ( ! function_exists( 'blank_search' ) ) {
	function blank_search( $query ) {
	    // If "s" request variable is set but empty
	    if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) && $query->is_main_query() ) {
	        $query->is_search = true;
	        $query->is_home = false;
	    }
	    return $query;
	}
	add_filter( 'pre_get_posts', 'blank_search' );
}

//--------------------------------------------------------------
// Shortcodes
//--------------------------------------------------------------
add_shortcode( 'name', 'function_name' ); // [name]
function function_name() {
	ob_start();
	?>

	<?php
	return ob_get_clean();
}
