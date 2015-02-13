<?php
/**
 * temperance Custom Post Type Example
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
 * let's create the function for the custom type
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
				'name' => __( 'Custom Types', 'temperancetheme' ),
				'singular_name' => __( 'Custom Post', 'temperancetheme' ),
				'all_items' => __( 'All Custom Posts', 'temperancetheme' ),
				'add_new' => __( 'Add New', 'temperancetheme' ),
				'add_new_item' => __( 'Add New Custom Type', 'temperancetheme' ),
				'edit' => __( 'Edit', 'temperancetheme' ),
				'edit_item' => __( 'Edit Post Types', 'temperancetheme' ),
				'new_item' => __( 'New Post Type', 'temperancetheme' ),
				'view_item' => __( 'View Post Type', 'temperancetheme' ),
				'search_items' => __( 'Search Post Type', 'temperancetheme' ),
				'not_found' =>  __( 'Nothing found in the Database.', 'temperancetheme' ),
				'not_found_in_trash' => __( 'Nothing found in Trash', 'temperancetheme' ),
				'parent_item_colon' => ''
			),
			'description' => __( 'This is the example custom post type', 'temperancetheme' ),
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

// adding the function to the Wordpress init
add_action( 'init', 'custom_post_example');


// now let's add custom categories (these act like categories)
register_taxonomy( 'custom_cat',
	array( 'custom_type' ),
	array('hierarchical' => true,
		'labels' => array(
			'name' => __( 'Custom Categories', 'temperancetheme' ),
			'singular_name' => __( 'Custom Category', 'temperancetheme' ),
			'search_items' =>  __( 'Search Custom Categories', 'temperancetheme' ),
			'all_items' => __( 'All Custom Categories', 'temperancetheme' ),
			'parent_item' => __( 'Parent Custom Category', 'temperancetheme' ),
			'parent_item_colon' => __( 'Parent Custom Category:', 'temperancetheme' ),
			'edit_item' => __( 'Edit Custom Category', 'temperancetheme' ),
			'update_item' => __( 'Update Custom Category', 'temperancetheme' ),
			'add_new_item' => __( 'Add New Custom Category', 'temperancetheme' ),
			'new_item_name' => __( 'New Custom Category Name', 'temperancetheme' )
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
			'name' => __( 'Custom Tags', 'temperancetheme' ),
			'singular_name' => __( 'Custom Tag', 'temperancetheme' ),
			'search_items' =>  __( 'Search Custom Tags', 'temperancetheme' ),
			'all_items' => __( 'All Custom Tags', 'temperancetheme' ),
			'parent_item' => __( 'Parent Custom Tag', 'temperancetheme' ),
			'parent_item_colon' => __( 'Parent Custom Tag:', 'temperancetheme' ),
			'edit_item' => __( 'Edit Custom Tag', 'temperancetheme' ),
			'update_item' => __( 'Update Custom Tag', 'temperancetheme' ),
			'add_new_item' => __( 'Add New Custom Tag', 'temperancetheme' ),
			'new_item_name' => __( 'New Custom Tag Name', 'temperancetheme' )
		),
		'show_admin_column' => true,
		'show_ui' => true,
		'query_var' => true,
	)
);

/*
	looking for custom meta boxes?
	check out this fantastic tool:
	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
*/


