<?php
/**
 * Sidebar related functions
 *
 * This file is part of the Temperance starter theme by Andrew Woods
 *
 * @license GPLv2
 * @author Andrew Woods <andrew@andrewwoods.net>
 * @package Plugin\Navigation
 *
 */

/**
 * Sidebars & Widget Areas
 *
 * @since 1.0
 *
 * @return void
 */
function temperance_register_sidebars() {
	register_sidebar(
		[
			'id' => 'sidebar_main',
			'name' => __( 'Main Sidebar', 'text-domain' ),
			'description' => __( 'The primary sidebar.', 'text-domain' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		]
	);

	register_sidebar(
		[
			'id' => 'sidebar_alt',
			'name' => __( 'Alternate Sidebar', 'text-domain' ),
			'description' => __( 'A different sidebar.', 'text-domain' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		]
	);
}

