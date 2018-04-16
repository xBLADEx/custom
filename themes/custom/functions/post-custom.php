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
 * Remove Sticky Post
 *
 * @param  string $classes Classes.
 * @return string          Classes.
 */
function custom_remove_sticky( $classes ) {
	$classes = array_diff( $classes, array( 'sticky' ) );

	return $classes;
}

// add_filter( 'post_class', 'custom_remove_sticky' );

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

/**
 * @todo Test this.
 * Base breadcrumbs
 * Simple breadcrumbs function for displaying parent pages.
 * Could be expanded to include categories, dates, ect. if needed.
 *
 * @author Paul Allen
 */
function base_display_page_breadcrumbs() {
	// Bail if on home page
	if ( is_front_page() ) {
		return;
	}

	global $post;
	$current_page_title = $post->post_title;
	$post_parent = $post->post_parent;
	$breadcrumbs = array();

	while ( $post_parent ) {
		$page       = get_post( $post_parent );
		$page_id    = $page->ID;
		$page_link  = get_permalink( $page_id );
		$page_title = $page->post_title;
		$breadcrumb = [
			'title' => $page_title,
			'url'   => $page_link,
		];
		array_unshift( $breadcrumbs, $breadcrumb ); // Add it to the beginning of the array

		$post_parent = $page->post_parent; // Move up the chain by finding parent post if any
	}
	?>

	<ul class="c-breadcrumbs">
		<li class="c-breadcrumbs__item">
			<a href="<?php echo esc_url( home_url() ); ?>" class="c-breadcrumbs__anchor"><?php esc_html_e( 'Home', 'base' ); ?></a>
		</li>

		<?php foreach ( $breadcrumbs as $link ) : ?>
			<li class="c-breadcrumbs__item">
				<a href="<?php echo esc_url( $link['url'] ); ?>" class="c-breadcrumbs__anchor"><?php echo esc_html( $link['title'] ); ?></a>
			</li>
		<?php endforeach; ?>

		<li class="c-breadcrumbs__item"><?php echo esc_html( $current_page_title ); ?></li>
	</ul>

	<?php
	wp_reset_postdata();
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
