<?php get_header(); ?>

<div id="content">
<div id="inner-content" class="wrap clearfix">
<main id="main" class="main" role="main">
	<h1 class="archive-title">
		<span><?php _e( 'Search Results for:', 'temperancetheme' ); ?></span>
		<?php echo esc_attr( get_search_query() ); ?>
	</h1>

	<?php
	get_search_form();

	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'content/excerpt' );
		endwhile;
		?>

		<?php temperance_pagination_links(); ?>

	<?php else : ?>
	<?php
	$no_results = __( 'Sorry, No Results.', 'temperancetheme' );
	$try_again  = __( 'Try your search again.', 'temperancetheme' );
	$error      = __( 'This is the error message in search.php', 'temperancetheme' );
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

</main>
<?php get_sidebar(); ?>
</div>
</div>

<?php get_footer(); ?>
