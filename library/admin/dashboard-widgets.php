<?php
/**
 * This file handles the admin area dashboard functions.
 *
 * @package Temperance
 * @subpackage Admin
 *
 * @see http://digwp.com/2010/10/customize-wordpress-dashboard/
 */

add_action( 'wp_dashboard_setup', 'disable_default_dashboard_widgets' );

add_action( 'wp_dashboard_setup', 'temperance_custom_dashboard_widgets' );

/**
 * disable default dashboard widgets
 *
 *
 * @since 1.0
 *
 * @return void
 */
function disable_default_dashboard_widgets() {

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
	$limit = 7;
	$items = array();

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

