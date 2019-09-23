<?php
/**
 * Admin related functions for login
 *
 * This file is part of the Temperance starter theme by Andrew Woods
 *
 * @license GPLv2
 * @author Andrew Woods <andrew@andrewwoods.net>
 * @package Plugin\Navigation
 */

/**
 * enqueue your custom login page css
 *
 * @since 1.0
 * @see http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
 *
 * @return void
 */
function temperance_login_css() {
	wp_enqueue_style( 'temperance_login_css', get_template_directory_uri() . '/library/css/login.css', false );
}


/**
 * changing the logo link from wordpress.org to your site
 *
 * @since 1.0
 * @see http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
 *
 * @return void
 */
function temperance_login_url() {
	return home_url();
}


/**
 * changing the alt text on the logo to show your site name
 *
 * @since 1.0
 * @see http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
 *
 * @return void
 */
function temperance_login_title() {
	return get_option( 'blogname' );
}

