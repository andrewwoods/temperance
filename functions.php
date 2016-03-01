<?php
/**
 * This is where you can drop your custom functions or just edit things like
 * thumbnail sizes, header images, sidebars, comments, etc.
 *
 * @package Temperance
 */


//~~~~~~~~~~~~ INCLUDE NEEDED FILES ~~~~~~~~~~~~~~~~

// if you remove this, Temperance will break
require_once( 'library/temperance.php' );

// if you remove this, temperance will break
require_once( 'library/classes/class-temperance-customizer.php' );

/*
 * 2. library/custom-post-type.php
 * - an example custom post type
 * - example custom taxonomy (like categories)
 * - example custom taxonomy (like tags)
 *
 * Uncommnet the line below to enable it.
 */
// require_once( 'library/custom-post-type.php' );

/*
 * 3. library/admin.php
 * - removing some default WordPress dashboard widgets
 * - an example custom dashboard widget
 * - adding custom login css
 * - changing text in footer of admin
 *
 * Uncommnet the line below to enable it.
 */
// require_once( 'library/admin.php' );

/*
 * 4. library/translation/translation.php
 * - adding support for other languages
 *
 * Uncommnet the line below to enable it.
 */
// require_once( 'library/translation/translation.php' );


//~~~~~~~~~~~~ THUMBNAIL SIZE OPTIONS ~~~~~~~~~~~~~~

add_image_size( 'temperance-thumb-600', 600, 150, true );
add_image_size( 'temperance-thumb-300', 300, 100, true );

/*
 * to add more sizes, simply copy a line from above and change the dimensions &
 * name. As long as you upload a "featured image" as large as the biggest set
 * width or height, all the other sizes will be auto-cropped.
 *
 * To call a different size, simply change the text inside the thumbnail function.
 *
 * For example, to call the 300 x 300 sized image, we would use the function:
 * <?php the_post_thumbnail( 'temperance-thumb-300' ); ?>
 * for the 600 x 100 image:
 * <?php the_post_thumbnail( 'temperance-thumb-600' ); ?>
 *
 * You can change the names and dimensions to whatever you like. Enjoy!
 */

add_filter( 'image_size_names_choose', 'temperance_custom_image_sizes' );

/**
 * Add custom image sizes
 *
 *
 * @since 1.0
 *
 * @param  array $sizes
 * @return array
 */
function temperance_custom_image_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'temperance-thumb-600' => __('600px by 150px'),
		'temperance-thumb-300' => __('300px by 100px'),
	) );
}

/*
 * The function above adds the ability to use the dropdown menu to select
 * the new images sizes you have just created from within the media manager
 * when you add media to your content blocks. If you add more image sizes,
 * duplicate one of the lines in the array and name it according to your
 * new image size.
 */


//~~~~~~~~~~~~ ACTIVE SIDEBARS ~~~~~~~~~~~~~~~~~~~~~

/**
 * Sidebars & Widgetizes Areas
 *
 * @since 1.0
 *
 * @return void
 */
function temperance_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'temperancetheme' ),
		'description' => __( 'The first (primary) sidebar.', 'temperancetheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
}


//~~~~~~~~~~~~ COMMENT LAYOUT ~~~~~~~~~~~~~~~~~~~~~~

/**
 * Display a single comment
 *
 *
 * @since 1.0
 *
 * @param  string $comment
 * @param  array $args
 * @param  int $depth
 * @return void
 */
function temperance_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
			<?php
			/*
			 * this is the new responsive optimized comment image. It used the
			 * new HTML5 data-attribute to display comment gravatars on larger
			 * screens only. What this means is that on larger posts, mobile
			 * sites don't have a ton of requests for comment images. This
			 * makes load time incredibly fast! If you'd like to change it
			 * back, just replace it with the regular wordpress gravatar call:
			 *
			 * echo get_avatar($comment,$size='32',$default='<path_to_url>' );
			 */
			?>
			<?php
				$bgauthemail = get_comment_author_email();
			?>
			<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
			<?php // end custom gravatar call ?>
			<?php printf(__( '<cite class="fn">%s</cite>', 'temperancetheme' ), get_comment_author_link()) ?>
			<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'temperancetheme' )); ?> </a></time>
			<?php edit_comment_link(__( '(Edit)', 'temperancetheme' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'temperancetheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
}


//~~~~~~~~~~~~ SEARCH FORM LAYOUT ~~~~~~~~~~~~~~~~~~

/**
 * Search Form
 *
 * Edit the HTML of the search form
 *
 * @since 1.0
 *
 * @param  string $form search form HTML
 * @return string
 */
function temperance_wpsearch( $form ) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search for:', 'temperancetheme' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search the Site...', 'temperancetheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( 'Search' ) .'" />
	</form>';
	return $form;
}


