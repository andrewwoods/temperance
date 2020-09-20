<?php
/**
 * The loop content for a single blog post
 *
 * @package Temperance
 * @subpackage Templates
 */
?>
<?php get_header(); ?>

<main id="main" class="main" role="main">
	<div id="main-content" class="main-content">

        <?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'content/post' );
		endwhile;
	else :
		get_template_part( 'content/empty' );
	endif;
	?>

	</div>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
