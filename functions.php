<?php
/**
 * This is your main theme file for functionality.
 * It's read automatically by WordPress. Because of this,
 * It's used to pull in code from other files.
 *
 * It's also the place to attach your functions and/or classes to the hooks you
 * want to use. By default, things are enabled to make it easy for you to
 * customize. If you don't like/want something, you can comment out the hook.
 * Before your deploy or publish your code, you might want to delete the
 * functions you are using. That way you know what code you are actually
 * supporting. This keeps your code clean.
 *
 * @package Temperance
 */

/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                       CONSTANTS                         *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */
define( 'TEMPERANCE_DIR_PATH', get_stylesheet_directory() );
define( 'TEMPERANCE_DIR_URL', get_stylesheet_directory_uri() );
define( 'TEMPERANCE_SRC_PATH', TEMPERANCE_DIR_PATH . '/src' );
define( 'TEMPERANCE_LIB_PATH', TEMPERANCE_DIR_PATH . '/resources' );
define( 'TEMPERANCE_LIB_ADMIN_PATH', TEMPERANCE_LIB_PATH . '/admin' );

/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                     INCLUDE FILES                       *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */
require_once TEMPERANCE_LIB_PATH . '/comments.php';
require_once TEMPERANCE_LIB_PATH . '/media.php';
require_once TEMPERANCE_LIB_PATH . '/navigation.php';
require_once TEMPERANCE_LIB_PATH . '/posts.php';
require_once TEMPERANCE_LIB_PATH . '/shortcodes.php';
require_once TEMPERANCE_LIB_PATH . '/sidebars.php';
require_once TEMPERANCE_LIB_PATH . '/skeleton.php';

/*
 * Admin related code
 */
require_once TEMPERANCE_LIB_ADMIN_PATH . '/admin.php';

/*
 * Classes for OOP code
 */
require_once TEMPERANCE_SRC_PATH . '/class-temperance-customizer.php';



/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                        ACTIONS                          *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

add_action( 'after_setup_theme', 'temperance_load_translations' );
add_action( 'after_setup_theme', 'temperance_theme_support', 16 );

add_action( 'init', 'temperance_head_cleanup' );

add_action( 'wp_enqueue_scripts', 'temperance_scripts_and_styles', 999 );

add_action( 'widgets_init', 'temperance_register_sidebars' );

/*
 * * * * * * * * * * * * * * *
 *       ADMIN ACTIONS       *
 * * * * * * * * * * * * * * *
 */

add_action( 'login_enqueue_scripts', 'temperance_login_css', 10 );

add_action( 'wp_dashboard_setup', 'temperance_disable_default_dashboard_widgets' );
add_action( 'wp_dashboard_setup', 'temperance_custom_dashboard_widgets' );


// Flush rewrite rules for custom post types.
add_action( 'after_switch_theme', 'temperance_flush_rewrite_rules', 99 );

/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                        FILTERS                          *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

add_filter( 'image_size_names_choose', 'temperance_custom_image_sizes' );

add_filter( 'wp_title', 'temperance_wp_title', 11, 3 );

add_filter( 'the_content', 'temperance_filter_p_tags_on_images' );

add_filter( 'excerpt_more', 'temperance_excerpt_more' );

/*
 * * * * * * * * * * * * * * *
 *       ADMIN FILTERS       *
 * * * * * * * * * * * * * * *
 */

add_filter( 'login_headerurl', 'temperance_login_url' );
add_filter( 'login_headertitle', 'temperance_login_title' );

add_filter( 'admin_footer_text', 'temperance_custom_admin_footer' );

/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                        SHORTCODES                       *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

add_shortcode( 'temperance-pull-quote', 'temperance_pull_quote_shortcode' );

