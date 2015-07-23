<?php get_header(); ?>

<div id="content">
	<div id="inner-content" class="wrap clearfix">
		<div id="main" class="eightcol first clearfix" role="main">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
			get_template_part( 'article', 'content' );
		?>
			<?php endwhile; ?>

				<?php if ( function_exists( 'temperance_page_navi' ) ) { ?>
					<?php temperance_page_navi(); ?>
				<?php } else { ?>
					<nav class="wp-prev-next">
						<ul class="clearfix">
							<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'temperancetheme' )) ?></li>
							<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'temperancetheme' )) ?></li>
						</ul>
					</nav>
				<?php } ?>

			<?php else : ?>

				<article id="post-not-found" class="hentry clearfix">
					<header class="article-header">
						<h1><?php _e( 'Oops, Post Not Found!', 'temperancetheme' ); ?></h1>
					</header>

					<section class="entry-content">
						<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'temperancetheme' ); ?></p>
					</section>

					<footer class="article-footer">
						<p><?php _e( 'This is the error message in the index.php template.', 'temperancetheme' ); ?></p>
					</footer>
				</article>

			<?php endif; ?>

		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
