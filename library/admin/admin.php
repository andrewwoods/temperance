<?php
/**
 * This file handles the admin area and functions.
 *
 * You can use this file to* make changes to the dashboard.
 * Updates to this page are coming soon. It's turned off by default,
 * but you can call it via the functions file.
 *
 * @package Temperance
 * @subpackage Admin
 */

/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                        ACTIONS                          *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */
add_action( 'login_enqueue_scripts', 'temperance_login_css', 10 );

/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                        FILTERS                          *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */
add_filter( 'login_headerurl', 'temperance_login_url' );
add_filter( 'login_headertitle', 'temperance_login_title' );
add_filter( 'admin_footer_text', 'temperance_custom_admin_footer' );



 */




 */


/**
 * Custom Backend Footer
 */
function temperance_custom_admin_footer() {
	_e( '<span id="footer-thankyou">Developed by <a href="http://yoursite.com" target="_blank">Your Site Name</a></span>.', 'temperancetheme' );
}

