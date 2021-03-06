
<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

	<header class="article-header">
		<h1 class="entry-title single-title" itemprop="headline"><?php
			the_title();
		?></h1>
		<p class="byline vcard"><?php
			printf(
                __(
                    'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time>' .
                    ' by <span class="author">%3$s</span> <span class="amp">&amp;</span>' .
                    ' filed under %4$s.',
                    'text-domain'
                ),
                get_the_time( 'c' ),
                get_the_time( get_option( 'date_format' ) ),
                temperance_get_the_author_posts_link(),
                get_the_category_list( ', ' )
            );
		?></p>
	</header>

	<section class="entry-content clearfix" itemprop="articleBody">
		<?php the_content(); ?>
	</section>

	<footer class="article-footer">
		<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'text-domain' ) . '</span> ', ', ', '</p>' ); ?>
	</footer>

	<?php comments_template(); ?>

</article>

