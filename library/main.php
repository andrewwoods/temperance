<?php
/**
 * This is the core Temperance file where most of the main functions & features
 * reside. If you have any custom functions, it's best to put them in the
 * functions.php file.
 *
 *
 * @package Temperance
 * @subpackage Subpackage name
 * @author firstname lastname <user@host.com>
 */

/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   WORDPRESS ADMINISTRATION                                                  *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */
require_once 'admin/admin.php';
require_once 'admin/dashboard-widgets.php';
require_once 'navigation.php';

/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   MULTI-LANGUAGE SUPPORT                                                    *
 *                                                                             *
 * - add support for other languages                                           *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */
// require_once( 'translation/translation.php' );



/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   CUSTOMIZER                                                                *
 *                                                                             *
 * - Provide an improved user experience for your client                       *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */
// require_once( 'classes/class-temperance-customizer.php' );



/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                                                             *
 *   GENERAL
 *                                                                             *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */
add_action( 'after_setup_theme', 'temperance_theme_support', 16 );
add_action( 'init', 'temperance_head_cleanup' );
add_action( 'wp_enqueue_scripts', 'temperance_scripts_and_styles', 999 );
add_action( 'widgets_init', 'temperance_register_sidebars' );


// Improve browser title for the sites without theme_support
add_filter( 'wp_title', 'temperance_wp_title', 11, 3 );

// cleaning up random code around images
add_filter( 'the_content', 'temperance_filter_ptags_on_images' );

// Improves the excerpt more link
add_filter( 'excerpt_more', 'temperance_excerpt_more' );




