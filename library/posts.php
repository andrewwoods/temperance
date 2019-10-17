<?php
/**
 * Post related functions
 *
 * This file is part of the Temperance starter theme by Andrew Woods
 *
 * @license GPLv2
 * @author Andrew Woods <andrew@andrewwoods.net>
 * @package Plugin\Navigation
 */

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


/**
 * Related Posts Function (call using temperance_related_posts(); )
 *
 * @since 1.0.0
 *
 * @global WP_Post $post the current post from the loop
 *
 * @return void
 */
function temperance_related_posts() {
	global $post;

	$tags = wp_get_post_tags( $post->ID );
	if ( is_wp_error( $tags ) ) {
	    echo '<p class="alert alert-error">A WP_Error occurred</p>';
        return;
	}

	if ( empty( $tags ) ) {
		echo '<p class="alert alert-help">No tags available</p>';
		return;
    }

    $tag_arr = '';
    foreach( $tags as $tag ) {
        if ($tag_arr){
            $tag_arr .= ',';
        }
        $tag_arr .= $tag->slug;
    }

    $args = array(
        'tag' => $tag_arr,
        'numberposts' => 5, /* you can change this to show more */
        'post__not_in' => array( $post->ID )
    );

    $related_posts = get_posts( $args );
    if ( $related_posts ) {
        echo '<h2>' . __( 'Related Posts', 'temperancetheme' ) . '</h2>';
	    echo '<ul id="temperance-related-posts">';
        foreach ( $related_posts as $post ) {
            setup_postdata( $post );
            ?>
            <li class="related_post"><a class="entry-related" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
            <?php
        }
	    echo '</ul>';
    } else {
        echo '<p class="no_related_posts">' . __( 'No Related Posts Yet!', 'temperancetheme' ) . '</p>';
    }

	wp_reset_query();
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
 * @return string the filtered content
 */
function temperance_filter_p_tags_on_images( $content ){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

