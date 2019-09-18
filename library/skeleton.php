<?php
/**
 * Skeleton related functions
 *
 * This file is part of the Temperance starter theme by Andrew Woods.
 * In this context, skeleton refers to the basic page parts parts of the page
 *
 * @license GPLv2
 * @author Andrew Woods <andrew@andrewwoods.net>
 * @package Plugin\Navigation
 */



/**
 * Adding Theme Support
 *
 * There are many options for theme support available. Thumbnails, feed links,
 * post formats, and color options are just a few options available. To add header
 * image support visit the header background image link in this comment
 *
 * @since 1.0.0
 *
 * @uses add_theme_support()
 * @link http://themble.com/support/adding-header-background-image-support/
 *
 * @return void
 */
function temperance_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// You don't need to add call to wp_title in your header.php
	add_theme_support( "title-tag" );

	// html5 feature support
    add_theme_support( 'html5', array( 'search-form' ) );

	// default thumb size
	set_post_thumbnail_size( 125, 125, true );

	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
		array(
		'default-image' => '',  // background image default
		'default-color' => '', // background color default (dont add the #)
		'wp-head-callback' => '_custom_background_cb',
		'admin-head-callback' => '',
		'admin-preview-callback' => ''
		)
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	// registering menu locations
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'temperancetheme' ),
			'footer-links' => __( 'Footer Links', 'temperancetheme' )
		)
	);
}



/**
 * Enable Modernizr, jQuery, and the Main Stylesheet
 *
 * @since 1.0.0
 *
 * @param String $one a necessary parameter
 * @param String optional $two an optional value
 * @return void
 */
function temperance_scripts_and_styles() {

	if ( ! is_admin() ) {
		global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

		// Modernizr - https://modernizr.com/ - Create and Download your own build of Modernizr
		// wp_register_script( 'temperance-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );
		wp_register_script( 'temperance-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );

		// register main stylesheet
		wp_register_style( 'temperance-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );
		wp_register_style( 'temperance-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );


		/*
			I recommend NOT CHANGING the version of jQuery that comes with WordPress.
			It has been well tested by the WordPress core team.
		*/
		wp_enqueue_script( 'jquery' );
		// wp_enqueue_script( 'temperance-modernizr' );
		wp_enqueue_script( 'temperance-js' );
		wp_enqueue_style( 'temperance-stylesheet' );
		wp_enqueue_style( 'temperance-ie-only' );

		$wp_styles->add_data( 'temperance-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

		// comment reply script for threaded comments
		if ( is_singular() AND comments_open() AND ( get_option('thread_comments') == 1 ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}


/**
 * Remove unwanted items
 *
 * Clean up the output of wp_head() by removing undesired functions
 *
 * @since 1.0.0
 * @uses {remove_action()}
 *
 * @return void
 */
function temperance_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );

	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );

	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );

	// Windows Live Writer
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Index link
	remove_action( 'wp_head', 'index_rel_link' );

	// Previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

	// Start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

	// Links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'rss_head', 'wp_generator' );
	remove_action( 'rss2_head', 'wp_generator' );

	// Remove WP version from css
	add_filter( 'style_loader_src', 'temperance_remove_wp_ver_css_js', 9999 );

	// Remove Wp version from scripts
	add_filter( 'script_loader_src', 'temperance_remove_wp_ver_css_js', 9999 );
}



/**
 * Remove WP version from script
 *
 * @since 1.0.0
 *
 * @param String $src
 * @return void
 */
function temperance_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) ){
		$src = remove_query_arg( 'ver', $src );
	}

	return $src;
}


/**
 * Improve on the default wordpress title
 *
 * The default wordpress title isn't sufficient. On the homepage, it add the
 * site description to the site name. On other pages, it add the site name to the
 * standard page title
 *
 * @since 1.0.0
 * @uses wp_title filter
 *
 * @param string $title the title of the page
 * @param string $sep a separator. one or more characters to divide the page title
 * @param string $seplocation can be 'left' or 'right'. default: left.
 * @return string
 */
function temperance_wp_title( $title, $sep, $seplocation ) {

	// The Site Title under "Settings > General"
	$site_name = get_bloginfo( 'name' );

	// The Tagline under "Settings > General"
	$site_description = get_bloginfo( 'description', 'display' );

	// Add the blog description for the home/front page, if available.
	if ( is_home() || is_front_page() ) {
		if ( $site_description ) {
			$title = "$site_name $sep $site_description";
		} else {
			$title = $site_name;
		}
		return $title;
	}

	if ( $seplocation == 'right' ) {
		$title = $title . $site_name;
	} else {
		$title = $site_name . $title;
	}

	return $title;
}

