<?php
/*

This is the core Temperance file where most of the main functions & features 
reside. If you have any custom functions, it's best to put them in the 
functions.php file.

- head cleanup (remove rsd, uri links, junk css, etc)
- enqueueing scripts & styles
- theme support functions
- custom menu output & fallbacks
- related post function
- page-navi function
- removing <p> from around images
- customizing the post excerpt
- custom google+ integration
- adding custom fields to user profiles

*/


/*
	LAUNCH TEMPERANCE

Let's fire off all the functions and tools. 
I put it up here so it's right up top and clean.

*/

// we're firing all out initial functions at the start
 add_action( 'after_setup_theme', 'temperance_ahoy', 16 );

function temperance_ahoy() {

	// launching operation cleanup
	add_action( 'init', 'temperance_head_cleanup' );

	// remove WP version from RSS
	add_filter( 'the_generator', __return_null );

	// remove pesky injected css for recent comments widget
	add_filter( 'wp_head', 'temperance_remove_wp_widget_recent_comments_style', 1 );

	// clean up comment styles in the head
	add_action( 'wp_head', 'temperance_remove_recent_comments_style', 1 );

	// clean up gallery output in wp
	add_filter( 'gallery_style', 'temperance_gallery_style' );

	// enqueue base scripts and styles
	add_action( 'wp_enqueue_scripts', 'temperance_scripts_and_styles', 999 );

	// launching this stuff after theme setup
	temperance_theme_support();

	// adding sidebars to Wordpress (these are created in functions.php)
	add_action( 'widgets_init', 'temperance_register_sidebars' );

	// adding the temperance search form (created in functions.php)
	add_filter( 'get_search_form', 'temperance_wpsearch' );

	// cleaning up random code around images
	add_filter( 'the_content', 'temperance_filter_ptags_on_images' );

	// Improves the excerpt more link
	add_filter( 'excerpt_more', 'temperance_excerpt_more' );

}

/*
	WP_HEAD GOODNESS

	The default wordpress head is a mess. Let's clean it up by
	removing all the junk we don't need.
*/

/*
* @param string $title the title of the page
* @param string $sep a separator. one of more characters to distinguish the page title
* @param string $seplocation can be 'left' or 'right'. default: left. 
*
* @see wp_title filter
*/
function temperance_wp_title( $title, $sep, $seplocation ) {

	// Add the blog name
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
add_filter( 'wp_title', 'temperance_wp_title', 11, 3 );

function temperance_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );

	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );

	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );

	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// index link
	remove_action( 'wp_head', 'index_rel_link' );

	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	// WP version
	remove_action( 'wp_head', 'wp_generator' );

	// remove WP version from css
	add_filter( 'style_loader_src', 'temperance_remove_wp_ver_css_js', 9999 );

	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'temperance_remove_wp_ver_css_js', 9999 );

}



// remove WP version from scripts
function temperance_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function temperance_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function temperance_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// remove injected CSS from gallery
function temperance_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function temperance_scripts_and_styles() {
	global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
	if (!is_admin()) {

		// modernizr (without media query polyfill)
		wp_register_script( 'temperance-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );

		// register main stylesheet
		wp_register_style( 'temperance-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );

		// ie-only style sheet
		wp_register_style( 'temperance-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );

		// comment reply script for threaded comments
		if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			wp_enqueue_script( 'comment-reply' );
		}

		//adding scripts file in the footer
		wp_register_script( 'temperance-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );

		// enqueue styles and scripts
		wp_enqueue_script( 'temperance-modernizr' );
		wp_enqueue_style( 'temperance-stylesheet' );
		wp_enqueue_style( 'temperance-ie-only' );

		$wp_styles->add_data( 'temperance-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

		/*
		I recommend using a plugin to call jQuery
		using the google cdn. That way it stays cached
		and your site will load faster.
		*/
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'temperance-js' );

	}
}

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function temperance_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

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

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

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

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'temperancetheme' ),   // main nav in header
			'footer-links' => __( 'Footer Links', 'temperancetheme' ) // secondary nav in footer
		)
	);
}


