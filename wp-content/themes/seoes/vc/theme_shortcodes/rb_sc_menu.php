<?php
	/* -----> MENUS PROPERTIES <----- */
	$args = get_terms('nav_menu', array('hide_empty' => true));
	$menus = array( 'None' => 'none' );

	if( !empty($args) ){
		foreach( $args as $value ){
			$menus[$value->name] = $value->slug;
		}
	}

	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles",
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"	=> 'all',
		),
		array(
			"type"			=> "checkbox",
			"param_name"	=> "customize_align",
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"	=> "all",
			"value"			=> array( esc_html_x( 'Customize Alignment', 'backend', 'seoes' ) => true ),
		),
		array(
			"type"			=> "dropdown",
			"heading"		=> esc_html_x( 'Alignment', 'backend', 'seoes' ),
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"param_name"	=> "alignment",
			"responsive"	=> "all",
			"dependency"	=> array(
				"element"		=> "customize_align",
				"not_empty"		=> true
			),
			"value"			=> array(
				esc_html_x( "Left", 'backend', 'seoes' ) => 'flex-start',
				esc_html_x( "Center", 'backend', 'seoes' ) => 'center',
				esc_html_x( "Right", 'backend', 'seoes' ) => 'flex-end',
			),
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Font Color', 'backend', 'seoes' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"param_name"		=> "color",
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> get_theme_mod('menu_font_color'),
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Font Hover', 'backend', 'seoes' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"param_name"		=> "hover_color",
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> get_theme_mod('menu_font_color_hover'),
		),
	);

	/* -----> RESPONSIVE STYLING TABS PROPERTIES <----- */
	$styles_landscape = $styles_portrait = $styles_mobile = $styles;

	$styles_landscape = rb_responsive_styles($styles_landscape, 'landscape', rb_landscape_group_name());
	$styles_portrait = rb_responsive_styles($styles_portrait, 'portrait', rb_tablet_group_name());
	$styles_mobile = rb_responsive_styles($styles_mobile, 'mobile', rb_mobile_group_name());

	$params = rb_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"			=> "dropdown",
				"heading"		=> esc_html_x( 'Choose Menu', 'backend', 'seoes' ),
				"param_name"	=> "menu",
				"value"			=> $menus	
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Extra class name', 'backend', 'seoes' ),
				"description"		=> esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'backend', 'seoes' ),
				"param_name"		=> "el_class",
				"value"				=> ""
			),
		),
		/* -----> STYLING TAB <----- */
		$styles,
		/* -----> TABLET LANDSCAPE TAB <----- */
		$styles_landscape,
		/* -----> TABLET PORTRAIT TAB <----- */
		$styles_portrait,
		/* -----> MOBILE TAB <----- */
		$styles_mobile
	));

	/* -----> MODULE DECLARATION <----- */
	vc_map( array(
		"name"				=> esc_html_x( 'RB Menu', 'backend', 'seoes' ),
		"base"				=> "rb_sc_menu",
		'category'			=> "By RB",
		"icon"     			=> "rb_icon",		
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Menu extends WPBakeryShortCode {
	    }
	}
?>