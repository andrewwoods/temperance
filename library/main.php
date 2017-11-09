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
 * Adding Theme Support
 *
 * There are many options for theme support availale. Thumbnails, feed links,
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
 * Related Posts Function (call using temperance_related_posts(); )
 *
 * @since 1.0.0
 *
 * @global WP_Post $post it does something
 *
 * @return void
 */
function temperance_related_posts() {
	global $post;

	echo '<ul id="temperance-related-posts">';

	$tags = wp_get_post_tags( $post->ID );
	if( $tags ) {
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
			<?php endforeach;
		}
		else { ?>
			<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'temperancetheme' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_query();

	echo '</ul>';
}




/**
 * Remove the 'p' tag from around images
 *
 * Content filter - examines the content for images wrapped in paragraph "p"
 * tags and removes the p tags.
 *
 * @since 1.0.0
 * @see http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
 *
 * @param  string $content
 * @return type it does something
 */
function temperance_filter_ptags_on_images( $content ){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}



/**
 * Changes the text of the 'Read More' link to include title of content
 *
 * Makes the link text more useful to search engines and screen readers.
 *
 * @global WP_Post $post
 * @since 1.0.0
 *
 * @param string $more
 * @return string
 */
function temperance_excerpt_more( $more ) {
	global $post;

	$url = get_permalink( $post->ID );
	$title = get_the_title( $post->ID );
	$span = ' <span class="visually-hidden">' . $title . '</span> ';
	$a_text = _x( 'Read more &raquo;', ' use &laquo; for RTL languages like arabic ', 'temperancetheme' );
	if ( is_rtl() ){
		$more = ' <a class="excerpt-read-more" href="'. $url . '" title="'. $title .'">'. $span . $a_text  .'</a> ... ';
	} else {
		$more = ' ... <a class="excerpt-read-more" href="'. $url . '" title="'. $title .'">'. $a_text . $span  .'</a> ';
	}

	return $more;
}



/**
 * This is a modified the_author_posts_link() which just returns the link.
 *
 * This is necessary to allow usage of the usual l10n process with printf().
 *
 * @global object $authordata
 * @since 1.0.0
 *
 * @return string $link a formatted html anchor
 */
function temperance_get_the_author_posts_link() {
	global $authordata;

	if ( ! is_object( $authordata ) ) {
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

