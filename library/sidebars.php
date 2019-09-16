<?php


/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                 Sidebars                                    *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
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
			'name' => __( 'Main Sidebar', 'temperancetheme' ),
			'description' => __( 'The primary sidebar.', 'temperancetheme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		]
	);
}

