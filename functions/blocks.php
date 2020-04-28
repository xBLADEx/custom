<?php
/**
 * Blocks
 *
 * @package Custom
 */

/**
 * Regsiter ACF Blocks
 */
function custom_acf_register_blocks() {
	acf_register_block(
		[
			'name'            => 'testimonial',
			'title'           => __( 'Testimonial', 'custom' ),
			'description'     => __( 'A custom testimonial block.', 'custom' ),
			'render_callback' => 'custom_acf_display_blocks',
			'category'        => 'custom-theme',
			'icon'            => 'admin-comments',
			'keywords'        => [ 'testimonial', 'quote' ],
			'mode'            => 'edit',
		]
	);

	acf_register_block(
		[
			'name'            => 'accordion',
			'title'           => __( 'Accordion', 'custom' ),
			'description'     => __( 'Accordion layout.', 'custom' ),
			'render_callback' => 'custom_acf_display_blocks',
			'category'        => 'custom-theme',
			'icon'            => 'menu-alt',
			'keywords'        => [ 'accordion' ],
			'mode'            => 'edit',
		]
	);
}

add_action( 'acf/init', 'custom_acf_register_blocks' );

/**
 * Adds the structured data blocks category to the Gutenberg categories.
 *
 * @param array $categories The current categories.
 *
 * @return array The updated categories.
 */
function custom_add_block_category( $categories ) {
	$categories[] = [
		'slug'  => 'custom-theme',
		'title' => __( 'Custom', 'custom' ),
	];

	return $categories;
}

add_filter( 'block_categories', 'custom_add_block_category' );
