<?php
/**
 * Language files are used to translate the interface of your WordPress website
 * into multiple languages. To add support for a new language, put the
 * translation files into the 'library/translation' directory.
 *
 * Work with native speakers to create translation files.
 *
 * DO NOT USE AUTOMATED SERVICES like Google Translate.
 *
 * @package Temperance\Language
 */

add_action( 'after_setup_theme', 'temperance_load_translations' );

/**
 * Load translation files
 */
function temperance_load_translations() {
	load_theme_textdomain( 'temperancetheme', get_template_directory() . '/library/translation' );
}

