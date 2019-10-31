<?php
/**
 * Custom Post Type Example
 *
 * This page walks you through creating a custom post type and taxonomies. You can
 * edit this one or copy the following code to create another one.
 *
 * I put this in a separate file so as to keep it organized. I find it easier to
 * edit and change things if they are concentrated in their own file.
 *
 * @package Temperance
 * @subpackage Custom Post Types
 */

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'temperance_flush_rewrite_rules' );

// Flush your rewrite rules
function temperance_flush_rewrite_rules() {
	flush_rewrite_rules();
}



/**
 * Let's create the function for the custom type
 *
 * @since version
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @return void
 */
function custom_post_example() {
	// creating (registering) the custom type
	register_post_type( 'custom_type',
		array( 'labels' => array(
				'name' => __( 'Custom Types', 'text-domain' ),
				'singular_name' => __( 'Custom Post', 'text-domain' ),
				'all_items' => __( 'All Custom Posts', 'text-domain' ),
				'add_new' => __( 'Add New', 'text-domain' ),
				'add_new_item' => __( 'Add New Custom Type', 'text-domain' ),
				'edit' => __( 'Edit', 'text-domain' ),
				'edit_item' => __( 'Edit Post Types', 'text-domain' ),
				'new_item' => __( 'New Post Type', 'text-domain' ),
				'view_item' => __( 'View Post Type', 'text-domain' ),
				'search_items' => __( 'Search Post Type', 'text-domain' ),
				'not_found' =>  __( 'Nothing found in the Database.', 'text-domain' ),
				'not_found_in_trash' => __( 'Nothing found in Trash', 'text-domain' ),
				'parent_item_colon' => ''
			),
			'description' => __( 'This is the example custom post type', 'text-domain' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8,
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png',
			'rewrite'	=> array( 'slug' => 'custom_type', 'with_front' => false ),
			'has_archive' => 'custom_type',
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		)
	);

	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'custom_type' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'custom_type' );

}

// adding the function to the WordPress init
add_action( 'init', 'custom_post_example');


// now let's add custom categories (these act like categories)
register_taxonomy( 'custom_cat',
	array( 'custom_type' ),
	array('hierarchical' => true,
		'labels' => array(
			'name' => __( 'Custom Categories', 'text-domain' ),
			'singular_name' => __( 'Custom Category', 'text-domain' ),
			'search_items' =>  __( 'Search Custom Categories', 'text-domain' ),
			'all_items' => __( 'All Custom Categories', 'text-domain' ),
			'parent_item' => __( 'Parent Custom Category', 'text-domain' ),
			'parent_item_colon' => __( 'Parent Custom Category:', 'text-domain' ),
			'edit_item' => __( 'Edit Custom Category', 'text-domain' ),
			'update_item' => __( 'Update Custom Category', 'text-domain' ),
			'add_new_item' => __( 'Add New Custom Category', 'text-domain' ),
			'new_item_name' => __( 'New Custom Category Name', 'text-domain' )
		),
		'show_admin_column' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'custom-slug' ),
	)
);


register_taxonomy( 'custom_tag',
	array('custom_type'),
	array('hierarchical' => false,
		'labels' => array(
			'name' => __( 'Custom Tags', 'text-domain' ),
			'singular_name' => __( 'Custom Tag', 'text-domain' ),
			'search_items' =>  __( 'Search Custom Tags', 'text-domain' ),
			'all_items' => __( 'All Custom Tags', 'text-domain' ),
			'parent_item' => __( 'Parent Custom Tag', 'text-domain' ),
			'parent_item_colon' => __( 'Parent Custom Tag:', 'text-domain' ),
			'edit_item' => __( 'Edit Custom Tag', 'text-domain' ),
			'update_item' => __( 'Update Custom Tag', 'text-domain' ),
			'add_new_item' => __( 'Add New Custom Tag', 'text-domain' ),
			'new_item_name' => __( 'New Custom Tag Name', 'text-domain' )
		),
		'show_admin_column' => true,
		'show_ui' => true,
		'query_var' => true,
	)
);


