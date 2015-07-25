
<article id="post-<?php the_ID(); ?>" <?php post_class('h-entry'); ?> role="article">

	<header class="article-header">
		<h3 class="search-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
		<p class="byline vcard">
		<?php
			$time_tag = '<time class="dt-published" datetime="%1$s" pubdate>%2$s</time>';

			printf( __( "Posted $time_tag", 'temperancetheme' ),
				get_the_time( 'c' ),
				get_the_time( get_option( 'date_format' ) )
			);
			printf( __( '<span class="author p-author">%1$s</span>
				<span class="amp">&</span> filed under %2$s.', 'temperancetheme' ),
				temperance_get_the_author_posts_link(),
				get_the_category_list(', ')
			);
		?>
		</p>
	</header>

	<section class="entry-summary p-summary">
		<?php the_excerpt(); ?>
	</section>

</article>
