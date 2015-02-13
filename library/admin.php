<?php
/**
 * This file handles the admin area and functions.  You can use this file to
 * make changes to the dashboard. Updates to this page are coming soon. It's
 * turned off by default, but you can call it via the functions file.
 *
 * @package Temperance
 * @subpackage Admin
 *
 * @see http://digwp.com/2010/10/customize-wordpress-dashboard/
 *
 */


//~~~~~~~~~~~~ DASHBOARD WIDGETS ~~~~~~~~~~~~~~~~~~

/**
 * disable default dashboard widgets
 *
 *
 * @since 1.0
 *
 * @return void
 */
function disable_default_dashboard_widgets() {

	// Right Now Widget
	// remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );

	// Comments Widget
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' );

	// Incoming Links Widget
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );

	// Plugins Widget
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );

	// Quick Press Widget
	// remove_meta_box('dashboard_quick_press', 'dashboard', 'core' );

	// Recent Drafts Widget
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );

	// Yoast's SEO Plugin Widget
	remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );

}

/**
 * Now let's talk about adding your own custom Dashboard widget. Sometimes you
 * want to show clients feeds relative to their site's content. For example, the
 * NBA.com feed for a sports site. Here is an example Dashboard Widget that
 * displays recent entries from an RSS Feed.
 *
 * @see http://digwp.com/2010/10/customize-wordpress-dashboard/
 *
 * @return void
 */
function temperance_rss_dashboard_widget() {
	if ( function_exists( 'fetch_feed' ) ) {
		// include the required file
		include_once( ABSPATH . WPINC . '/feed.php' );

		// specify the source feed
		$feed = fetch_feed( 'http://wordpress.com/feed/rss/' );

		// specify number of items
		$limit = $feed->get_item_quantity(7);

		// create an array of items
		$items = $feed->get_items(0, $limit);
	}

	if ( 0 == $limit ) {
		// fallback message
		echo '<div>The RSS Feed is either empty or unavailable.</div>';
	} else {
		foreach ( $items as $item ) { ?>
			<h4 style="margin-bottom: 0;">
				<a href="<?php echo $item->get_permalink(); ?>" title="<?php echo mysql2date( __( 'j F Y @ g:i a', 'temperancetheme' ), $item->get_date( 'Y-m-d H:i:s' ) ); ?>" target="_blank">
					<?php echo $item->get_title(); ?>
				</a>
			</h4>
			<p style="margin-top: 0.5em;">
				<?php echo substr($item->get_description(), 0, 200); ?>
			</p>
			<?php
		}
	}
}


/**
 * add all custom dashboard widgets
 *
 * @since version
 *
 * @param  type $name it does something
 * @return type it does something
 */
function temperance_custom_dashboard_widgets() {
	wp_add_dashboard_widget( 'temperance_rss_dashboard_widget', __( 'Recently on Themble (Customize on admin.php)', 'temperancetheme' ), 'temperance_rss_dashboard_widget' );
	/*
	 * Be sure to drop any other created Dashboard Widgets
	 * in this function and they will all load.
	 */
}


// removing the dashboard widgets
add_action( 'admin_menu', 'disable_default_dashboard_widgets' );

// adding any custom widgets
add_action( 'wp_dashboard_setup', 'temperance_custom_dashboard_widgets' );


//~~~~~~~~~~~~ CUSTOM LOGIN PAGE ~~~~~~~~~~~~~~~~~~


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

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'temperance_login_css', 10 );
add_filter( 'login_headerurl', 'temperance_login_url' );
add_filter( 'login_headertitle', 'temperance_login_title' );


//~~~~~~~~~~~~ CUSTOMIZE ADMIN ~~~~~~~~~~~~~~~~~~~~

/*
 * I don't really recommend editing the admin too much as things may get funky
 * if WordPress updates. Here are a few funtions which you can choose to use if
 * you like.
 */

// Custom Backend Footer
function temperance_custom_admin_footer() {
	_e( '<span id="footer-thankyou">Developed by <a href="http://yoursite.com" target="_blank">Your Site Name</a></span>.', 'temperancetheme' );
}

// adding it to the admin area
add_filter( 'admin_footer_text', 'temperance_custom_admin_footer' );

