<?php get_header(); ?>

<main id="main" class="main" role="main">
	<div id="main-content" class="main-content">
	<?php
	if (have_posts()) :
		while (have_posts()) :
			the_post();
			get_template_part( 'content/page', 'content' );
		endwhile;
	else :
		// There are example messages.
		// Pick the one you want to use
		$not_found = __( 'Oops, Post Not Found!', 'temperancetheme' );
		$missing = __( 'Uh Oh. Something is missing. Try double checking things.', 'temperancetheme' );
		$error_message = __( 'This is the error message in the page.php template.', 'temperancetheme' );
	?>
		<article id="post-not-found" class="hentry clearfix">
			<header class="article-header">
				<h1><?php echo $not_found; ?></h1>
			</header>

			<section class="entry-content">
				<p><?php echo $missing; ?></p>
			</section>

			<footer class="article-footer">
				<p><?php echo $error_message; ?></p>
			</footer>

		</article>
	<?php
	endif;
	?>

</div>
</main>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
