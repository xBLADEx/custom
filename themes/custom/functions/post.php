<?php
/**
 * Post
 *
 * @package Custom
 */

/**
 * Post Excerpt
 *
 * @param  string $text Text.
 * @return string       Modified excerpt.
 */
function custom_excerpt( $text ) {
	global $post;

	if ( '' === $text ) {
		$text = get_the_content( '' );
		$text = apply_filters( 'the_content', $text );
		$text = str_replace( '\]\]\>', ']]&gt;', $text );
		$text = preg_replace( '@<script[^>]*?>.*?</script>@si', '', $text );
		$text = strip_tags( $text, '<p>' );

		$excerpt_length = 80;

		$words = explode( ' ', $text, $excerpt_length + 1 );

		if ( count( $words ) > $excerpt_length ) {
			array_pop( $words );
			array_push( $words, '... <br><br><a href="' . get_permalink( $post->ID ) . '" class="button">Read More</a>' );
			$text = implode( ' ', $words );
		}
	}

	return $text;
}

remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );

add_filter( 'get_the_excerpt', 'custom_excerpt' );

/**
 * Remove Sticky Post
 *
 * @param  string $classes Classes.
 * @return string          Classes.
 */
function custom_remove_sticky( $classes ) {
	$classes = array_diff( $classes, array( 'sticky' ) );

	return $classes;
}

add_filter( 'post_class', 'custom_remove_sticky' );

/**
 * Custom Pagination
 *
 * @see http://codex.wordpress.org/Function_Reference/paginate_links.
 */
function custom_pagination() {
	global $custom_query;

	$big = 999999999;

	$args = array(
		'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'             => '?page=%#%',
		'total'              => $custom_query->max_num_pages,
		'current'            => max( 1, get_query_var( 'paged' ) ),
		'show_all'           => false,
		'end_size'           => 1,
		'mid_size'           => 2,
		'prev_next'          => true,
		'prev_text'          => '&laquo; Previous',
		'next_text'          => 'Next &raquo;',
		'type'               => 'list',
		'add_args'           => false,
		'add_fragment'       => '',
		'before_page_number' => '',
		'after_page_number'  => '',
	);

	echo paginate_links( $args );
}