/*********************
MENUS & NAVIGATION
*********************/

// the main menu
function temperance_main_nav() {
	// display the wp3 menu if available
	wp_nav_menu(array(
		'container' => false,                           // remove nav container
		'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
		'menu' => __( 'The Main Menu', 'temperancetheme' ),  // nav name
		'menu_class' => 'nav top-nav clearfix',         // adding custom nav class
		'theme_location' => 'main-nav',                 // where it's located in the theme
		'before' => '',                                 // before the menu
		'after' => '',                                  // after the menu
		'link_before' => '',                            // before each link
		'link_after' => '',                             // after each link
		'depth' => 0,                                   // limit the depth of the nav
		'fallback_cb' => 'temperance_main_nav_fallback'      // fallback function
	));
} /* end temperance main nav */

// the footer menu (should you choose to use one)
function temperance_footer_links() {
	// display the wp3 menu if available
	wp_nav_menu(array(
		'container' => '',                              // remove nav container
		'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
		'menu' => __( 'Footer Links', 'temperancetheme' ),   // nav name
		'menu_class' => 'nav footer-nav clearfix',      // adding custom nav class
		'theme_location' => 'footer-links',             // where it's located in the theme
		'before' => '',                                 // before the menu
		'after' => '',                                  // after the menu
		'link_before' => '',                            // before each link
		'link_after' => '',                             // after each link
		'depth' => 0,                                   // limit the depth of the nav
		'fallback_cb' => 'temperance_footer_links_fallback'  // fallback function
	));
} /* end temperance footer link */

// this is the fallback for header menu
function temperance_main_nav_fallback() {
	wp_page_menu( array(
		'show_home' => true,
		'menu_class' => 'nav top-nav clearfix',      // adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
		'link_before' => '',                            // before each link
		'link_after' => ''                             // after each link
	) );
}

// this is the fallback for footer menu
function temperance_footer_links_fallback() {
	/* you can put a default here if you like */
}

/*********************
RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using temperance_related_posts(); )
function temperance_related_posts() {
	echo '<ul id="temperance-related-posts">';
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if($tags) {
		foreach( $tags as $tag ) {
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts( $args );
		if($related_posts) {
			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
				<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; }
		else { ?>
			<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'temperancetheme' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_query();
	echo '</ul>';
} /* end temperance related posts function */

/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function temperance_page_navi() {
	global $wp_query;
	$bignum = 999999999;
	if ( $wp_query->max_num_pages <= 1 )
		return;
	
	echo '<nav class="pagination">';
	
	echo paginate_links( array(
		'base' 			=> str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
		'format' 		=> '',
		'current' 		=> max( 1, get_query_var('paged') ),
		'total' 		=> $wp_query->max_num_pages,
		'prev_text' 	=> '&larr;',
		'next_text' 	=> '&rarr;',
		'type'			=> 'list',
		'end_size'		=> 3,
		'mid_size'		=> 3
	) );

	echo '</nav>';
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function temperance_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

/**
* Changes the text of the 'Read More' link
*
* Makes the link text more useful to search engines and screen readers.
*
* @param string $more
* @return string
*/
function temperance_excerpt_more($more) {
	global $post;

	$url = get_permalink($post->ID);
	$title = get_the_title($post->ID) ;
	$span = ' <span class="visually-hidden">' . $title . '</span> ';
	$a_text = _x( 'Read more &raquo;', ' use &laquo; for RTL languages like arabic ', 'temperancetheme' );
	if ( is_rtl() ){
		$more = ' <a class="excerpt-read-more" href="'. $url . '" title="'. $title .'">'. $span . $a_text  .'</a> ... ';
	} else {
		$more = ' ... <a class="excerpt-read-more" href="'. $url . '" title="'. $title .'">'. $a_text . $span  .'</a> ';
	}

	return $more;
}

/*
 * This is a modified the_author_posts_link() which just returns the link.
 *
 * This is necessary to allow usage of the usual l10n process with printf().
 */
function temperance_get_the_author_posts_link() {
	global $authordata;

	if ( !is_object( $authordata ) ) {
		return false;
	}

	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}

