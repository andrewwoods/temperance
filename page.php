<?php get_header(); ?>

<main id="main" class="main" role="main">
	<div id="main-content" class="main-content">
	<?php
	if (have_posts()) :
		while (have_posts()) :
			the_post();
			get_template_part( 'content/content' );
		endwhile;
	else :
        get_template_part( 'content/empty');
	endif;
	?>

    </div>
</main>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
