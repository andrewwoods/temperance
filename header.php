<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="description" content="<?php bloginfo( 'description' ); ?>">
		<link
			rel="shortcut icon"
			type="image/x-icon"
			href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<link
			rel="icon"
			type="image/png"
			href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div id="skip-nav" class="skip-nav">
			<a href="#main-content">Skip to content</a>
			<a href="#main-sidebar-content">Skip to sidebar</a>
			<a href="#footer-content">Skip to footer</a>
		</div>

		<div id="page">
			<header class="header" role="banner">
				<div id="inner-header" class="wrap clearfix">
					<?php
					// to use a image just replace the bloginfo('name')
					// with your img src and remove the surrounding <p>.
					?>
					<p id="logo"><a href="<?php echo home_url(); ?>"><?php
						bloginfo('name');
					?></a></p>

					<?php temperance_main_nav(); ?>

				</div>
			</header>
