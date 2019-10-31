<?php
/**
 * Media related functions
 *
 * This file is part of the Temperance starter theme by Andrew Woods
 *
 * @license GPLv2
 * @author Andrew Woods <andrew@andrewwoods.net>
 * @package Plugin\Navigation
 *
 */



/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                  THUMBNAIL SIZE OPTIONS                 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */
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


/**
 * Add custom image sizes
 *
 * The function above adds the ability to use the dropdown menu to select
 * the new images sizes you have just created from within the media manager
 * when you add media to your content blocks. If you add more image sizes,
 * duplicate one of the lines in the array and name it according to your
 * new image size.
 *
 * @since 1.0
 *
 * @param  array $sizes
 * @return array
 */
function temperance_custom_image_sizes( $sizes ) {
	return array_merge( $sizes, [
		'temperance-thumb-600' => __( '600px by 150px' ),
		'temperance-thumb-300' => __( '300px by 100px' ),
	] );
}

