<?php get_header(); ?>

<main id="main" class="main" role="main">
	<div id="main-content" class="main-content">

	<article id="post-not-found" class="hentry">

		<header class="article-header">
			<h1><?php _e( 'Epic 404 - Article Not Found', 'text-domain' ); ?></h1>
		</header>

		<section class="entry-content">
			<p><?php _e( 'The content you were looking for was not found, but maybe try looking again!', 'text-domain' ); ?></p>
		</section>

		<section class="search">
			<p><?php get_search_form(); ?></p>
		</section>

		<footer class="article-footer">
			<p><?php _e( 'This is the 404.php template.', 'text-domain' ); ?></p>
		</footer>

	</article>

	</div>
</main>

<?php get_footer(); ?>
