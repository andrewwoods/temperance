
<article id="post-<?php the_ID(); ?>" <?php post_class( 'h-entry' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

	<h1 class="p-name" itemprop="headline"><?php the_title(); ?></h1>

	<section class="entry-content e-content" itemprop="articleBody">
		<?php the_content(); ?>
	</section>

</article>
