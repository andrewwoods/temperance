			<footer id="footer" class="footer" role="content-info">
				<div id="inner-footer" class="wrap clearfix">

					<nav role="navigation">
						<?php temperance_footer_links(); ?>
					</nav>

					<p class="source-org copyright">&copy;
						<?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.
					</p>

				</div>
			</footer>

		</div>

		<?php
		// all js scripts are loaded in library/temperance.php
		wp_footer();
		?>

	</body>
</html>
