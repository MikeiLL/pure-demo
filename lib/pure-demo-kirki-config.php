<?php

/**
 * Kirki Advanced Customizer
 * This is a sample configuration file to demonstrate all fields & capabilities.
 * @package Kirki
 */

// Early exit if Kirki is not installed
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

function isJson($string) {
 json_decode($string);
 return (json_last_error() == JSON_ERROR_NONE);
}

/**
 * Create sections using the WordPress Customizer API.
 */
function kirki_demo_sections( $wp_customize ) {

/* Are any fonts set via Use Any Font ?
 * The json_decode function returns an Object if it recieves JSON data, otherwise an (empty) array
 * We could also make use of the above isJson() function.
*/
if (! is_array(json_decode(get_option('uaf_font_data')))):
  $typopgraphy_description = __( 'NOTE: Some Font Faces have been assigned by Use Any Font, plugin, in which case you can only update their other details here.', 'pure-demo' );
else:
  $typopgraphy_description = __( 'NOTE: If you want to use a custom font you upload yourself, please install/use the "Use Any Font" plugin.', 'pure-demo' );
endif;
//https://wordpress.org/plugins/use-any-font/
// Is Use Any Font activated?
if (function_exists('uaf_write_css')):
  $typopgraphy_description .= ' ' . __( '"Use Any Font" plugin. installed!', 'pure-demo' );
endif;

	/**
	 * Add sections
	 */
	$wp_customize->add_section( 'site_typography', array(
		'title'       => __( 'Typography', 'pure-demo' ),
		'priority'    => 10,
		'description' => $typopgraphy_description,
	) );

	$wp_customize->add_section( 'color_section', array(
		'title'       => __( 'Color Controls', 'pure-demo' ),
		'priority'    => 10,
		'description' => __( 'This is the section description', 'pure-demo' ),
	) );

		$wp_customize->add_section( 'header_logo', array(
		'title'       => __( 'Header Logo', 'pure-demo' ),
		'priority'    => 0,
		'description' => __( 'This is the section description', 'pure-demo' ),
	) );

		$wp_customize->add_section( 'text_section', array(
		'title'       => __( 'Custom JS', 'pure-demo' ),
		'priority'    => 0,
		'description' => __( 'This is the section description', 'pure-demo' ),
	) );

}
add_action( 'customize_register', 'kirki_demo_sections' );

/**
 * Create panels using the Kirki API
 */
Puredemo_Kirki::add_section( 'boolean_controls', array(
	'priority'    => 10,
	'title'       => __( 'Boolean Controls', 'pure-demo' ),
	'description' => __( 'This panel contains controls that return true/false Controls', 'pure-demo' ),
) );


/**
 * Add file controls
 */
function kirki_file_controls_fields( $fields ) {

	$fields[] = array(
		'type'        => 'image',
		'settings'    => 'image_demo',
		'label'       => __( 'This is the label', 'pure-demo' ),
		'description' => __( 'This is the control description', 'pure-demo' ),
		'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'pure-demo' ),
		'section'     => 'file_controls_section',
		'default'     => '',
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => 'p',
				'property' => 'background-image',
			),
		),
	);

	$fields[] = array(
		'type'        => 'upload',
		'settings'    => 'file_controls_section',
		'label'       => __( 'This is the label', 'pure-demo' ),
		'description' => __( 'This is the control description', 'pure-demo' ),
		'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'pure-demo' ),
		'section'     => 'file_controls_section',
		'default'     => '',
		'priority'    => 10,
	);

	return $fields;

}
add_filter( 'kirki/fields', 'kirki_file_controls_fields' );


/**
 * Add text fields
 */
function puredemo_script_controls( $fields ) {

	$fields[] = array(
		'type'        => 'code',
		'settings'    => 'puredemo_custom_js',
		'label'       => __( 'Code-JS-Chrome', 'pure-demo' ),
		'description' => __( 'Add custom javascript for the site here.', 'pure-demo' ),
		'help'        => __( 'Example of JS script would be: `$(document).ready(function() {alert("hi");});`.', 'pure-demo' ),
		'default'     => '',
		'section'     => 'text_section',
		'choices'     => array(
			'theme'    => 'chrome',
			'language' => 'html',
			'height'   => 250,
		)
	);

	return $fields;

}
add_filter( 'kirki/fields', 'puredemo_script_controls' );

