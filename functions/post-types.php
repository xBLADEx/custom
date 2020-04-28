<?php
/**
 * Post Types
 *
 * @package Custom
 */

function custom_post_type() {
	// General Supports
	$supports = [
		'custom-fields',
		'editor',
		'page-attributes',
		'revisions',
		'thumbnail',
		'title',
	];

	$labels = [
		'name'          => __( 'Customs', 'custom' ),
		'singular_name' => __( 'Custom', 'custom' ),
	];

	$taxonomies = [
		// 'category', // Show post categories.
		'custom_name',
	];

	$args = [
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-layout', // https://developer.wordpress.org/resource/dashicons/
		'supports'           => $supports,
		'show_in_rest'       => true, // Enable Gutenberg Blocks.
		'rewrite'            => [
			'slug' => 'post-custom-name',
		],
		'taxonomies'         => $taxonomies,
	];

	register_post_type( 'custom', $args );

	// Taxonomy Labels {Name}
	$taxonomy_labels_name = [
		'name'          => __( 'Customs', 'custom' ),
		'singular_name' => __( 'Custom', 'custom' ),
		'search_items'  => __( 'Search Custom', 'custom' ),
		'edit_item'     => __( 'Edit Custom', 'custom' ),
		'add_new_item'  => __( 'Add New Custom', 'custom' ),
	];

	// Taxonomy Arguments {Name}
	$taxonomy_args_name = [
		'labels'       => $taxonomy_labels_name,
		'hierarchical' => true,
		'rewrite'      => [
			'slug' => 'taxonomy-custom-name',
		],
	];

	// Register Taxonomy {Name}
	register_taxonomy( 'custom_name', 'custom', $taxonomy_args_name );
}

// add_action( 'init', 'custom_post_type' ); // @codingStandardsIgnoreStart
