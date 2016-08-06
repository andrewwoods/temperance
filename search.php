<?php get_header(); ?>

<div id="content">
<div id="inner-content" class="wrap clearfix">
<div id="main" class="eightcol first clearfix" role="main">
	<h1 class="archive-title">
		<span><?php _e( 'Search Results for:', 'temperancetheme' ); ?></span>
		<?php echo esc_attr(get_search_query()); ?>
	</h1>

	<?php
	if (have_posts()) :
		while (have_posts()) :
			the_post();
			get_template_part( 'excerpt' );
		endwhile; ?>

		<?php if (function_exists('temperance_page_navi')) : ?>
			<?php temperance_page_navi(); ?>
		<?php else : ?>
			<nav class="wp-prev-next">
				<ul class="clearfix">
				<li class="prev-link"><?php
					next_posts_link(
						__( '&laquo; Older Entries', 'temperancetheme' )
					)
				?></li>
				<li class="next-link"><?php
					previous_posts_link(
						__( 'Newer Entries &raquo;', 'temperancetheme' )
					)
				?></li>
				</ul>
			</nav>
		<?php endif; ?>

	<?php else : ?>
	<?php
	$no_results = __( 'Sorry, No Results.', 'temperancetheme' );
	$try_again  = _e( 'Try your search again.', 'temperancetheme' );
	$error      = _e( 'This is the error message in search.php', 'temperancetheme' );
	?>
		<article id="post-not-found" class="hentry clearfix">
			<header class="article-header">
				<h1><?php echo $no_results; ?></h1>
			</header>
			<section class="entry-content">
				<p><?php echo $try_again;  ?></p>
			</section>
			<footer class="article-footer">
				<p><?php echo $error; ?></p>
			</footer>
		</article>

	<?php endif; ?>

</div>
<?php get_sidebar(); ?>
</div>
</div>

<?php get_footer(); ?>