/**
 * Add numeric fields
 */
function kirki_numeric_fields( $fields ) {

	// step = 10
	$fields[] = array(
		'type'        => 'slider',
		'settings'    => 'slider_demo',
		'label'       => __( 'This is the label', 'pure-demo' ),
		'description' => __( 'This is the control description', 'pure-demo' ),
		'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'pure-demo' ),
		'section'     => 'numeric',
		'default'     => 20,
		'priority'    => 10,
		'choices'     => array(
			'min'  => -100,
			'max'  => 100,
			'step' => 10,
		),
	);

	// step = 0.01
	$fields[] = array(
		'type'        => 'slider',
		'settings'    => 'slider_demo_2',
		'label'       => __( 'This is the label', 'pure-demo' ),
		'description' => __( 'This is the control description', 'pure-demo' ),
		'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'pure-demo' ),
		'section'     => 'numeric',
		'default'     => 1.58,
		'priority'    => 20,
		'choices'     => array(
			'min'  => 0,
			'max'  => 5,
			'step' => .01,
		),
	);

	$fields[] = array(
		'type'        => 'number',
		'settings'    => 'number_demo',
		'label'       => __( 'This is the label', 'pure-demo' ),
		'description' => __( 'This is the control description', 'pure-demo' ),
		'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'pure-demo' ),
		'section'     => 'numeric',
		'default'     => '42',
		'priority'    => 10,
	);

	$fields[] = array(
		'type'        => 'dimension',
		'settings'    => 'dimension_demo',
		'label'       => __( 'This is the label', 'pure-demo' ),
		'description' => __( 'This is the control description', 'pure-demo' ),
		'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'pure-demo' ),
		'section'     => 'numeric',
		'default'     => '42px',
		'priority'    => 10,
	);

	return $fields;

}
add_filter( 'kirki/fields', 'kirki_numeric_fields' );

/**
 * Create a config instance that will be used by fields added via the static methods.
 * For this example we'll be defining our options to be serialized in the db, under the 'pure-demo' option.
 */
Puredemo_Kirki::add_config( 'pure-demo', array(
	'option_type' => 'theme_mod',
) );

Puredemo_Kirki::add_field( 'pure-demo', array(
	'type'        => 'repeater',
	'label'       => __( 'This is the label', 'pure-demo' ),
	'description' => __( 'This is the control description', 'pure-demo' ),
	'help'        => __( 'This is some extra help text.', 'pure-demo' ),
	'section'     => 'repeater_section',
	'default'     => array(),
	'priority'    => 10,
	'settings' => 'pure-demo',
	'fields' => array(
		'subsetting_1' => array(
			'type' => 'text',
			'label' => 'Setting A',
			'description' => 'lalala',
			'default' => 'Yeah'
		),
		'subsetting_2' => array(
			'type' => 'text',
			'label' => 'Setting B',
			'description' => 'lalala',
			'default' => ''
		),
		'subsetting_3' => array(
			'type' => 'checkbox',
			'description' => 'A checkbox',
			'default' => true
		),
		'subsetting_4' => array(
			'label' => 'A selector',
			'type' => 'select',
			'description' => 'lalala',
			'default' => '',
			'choices' => array(
				'' => 'None',
				'choice_1' => 'Choice 1',
				'choice_2' => 'Choice 2'
			)
		),
		'subsetting_5' => array(
			'type' => 'textarea',
			'label' => 'A textarea',
			'description' => 'lalalala',
			'default' => ''
		),
		'subsetting_6' => array(
			'label' => 'A radio',
			'type' => 'radio',
			'description' => 'yipiyai',
			'default' => 'choice-1',
			'choices' => array(
				'choice-1' => 'First choice',
				'choice-2' => 'Second choice'
			)
		),
	)
) );

/**
 * Create Custom field using the Kirki API static functions
 */
