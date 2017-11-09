<?php
/**
 * Primary footer for the theme.
 *
 * This file is part of the Temperance starter theme by Andrew Woods
 *
 * @license GPLv2
 * @author Andrew Woods <andrew@andrewwoods.net>
 * @package Temperance
 */

?>
			<footer id="footer" class="footer" role="content-info">
				<div id="inner-footer" class="wrap clearfix">

					<nav role="navigation">
						<?php temperance_footer_nav(); ?>
					</nav>

					<p class="source-org copyright">
						<?php temperance_copyright(); ?>.
					</p>

				</div>
			</footer>

		</div>

		<?php
		// all js scripts are loaded in library/temperance.php.
		wp_footer();
		?>

	</body>
</html>
