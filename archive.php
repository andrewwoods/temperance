<?php get_header(); ?>

<main id="main" class="main" role="main">
	<div id="main-content" class="main-content">

		<h1 class="archive-title">
		<?php if ( is_category() ) : ?>
			<span><?php _e( 'Posts Categorized:', 'temperancetheme' ); ?></span>
			<?php single_cat_title(); ?>

		<?php elseif ( is_tag() ) : ?>
				<span><?php _e( 'Posts Tagged:', 'temperancetheme' ); ?></span>
				<?php single_tag_title(); ?>

		<?php elseif ( is_author() ) : ?>
			<?php
			global $post;
			$author_id = $post->post_author;
			?>
				<span><?php _e( 'Posts By:', 'temperancetheme' ); ?></span>
				<?php the_author_meta( 'display_name', $author_id ); ?>
		<?php elseif ( is_day() ) : ?>
				<span><?php _e( 'Daily Archives:', 'temperancetheme' ); ?></span>
				<?php the_time( 'Y M d - l' ); ?>

		<?php elseif ( is_month() ) : ?>
				<span><?php _e( 'Monthly Archives:', 'temperancetheme' ); ?></span>
				<?php the_time( 'Y M' ); ?>

		<?php elseif ( is_year() ) : ?>
			<span><?php _e( 'Yearly Archives:', 'temperancetheme' ); ?></span>
            <?php the_time('Y'); ?>
		<?php endif; ?>
		</h1>

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

				<header class="article-header">

					<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					<p class="byline vcard"><?php
						printf(
							__( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'temperancetheme' ),
                            get_the_time('c'),
                            get_the_time( get_option( 'date_format' ) ),
                            temperance_get_the_author_posts_link(),
                            get_the_category_list(', ')
                        );
					?></p>

				</header>

				<section class="entry-content clearfix">
					<?php the_post_thumbnail( 'temperance-thumb-300' ); ?>
					<?php the_excerpt(); ?>
				</section>

			</article>

			<?php endwhile; ?>

			<?php temperance_pagination_links(); ?>

		<?php else : ?>
            <?php get_template_part( 'content/empty' ); ?>
		<?php endif; ?>


</div>
</main>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
