<?php
/**
* description of package
*
* @package YourPackage
* @subpackage Subpackage name
* @author firstname lastname <user@host.com>
*/
class Temperance_Customizer {

	/**
	 * Add new items to the customizer
	 *
	 * Long Description
	 *
	 * @since 1.2
	 * @param WP_Customize_Manager $wp_customize
	 * @return void
	 */
	public static function register( $wp_customize ) {

		// 1. Define a new section (if desired) to the Theme Customizer
		$wp_customize->add_section( 'temperancetheme_options',
			array(
				'title' => __( 'Temperance Options', 'temperancetheme' ),
				'priority' => 35,
				'capability' => 'edit_theme_options',
				'description' => __('Allows you to customize some example settings for MyTheme.', 'mytheme'),
			)
		);

		// 2. Register new settings to the WP database...
		$wp_customize->add_setting( 'link_textcolor',
			array(
				'default' => '#2BA6CB',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			)
		);


		// 3. Finally, we define the control itself (which 
		//    links a setting to a section and renders the HTML controls)...
		$color_control = new WP_Customize_Color_Control(
			$wp_customize,
			'mytheme_link_textcolor',
			array(
				'label' => __( 'Link Color', 'temperancetheme' ),
				'section' => 'temperancetheme_options', // 'colors'
				'settings' => 'link_textcolor',
				'priority' => 10,
			)
		);
		$wp_customize->add_control( $color_control );


		// 4. We can also change built-in settings by 
		// modifying properties. For instance, let's make some stuff use live 
		// preview JS...
		// $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		// $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		// $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		// $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

	}

	public static function live_preview() {
	wp_enqueue_script( 
		'mytheme-themecustomizer', // Give the script a unique ID
		get_template_directory_uri() . '/assets/js/theme-customizer.js', // Define the path to the JS file
		array(  'jquery', 'customize-preview' ), // Define dependencies
		'', // Define a version (optional) 
		true // Specify whether to put in footer (leave this true)
	);
	}


}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'Temperance_Customizer' , 'register' ) );

// Output custom CSS to live site
// add_action( 'wp_head' , array( 'MyTheme_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'Temperance_Customizer' , 'live_preview' ) );



