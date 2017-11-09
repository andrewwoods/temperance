<?php
/**
 * Navigation related functions
 *
 * This file is part of the Temperance starter theme by Andrew Woods
 *
 * @license GPLv2
 * @author Andrew Woods <andrew@andrewwoods.net>
 * @package Plugin\Navigation
 */

/**
 * Primary (main) navigation menu for Temperance
 *
 * Registers a main menu
 *
 * @since 1.0.0
 *
 * @uses wp_nav_menu()
 *
 * @return void
 */
function temperance_main_nav() {

	wp_nav_menu(
		array(
			'container' => 'nav',
			'container_id' => 'primary-navigation',
			'container_class' => 'nav primary-nav',
			'menu' => __( 'Main Menu', 'temperancetheme' ),
			'menu_id' => 'main-menu',
			'menu_class' => 'menu menu-main',
			'theme_location' => 'main-menu',
			'before' => '',
			'after' => '',
			'link_before' => '',
			'link_after' => '',
			'depth' => 0,
			'fallback_cb' => 'temperance_main_nav_fallback',
		)
	);
}


/**
 * This is the fallback for main menu.
 *
 * @since 1.0.0
 *
 * @uses {wp_page_menu()}
 *
 * @return void
 */
function temperance_main_nav_fallback() {
	wp_page_menu(
		array(
			'show_home' => true,
			'menu_class' => 'nav top-nav clearfix',
			'include' => '',
			'exclude' => '',
			'echo' => true,
			'link_before' => '',
			'link_after' => '',
		)
	);
}

/**
 * The footer menu (should you choose to use one).
 *
 * Registers a footer menu.
 *
 * @since 1.0.0
 *
 * @uses wp_nav_menu()
 * @return void
 */
function temperance_footer_nav() {

	wp_nav_menu(
		array(
			'container' => 'nav',
			'container_id' => 'footer-navigation',
			'container_class' => 'nav footer-nav',
			'menu' => __( 'Footer Navigation', 'temperancetheme' ),
			'menu_id' => 'footer-menu',
			'menu_class' => 'menu menu-footer',
			'theme_location' => 'footer-menu',
			'before' => '',
			'after' => '',
			'link_before' => '',
			'link_after' => '',
			'depth' => 0,
			'fallback_cb' => 'temperance_footer_links_fallback',
		)
	);
}



/**
 * This is the fallback for footer menu.
 *
 * This is intentionally blank. it's a placeholder. add what you like.
 *
 * @since 1.0.0
 *
 * @uses {wp_page_menu()}
 *
 * @return void
 */
function temperance_footer_nav_fallback() {
	/* you can put a default here if you like */
	echo '';
}




/**
 * Display multi-page navigation
 *
 * Use the WP_Query object to determine the number of items in page results
 * and create page navigation if necessary
 *
 * @since 1.0.0
 *
 * @global WP_Query $query
 * @return void
 */
function temperance_pagination_links() {
	global $wp_query;
	$big_num = 999999999;
	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	echo '<nav id="pagination-links" class="pagination">';

	echo paginate_links(
		array(
			'base' => str_replace( $big_num, '%#%', esc_url( get_pagenum_link( $big_num ) ) ),
			'format' => '',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total' => $wp_query->max_num_pages,
			'prev_text' => '&larr;',
			'next_text' => '&rarr;',
			'type' => 'list',
			'end_size' => 3,
			'mid_size' => 3,
		)
	);

	echo '</nav>';
}

/**
 * Display the website copyright statement
 */
function temperance_copyright() {
	echo '&copy;' . date( 'Y' ) . ' ' . get_bloginfo( 'name' );
}