Puredemo_Kirki::add_field( 'pure-demo', array(
	'type'        => 'custom',
	'settings'    => 'custom_demo',
	'label'       => __( 'This is the label', 'pure-demo' ),
	'description' => __( 'This is the control description', 'pure-demo' ),
	'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'pure-demo' ),
	'section'     => 'custom_section',
	'default'     => '<div style="padding: 30px;background-color: #333; color: #fff; border-radius: 50px;">You can enter custom markup in this control and use it however you want</div>',
	'priority'    => 10,
) );

/**
 * Create Color fields using the Kirki API static functions
 */
Puredemo_Kirki::add_field( 'pure-demo', array(
	'type'        => 'color-alpha',
	'settings'    => 'header_bg_color',
	'label'       => __( 'Header &amp; Footer Background', 'pure-demo' ),
	'description' => __( 'This is the color of the main space across the top and bottom of the site.', 'pure-demo' ),
	'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users.', 'pure-demo' ),
	'section'     => 'color_section',
	'default'     => '#a9bfcc',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'  => '#header, .content-info',
			'property' => 'background-color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#header, .content-info',
			'function' => 'css',
			'property' => 'background-color',
		),
	)
) );

Puredemo_Kirki::add_field( 'pure-demo', array(
	'type'        => 'color-alpha',
	'settings'    => 'body_bg__color',
	'label'       => __( 'Main Body Background', 'pure-demo' ),
	'description' => __( 'Set color of main site content background here.', 'pure-demo' ),
	'help'        => __( 'Remember this will be on all pages.', 'pure-demo' ),
	'section'     => 'color_section',
	'default'     => '#ffffff',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'  => 'body',
			'property' => 'background-color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(

		array(
			'element'  => 'body',
			'function' => 'css',
			'property' => 'background-color',
		),
	)
) );

Puredemo_Kirki::add_field( 'pure-demo', array(
	'type'        => 'color-alpha',
	'settings'    => 'menu_color',
	'label'       => __( 'Menu Background', 'pure-demo' ),
	'description' => __( 'Background for main nav menu in header.', 'pure-demo' ),
	'help'        => __( 'Set right bar to bottom for transparent.', 'pure-demo' ),
	'section'     => 'color_section',
	'default'     => '#a9bfcc',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'  => '#header .menu-item',
			'property' => 'background-color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#header .menu-item',
			'function' => 'css',
			'property' => 'background-color',
		),
	)
) );

Puredemo_Kirki::add_field( 'pure-demo', array(
	'type'        => 'color-alpha',
	'settings'    => 'menu_hover_color',
	'label'       => __( 'Menu Background on Hover', 'pure-demo' ),
	'description' => __( 'Background for main nav menu in header - on hover.', 'pure-demo' ),
	'help'        => __( 'Set right bar to bottom for transparent.', 'pure-demo' ),
	'section'     => 'color_section',
	'default'     => '#000000',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'  => '#header .menu-item:hover',
			'property' => 'background-color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#header .menu-item:hover',
			'function' => 'css',
			'property' => 'background-color',
		),
	)
) );

Puredemo_Kirki::add_field( 'pure-demo', array(
	'type'        => 'color-alpha',
	'settings'    => 'menu_text_color',
	'label'       => __( 'Menu Text Color', 'pure-demo' ),
	'description' => __( 'Static Color of Menu Text.', 'pure-demo' ),
	'help'        => __( 'Menu Text Color does not change.', 'pure-demo' ),
	'section'     => 'color_section',
	'default'     => '#ffffff',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'  => '#header .menu-item a',
			'property' => 'color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#header .menu-item a',
			'function' => 'css',
			'property' => 'color',
		),
	)
) );

