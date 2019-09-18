<?php
/**
 * Comment related functions
 *
 * This file is part of the Temperance starter theme by Andrew Woods
 *
 * @license GPLv2
 * @author Andrew Woods <andrew@andrewwoods.net>
 * @package Plugin\Navigation
 *
 */

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
			 * back, just replace it with the regular WordPress gravatar call:
			 *
			 * echo get_avatar($comment,$size='32',$default='<path_to_url>' );
			 */
			$bgauthemail = get_comment_author_email();
			$nothing_img = get_template_directory_uri() . '/library/images/nothing.gif';
			$avatar_data = 'http://www.gravatar.com/avatar/'
			               . md5( $bgauthemail ) . '?s=32';
			?>
			<img data-gravatar="<?php echo $avatar_data; ?>"
			     class="load-gravatar avatar avatar-48 photo"
			     height="32"
			     width="32"
			     src="<?php echo $nothing_img ?>" />
			<?php // end custom gravatar call ?>
			<?php
			$date_format = get_option( 'date_format' );
			printf(
				__( '<cite class="fn">%s</cite>', 'temperancetheme' ),
				get_comment_author_link()
			); ?>
			<time datetime="<?php echo comment_time('Y-m-d'); ?>">
				<a href="<?php echo htmlspecialchars(
					get_comment_link( $comment->comment_ID )
				) ?>"><?php comment_time(__( $date_format, 'temperancetheme' )); ?> </a></time>
			<?php edit_comment_link(__( '(Edit)', 'temperancetheme' ),'  ','') ?>
		</header>
		<?php if ($comment->comment_approved == '0') : ?>
			<div class="alert alert-info">
				<p><?php
					_e( 'Your comment is awaiting moderation.', 'temperancetheme' )
					?></p>
			</div>
		<?php endif; ?>
		<section class="comment_content clearfix">
			<?php comment_text() ?>
		</section>
		<?php comment_reply_link(
			array_merge( $args,
				array(
					'depth' => $depth,
					'max_depth' => $args['max_depth']
				)
			)
		); ?>
	</article>
	<?php // </li> is added by WordPress automatically ?>
	<?php
}

