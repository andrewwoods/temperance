<?php
/*
	Lanaguage files are used to translate the interface of your WordPress website
	into multiple languages. To add support for a new language, put the translation files
	into the 'library/translation' directory.

	Work with native speakers to create translation files.

	DO NOT USE AUTOMATED SERVICES like Google Translate.
*/

add_action('after_setup_theme', 'temperanace_theme_setup');

function my_theme_setup(){
	load_theme_textdomain( 'temperancetheme', get_template_directory() .'/library/translation' );
}

