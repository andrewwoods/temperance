<?php get_header(); ?>

<div id="content">
<div id="inner-content" class="wrap clearfix">
<div id="main" class="eightcol first clearfix" role="main">

<?php
if (have_posts()) :
	while (have_posts()) :
		the_post();
		get_template_part( 'content/page', 'content' );
	endwhile;
else :
	// There are example messages.
	// Pick the one you want to use
	$not_found = 'Oops, Post Not Found!';
	$missing = 'Uh Oh. Something is missing. Try double checking things.';
	$error_message = 'This is the error message in the page.php template.';
?>
	<article id="post-not-found" class="hentry clearfix">
		<header class="article-header">
			<h1><?php _e( $not_found, 'temperancetheme' ); ?></h1>
		</header>

		<section class="entry-content">
			<p><?php _e( $missing, 'temperancetheme' ); ?></p>
		</section>

		<footer class="article-footer">
			<p><?php _e( $error_message, 'temperancetheme' ); ?></p>
		</footer>

	</article>
<?php
endif;
?>

</div>
<?php get_sidebar(); ?>
</div>
</div>

<?php get_footer(); ?>
