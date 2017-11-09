<?php
/**
 * The loop content for a single blog post
 *
 * @package Temperance
 * @subpackage Templates
 */
?>
<?php get_header(); ?>

<div id="content">
<div id="inner-content" class="wrap clearfix">
<div id="main" class="eightcol first clearfix" role="main">

<?php
	if (have_posts()) :
		while (have_posts()) : the_post();
			get_template_part( 'post', 'content' );
		endwhile;

	else : ?>
	<?php
		$not_found = __( 'Oops, Post Not Found!', 'temperancetheme' );
		$error     = __( 'This is the error message in single.php', 'temperancetheme' );
		$missing   = __( 'Uh Oh. Something is missing. ', 'temperancetheme' );
	?>
		<article id="post-not-found" class="hentry clearfix">
			<header class="article-header">
				<h1><?php echo $not_found; ?></h1>
			</header>
			<section class="entry-content">
				<p><?php echo $missing; ?></p>
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