Puredemo_Kirki::add_field( 'pure-demo', array(
	'type'        => 'color-alpha',
	'settings'    => 'sub_menu_color',
	'label'       => __( 'Sub-Menu Background', 'pure-demo' ),
	'description' => __( 'Background for sub-nav menu items that drop down.', 'pure-demo' ),
	'help'        => __( 'Set second bar at bottom for clear.', 'pure-demo' ),
	'section'     => 'color_section',
	'default'     => '#0088cc',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'  => '#header .sub-menu .menu-item',
			'property' => 'background-color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#header .sub-menu .menu-item',
			'function' => 'css',
			'property' => 'background-color',
		),
	)
) );

	Puredemo_Kirki::add_field( 'pure-demo', array(
	'type'        => 'color-alpha',
	'settings'    => 'site_title_color',
	'label'       => __( 'Site Title Color', 'pure-demo' ),
	'description' => __( 'Color of main title.', 'pure-demo' ),
	'help'        => __( '', 'pure-demo' ),
	'section'     => 'color_section',
	'default'     => '#0088cc',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'  => '.site-title a',
			'property' => 'color',
			'units'    => ' !important',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '.site-title a',
			'function' => 'css',
			'property' => 'color',
			'units'    => ' !important',
		),
	)
) );

	Puredemo_Kirki::add_field( 'pure-demo', array(
	'type'        => 'color-alpha',
	'settings'    => 'site_description_color',
	'label'       => __( 'Site Description Color', 'pure-demo' ),
	'description' => __( 'Color of "tag line".', 'pure-demo' ),
	'help'        => __( '', 'pure-demo' ),
	'section'     => 'color_section',
	'default'     => '#0088cc',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'  => '.site-description',
			'property' => 'color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '.site-description',
			'function' => 'css',
			'property' => 'color',
		),
	)
) );

Puredemo_Kirki::add_field( 'pure-demo', array(
	'type'        => 'color-alpha',
	'settings'    => 'header_text_color',
	'label'       => __( 'Heading Text Color', 'pure-demo' ),
	'description' => __( 'Color of all headings.', 'pure-demo' ),
	'help'        => __( 'These are the bold items that take up their own horizontal space.', 'pure-demo' ),
	'section'     => 'color_section',
	'default'     => '#ffffff',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'  => 'h1, h2, 3, h4, h5, h6',
			'property' => 'color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => 'h1, h2, 3, h4, h5, h6',
			'function' => 'css',
			'property' => 'color',
		),
	)
) );

Puredemo_Kirki::add_field( 'pure-demo', array(
	'type'        => 'color-alpha',
	'settings'    => 'body_text_color',
	'label'       => __( 'Body Text Color', 'pure-demo' ),
	'description' => __( 'Main body content color', 'pure-demo' ),
	'help'        => __( 'Nothing here yet', 'pure-demo' ),
	'section'     => 'color_section',
	'default'     => '#333333',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'  => 'body, body p',
			'property' => 'color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => 'body, body p',
			'function' => 'css',
			'property' => 'color',
		),
	)
) );

Puredemo_Kirki::add_field( 'pure-demo', array(
	'type'        => 'color-alpha',
	'settings'    => 'global_link_color',
	'label'       => __( 'Link Color', 'pure-demo' ),
	'description' => __( 'Color of links', 'pure-demo' ),
	'help'        => __( 'Nothing here yet', 'pure-demo' ),
	'section'     => 'color_section',
	'default'     => '#09f',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'  => 'a, a:visited',
			'property' => 'color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => 'a, a:visited',
			'function' => 'css',
			'property' => 'color',
		),
	)
) );

Puredemo_Kirki::add_field( 'pure-demo', array(
	'type'        => 'color-alpha',
	'settings'    => 'global_link_hover_color',
	'label'       => __( 'Link Hover Color', 'pure-demo' ),
	'description' => __( 'Color of links when hovered over', 'pure-demo' ),
	'help'        => __( 'Nothing here yet', 'pure-demo' ),
	'section'     => 'color_section',
	'default'     => '#00ddff',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'  => 'a:hover',
			'property' => 'color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => 'a:hover',
			'function' => 'css',
			'property' => 'color',
		),
	)
) );

/**
 * Add controls using the 'kirki/fields' filter.
  * TODO Possibly Enable users to upload fonts generated by
  * https://www.fontsquirrel.com/tools/webfont-generator
  * Maybe Use Any Font plugin easier for now.
 */

		/**
		 * Registers the section, setting & control for the kirki installer.
		 */
		function add_any_font_register( $wp_customize ) {
			// Add the section/
			// You can add your description here.
			// Please note that the title will not be displayed.
			$wp_customize->add_section( 'kirki_installer', array(
				'title'       => '',
				'description' => esc_attr__( 'If you want to use a custom font you upload yourself, please install the "Add Any Font" plugin.', 'pure-demo' ),
				'priority'    => -10,
				'capability'  => 'install_plugins',
			) );
			// Add the setting. This is required by WordPress in order to add our control.
			$wp_customize->add_setting( 'kirki_installer', array(
				'type'              => 'theme_mod',
				'capability'        => 'install_plugins',
				'default'           => '',
				'sanitize_callback' => '__return_true',
			));
			// Add our control. This is required in order to show the section.
			$wp_customize->add_control( new Kirki_Installer_Control( $wp_customize, 'kirki_installer', array(
				'section' => 'kirki_installer',
			) ) );

		}
		//add_action( 'customize_register', 'add_any_font_register' );

