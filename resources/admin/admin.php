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


/**
 * disable default dashboard widgets
 *
 *
 * @since 1.0
 *
 * @return void
 */
function temperance_disable_default_dashboard_widgets() {

	// The "At A Glance" Widget
	// remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );

	// The "Activity" section.
	// remove_meta_box( 'dashboard_activity', 'dashboard', 'core' );

	// Comments Widget
	// remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' );

	// Quick Press Widget
	// remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' );

}

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
 * Custom Backend Footer
 */
function temperance_custom_admin_footer() {
	_e( '<span id="footer-thankyou">Developed by <a href="http://yoursite.com" target="_blank">Your Site Name</a></span>.', 'temperancetheme' );
}

/**
 * add all custom dashboard widgets
 *
 * @return void
 */
function temperance_custom_dashboard_widgets() {
	wp_add_dashboard_widget(
		'temperance_wordpress_rss',
		__( 'WordPress.com RSS', 'temperancetheme' ),
		'temperance_wordpress_rss_dashboard_widget'
	);

	wp_add_dashboard_widget(
		'temperance_planet_php_rss',
		__( 'Planet PHP RSS', 'temperancetheme' ),
		'temperance_planet_php_rss_dashboard_widget'
	);

	/*
	 * Be sure to drop any other created Dashboard Widgets
	 * in this function and they will all load.
	 */
}

/**
 * @param $url
 *
 * @return array|null
 */
function temperance_fetch_feed( $url ){
	$limit = 7;
	$items = array();

	if ( function_exists( 'fetch_feed' ) ) {
		// specify the source feed
		$feed = fetch_feed( $url );

		// specify number of items
		$limit = $feed->get_item_quantity( $limit );

		// create an array of items
		$items = $feed->get_items( 0, $limit );
	}

	return $items;
}

/**
 * @param $items
 */
function temperance_display_feed_items( $items ){

	if ( empty( $items ) ) {
		echo 'There are no items available';
		return;
	}

	foreach ( $items as $item ) {
		$content = strip_tags( $item->get_description() );
		?>
        <div>
            <strong><a href="<?php echo $item->get_permalink(); ?>" title="<?php echo mysql2date( __( 'j F Y @ g:i a', 'temperancetheme' ), $item->get_date( 'Y-m-d H:i:s' ) ); ?>" target="_blank">
					<?php echo $item->get_title(); ?>
                </a></strong>
            <p>
				<?php echo substr( $content, 0, 200 ); ?>
            </p>
        </div>
		<?php
	}
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
function temperance_wordpress_rss_dashboard_widget() {

	$items = temperance_fetch_feed( 'http://wordpress.com/feed/rss/' );

	temperance_display_feed_items( $items );
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
function temperance_planet_php_rss_dashboard_widget() {

	$items = temperance_fetch_feed( 'http://www.planet-php.org/rss/' );

	temperance_display_feed_items( $items );
}


