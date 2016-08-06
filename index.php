<?php get_header(); ?>

<div id="content">
<div id="inner-content" class="wrap clearfix">
<div id="main" class="eightcol first clearfix" role="main">
<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'content/article', 'content' );
	endwhile; ?>

	<?php if ( function_exists( 'temperance_page_navi' ) ) : ?>
		<?php temperance_page_navi(); ?>
	<?php else : ?>
		<nav class="wp-prev-next">
			<ul class="clearfix">
			<li class="prev-link"><?php
				next_posts_link( __( '&laquo; Older Entries', 'temperancetheme' ))
			?></li>
			<li class="next-link"><?php
				previous_posts_link( __( 'Newer Entries &raquo;', 'temperancetheme' ))
			?></li>
			</ul>
		</nav>
	<?php endif; ?>

<?php else : ?>
	<?php
		$uh_oh_message = 'Uh Oh. Something is missing. Try double checking things.';
	?>
	<article id="post-not-found" class="hentry clearfix">
		<section class="entry-content">
		<p><?php _e( $uh_oh_message, 'temperancetheme' ); ?></p>
		</section>
	</article>

<?php
endif;
?>

</div>
	<?php get_sidebar(); ?>
</div>
</div>

<?php get_footer(); ?>
