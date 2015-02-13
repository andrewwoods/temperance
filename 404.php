<?php get_header(); ?>

<div id="content">
	<div id="inner-content" class="wrap clearfix">
		<div id="main" class="eightcol first clearfix" role="main">

			<article id="post-not-found" class="hentry clearfix">

				<header class="article-header">
					<h1><?php _e( 'Epic 404 - Article Not Found', 'temperancetheme' ); ?></h1>
				</header>

				<section class="entry-content">
					<p><?php _e( 'The content you were looking for was not found, but maybe try looking again!', 'temperancetheme' ); ?></p>
				</section>

				<section class="search">
					<p><?php get_search_form(); ?></p>
				</section>

				<footer class="article-footer">
					<p><?php _e( 'This is the 404.php template.', 'temperancetheme' ); ?></p>
				</footer>

			</article>

		</div>
	</div>
</div>

<?php get_footer(); ?>
