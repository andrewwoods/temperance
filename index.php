<?php get_header(); ?>

<main id="main" class="main" role="main">
	<div id="main-content" class="main-content">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'content/article', 'content' );
		endwhile;
		?>

		<?php temperance_pagination_links(); ?>

	<?php else : ?>
		<?php
            get_template_part( 'content/empty' );
		?>
	<?php
	endif;
	?>

	</div>
</main>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
