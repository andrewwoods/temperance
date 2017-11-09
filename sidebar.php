<?php
/**
 * Sidebar file for content you'd like to
 *
 * This file is part of the Temperance starter theme by Andrew Woods
 *
 * @license GPLv2
 * @author Andrew Woods <andrew@andrewwoods.net>
 * @package Plugin\Navigation
 */

?>
<div class="sidebar" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar_main' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar_main' ); ?>
	<?php else : ?>
		<?php
		// This content shows up if there are no widgets
		// placed in a sidebar in the wp-admin.
		?>

		<div class="alert alert-help">
			<p>
			<?php
			_e( 'Please activate some Widgets.', 'temperancetheme' );
			?>
			</p>
		</div>
	<?php endif; ?>

</div>