/**
 * Darkens the color a bit
 */
function kirki_twentytwelve_alter_color( $color ) {
    return Kirki_Color::adjust_brightness( $color, -50 );
}

function kirki_site_typography_fields( $fields ) {

	// See this post for details on output as array: https://github.com/aristath/kirki/issues/585
/*  $fields[] = array(
		'type'        => 'typography',
		'settings'    => 'site_title_typography_small',
		'label'       => __( 'Site Title Small Screens', 'pure-demo' ),
		'description' => __( 'Select type face for Site Title', 'pure-demo' ),
		'help'        => __( 'This is the BIG MAIN title of the website. If you want to upload a custom font, not included in the list below, try the Use Any Font plugin: https://wordpress.org/plugins/use-any-font', 'pure-demo' ),
		'section'     => 'site_typography',
		'default'     => array(
			'font-style'     => array( 'bold', 'italic' ),
			'font-family'    => 'Roboto',
			'font-size'      => '44',
			'font-weight'    => '400',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
		),
		'priority'    => 0,
		'choices'     => array(
			'font-style'     => true,
			'font-family'    => true,
			'font-size'      => true,
			'font-weight'    => true,
			'line-height'    => true,
			'letter-spacing' => true,
		),
		'output' => array(
											array(
													'element'     => '.site-title',
													'property'    => 'font-size',
													'units'       => 'px',
													//'media_query' => '@media screen and (min-width: 35.5em)',
											),
									),
	);

		  $fields[] = array(
		'type'        => 'typography',
		'settings'    => 'site_title_typography_medium',
		'label'       => __( 'Site Title Medium Screens', 'pure-demo' ),
		'description' => __( 'Select type face for Site Title', 'pure-demo' ),
		'help'        => __( 'This is the BIG MAIN title of the website. If you want to upload a custom font, not included in the list below, try the Use Any Font plugin: https://wordpress.org/plugins/use-any-font', 'pure-demo' ),
		'section'     => 'site_typography',
		'default'     => array(
			'font-style'     => array( 'bold', 'italic' ),
			'font-family'    => 'Roboto',
			'font-size'      => '68',
			'font-weight'    => '400',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
		),
		'priority'    => 0,
		'choices'     => array(
			'font-style'     => false,
			'font-family'    => false,
			'font-size'      => true,
			'font-weight'    => false,
			'line-height'    => false,
			'letter-spacing' => false,
		),
		'output' => array(
											array(
													'element'     => '.site-title',
													'property'    => 'font-size',
													'units'       => 'px',
													'media_query' => '@media screen and (min-width: 35.5em)',
											),
									),
	);
*/
	  $fields[] = array(
		'type'        => 'typography',
		'settings'    => 'site_title_size',
		'label'       => __( 'Site Title', 'pure-demo' ),
		'description' => __( 'Set to size in MOBILE view - will expand', 'pure-demo' ),
		'help'        => __( 'This is the BIG MAIN title of the website. If you want to upload a custom font, not included in the list below, try the Use Any Font plugin: https://wordpress.org/plugins/use-any-font', 'pure-demo' ),
		'section'     => 'site_typography',
		'default'     => array(
			'font-style'     => array( 'bold', 'italic' ),
			'font-family'    => 'Roboto',
			'font-size'      => '1em',
			'font-weight'    => '400',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
		),
		'priority'    => 0,
		'choices'     => array(
			'font-style'     => false,
			'font-family'    => false,
			'font-size'      => true,
			'font-weight'    => false,
			'line-height'    => false,
			'letter-spacing' => false,
		),
		'output' => array(
											array(
													'element'     => '.site-title',
													'property'    => 'font-size',
													'units'       => 'em',
													//'media_query' => '@media screen and (min-width: 60em)',
											),
									),
	);


	$fields[] = array(
		'type'        => 'typography',
		'settings'    => 'site_description_size',
		'label'       => __( 'Site Description Typography', 'pure-demo' ),
		'description' => __( 'Select type face for Site Description', 'pure-demo' ),
		'help'        => __( 'This is the "tag line" located below the Site Title.', 'pure-demo' ),
		'section'     => 'site_typography',
		'default'     => array(
			'font-style'     => array( 'bold', 'italic' ),
			'font-family'    => 'Roboto',
			'font-size'      => '0.6em',
			'font-weight'    => '400',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
		),
		'priority'    => 10,
		'choices'     => array(
			'font-style'     => true,
			'font-family'    => true,
			'font-size'      => true,
			'font-weight'    => true,
			'line-height'    => true,
			'letter-spacing' => true,
		),
		'output' => array(
											array(
													'element'     => '.site-description',
													'property'    => 'font-size',
													'units'       => 'em',
													//'media_query' => '@media screen and (min-width: 60em)',
											),
									),
	);

	$fields[] = array(
		'type'        => 'typography',
		'settings'    => 'top_nav_typo',
		'label'       => __( 'Top Nav Typography', 'pure-demo' ),
		'description' => __( 'Select type face for Top Nav', 'pure-demo' ),
		'help'        => __( '', 'pure-demo' ),
		'section'     => 'site_typography',
		'default'     => array(
			'font-style'     => array( 'bold', 'italic' ),
			'font-family'    => 'Roboto',
			'font-size'      => '0.6em',
			'font-weight'    => '400',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
		),
		'priority'    => 10,
		'choices'     => array(
			'font-style'     => true,
			'font-family'    => true,
			'font-size'      => true,
			'font-weight'    => true,
			'line-height'    => true,
			'letter-spacing' => true,
		),
		'output' => array(
											array(
													'element'     => '.nav-list li a',
													'property'    => 'font-size',
													'units'       => 'em',
													//'media_query' => '@media screen and (min-width: 60em)',
											),
									),
	);

$fields[] = array(
    'type'        => 'select',
    'settings'     => 'font_family_headers',
    'label'       => __( 'Global Font-Family for Headers', 'kirki' ),
    'description' => __( 'Please choose a font for your site. This font-family will be applied to all headers.', 'kirki' ),
    'section'     => 'site_typography',
    'default'     => 'Roboto',
    'priority'    => 10,
    'choices'     => Kirki_Fonts::get_font_choices(),
    'output'      => array(
        array(
            'element'  => 'h1, h2, h3, h4, h5, h6',
            'property' => 'font-family',
        ),
    ),
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => 'h1, h2, h3, h4, h5, h6',
            'function' => 'css',
            'property' => 'font-family',
        ),
    ),
);

$fields[] = array(
    'type'        => 'select',
    'settings'     => 'font_family_body',
    'label'       => __( 'Global Font-Family for site text', 'kirki' ),
    'description' => __( 'Please choose a font for your site\'s paragraphs in regular content', 'kirki' ),
    'section'     => 'site_typography',
    'default'     => 'Roboto',
    'priority'    => 10,
    'choices'     => Kirki_Fonts::get_font_choices(),
    'output'      => array(
        array(
            'element'  => 'body, body p',
            'property' => 'font-family',
        ),
    ),
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => 'body, body p',
            'function' => 'css',
            'property' => 'font-family',
        ),
    ),
);

/* adding header_logo_setting field */
Puredemo_Kirki::add_field( 'pure-demo', array(
    'settings' => 'header_logo_setting',
    'label'    => __( 'Setting for the logo', 'theme_slug' ),
    'section'  => 'header_logo',
    'type'     => 'image',
    'priority' => 10,
    'default'  => '',
) );

	return $fields;

}
add_filter( 'kirki/fields', 'kirki_site_typography_fields' );

function kirki_hooks_init() {
	Puredemo_Kirki::add_config( 'my_kirki_repeater', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'option',
		'option_name'   => 'my_kirki_repeater',
	) );
}

?>
