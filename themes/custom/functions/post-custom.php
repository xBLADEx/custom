<?php
/**
 * Post Custom
 *
 * @package Custom
 */

/**
 * Set Excerpt Length
 * Return the amount of words to display.
 *
 * @author Rich Edmunds
 */
function custom_excerpt_length() {
	return 15;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Post Excerpt
 * @todo Test this function.
 *
 * @param  string $text Text.
 * @return string       Modified excerpt.
 */
function custom_excerpt( $text ) {
	// Return early if not empty string.
	if ( '' !== $text ) {
		return;
	}

	global $post;

	$text = apply_filters( 'the_content', get_the_content( '' ) );
	$text = str_replace( '\]\]\>', ']]&gt;', $text );
	$text = preg_replace( '@<script[^>]*?>.*?</script>@si', '', $text );
	$text = strip_tags( $text, '<p>' );

	$excerpt_length = custom_excerpt_length();

	$words = explode( ' ', $text, $excerpt_length + 1 );

	if ( count( $words ) > $excerpt_length ) {
		array_pop( $words );
		array_push( $words, '... <br><br><a href="' . get_permalink( $post->ID ) . '" class="button">' . esc_html__( 'Read More', 'custom' ) . '</a>' );
		$text = implode( ' ', $words );
	}

	return $text;
}

remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'custom_excerpt' );

/**
 * Custom Pagination
 *
 * @see http://codex.wordpress.org/Function_Reference/paginate_links.
 */
function custom_pagination( $query = '' ) {
	global $wp_query;

	// If query is left blank, set to global default wp query.
	if ( '' === $query ) {
		$query = $wp_query;
	}

	$big = 999999999;

	$args = array(
		'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'             => '/page/%#%',
		'total'              => $query->max_num_pages,
		'current'            => max( 1, get_query_var( 'paged' ) ),
		'show_all'           => false,
		'end_size'           => 1,
		'mid_size'           => 2,
		'prev_next'          => true,
		'prev_text'          => __( '&laquo; Previous', 'custom' ),
		'next_text'          => __( 'Next &raquo;', 'custom' ),
		'type'               => 'list',
		'add_args'           => false,
		'add_fragment'       => '',
		'before_page_number' => '',
		'after_page_number'  => '',
	);

	echo paginate_links( $args ); // WPCS: XSS OK.
}

/*
@todo Explore this, remove CPTUI plugin.
add_action( 'init', 'base_post_init' );

function base_post_init() {
	$labels = array(
		'name'               => 'base Post Type',
		'singular_name'      => 'base Post',
		'menu_name'          => 'base',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New base Post',
		'new_item'           => 'New base Post',
		'edit_item'          => 'Edit base Post',
		'view_item'          => 'View base Post',
		'all_items'          => 'All base Posts',
		'search_items'       => 'Search base Posts',
		'parent_item_colon'  => '',
		'not_found'          => 'No base Posts found.',
		'not_found_in_trash' => 'No base Posts found in Trash.',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-editor-table',
		'supports'           => array( 'title', 'custom-fields' )
	);

	register_post_type( 'base-post', $args );
} */
