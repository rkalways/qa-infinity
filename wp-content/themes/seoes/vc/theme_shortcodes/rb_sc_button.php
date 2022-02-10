<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles",
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"	=> 'all'
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
			"heading"		=> esc_html_x( 'Aligning', 'backend', 'seoes' ),
			"param_name"	=> "aligning",
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"	=> "all",
			"dependency"	=> array(
				"element"		=> "customize_align",
				"not_empty"		=> true
			),
			"value"			=> array(
				esc_html_x( 'Left', 'backend', 'seoes' )	=> 'left',
				esc_html_x( 'Center', 'backend', 'seoes' )	=> 'center',
				esc_html_x( 'Right', 'backend', 'seoes' )	=> 'right',
			)
		),
		array(
			"type"			=> "dropdown",
			"heading"		=> esc_html_x( 'Button Size', 'backend', 'seoes' ),
			"param_name"	=> "btn_size",
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"value"			=> array(
				esc_html_x( 'Large', 'backend', 'seoes' )		=> 'large',
				esc_html_x( 'Medium', 'backend', 'seoes' )		=> 'medium',
				esc_html_x( 'Small', 'backend', 'seoes' )		=> 'small',
			)
		),
		array(
			"type"			=> "dropdown",
			"heading"		=> esc_html_x( 'Button Style', 'backend', 'seoes' ),
			"param_name"	=> "btn_style",
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"value"			=> array(
				esc_html_x( 'Simple', 'backend', 'seoes' )		=> 'simple',
				esc_html_x( 'Advanced', 'backend', 'seoes' )	=> 'advanced',
				esc_html_x( 'Custom', 'backend', 'seoes' )		=> 'custom',
			),
			"std"			=> 'advanced'
		),
		array(
			"type"				=> "checkbox",
			"param_name"		=> "square",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "btn_style",
				"value"		=> array('advanced', 'custom')
			),
			"value"				=> array( esc_html_x( 'Square', 'backend', 'seoes' ) => true ),
		),
		array(
			"type"				=> "checkbox",
			"param_name"		=> "no_shadow",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "btn_style",
				"value"		=> array('advanced', 'custom')
			),
			"value"				=> array( esc_html_x( 'Disable Shadow', 'backend', 'seoes' ) => true ),
			"std"				=> "1"
		),
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html_x( 'Style', 'backend', 'seoes' ),
			"param_name"		=> "btn_custom_style",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "btn_style",
				"value"		=> "custom"
			),
			"value"				=> array(
				esc_html_x( 'Simple', 'backend', 'seoes' )		=> 'simple',
				esc_html_x( 'Advanced', 'backend', 'seoes' )	=> 'advanced',
			),
			"std"				=> 'advanced'
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Title', 'backend', 'seoes' ),
			"param_name"		=> "btn_font_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "btn_style",
				"value"		=> "custom"
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> '#fff'
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Arrow Color', 'backend', 'seoes' ),
			"param_name"		=> "btn_arrow_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "btn_custom_style",
				"value"		=> "simple"
			),
			"value"				=> SECONDARY_COLOR
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Title Hover', 'backend', 'seoes' ),
			"param_name"		=> "btn_font_color_hover",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "btn_custom_style",
				"value"		=> "advanced"
			),
			"value"				=> PRIMARY_COLOR
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Background', 'backend', 'seoes' ),
			"param_name"		=> "btn_bg_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "btn_custom_style",
				"value"		=> "advanced"
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> SECONDARY_COLOR
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Background Hover', 'backend', 'seoes' ),
			"param_name"		=> "btn_bg_color_hover",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "btn_custom_style",
				"value"		=> "advanced"
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> '#fff'
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Border', 'backend', 'seoes' ),
			"param_name"		=> "btn_border_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "btn_custom_style",
				"value"		=> "advanced"
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> SECONDARY_COLOR
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Border Hover', 'backend', 'seoes' ),
			"param_name"		=> "btn_border_color_hover",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "btn_custom_style",
				"value"		=> "advanced"
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> SECONDARY_COLOR
		),
	);

	/* -----> RESPONSIVE STYLING TABS PROPERTIES <----- */
	$styles_landscape = $styles_portrait = $styles_mobile = $styles;

	$styles_landscape =  rb_responsive_styles($styles_landscape, 'landscape', rb_landscape_group_name());
	$styles_portrait =  rb_responsive_styles($styles_portrait, 'portrait', rb_tablet_group_name());
	$styles_mobile =  rb_responsive_styles($styles_mobile, 'mobile', rb_mobile_group_name());

	$params = rb_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"				=> "textfield",
				"admin_label"		=> true,
				"heading"			=> esc_html_x( 'Title', 'backend', 'seoes' ),
				"param_name"		=> "title",
				"value"				=> "Click Me!"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Link', 'backend', 'seoes' ),
				"param_name"		=> "url",
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "new_tab",
				"value"				=> array( esc_html_x( 'Open in New Tab', 'backend', 'seoes' ) => true ),
				"std"				=> "1"
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
	vc_map( array(
		"name"				=> esc_html_x( 'RB Button', 'backend', 'seoes' ),
		"base"				=> "rb_sc_button",
		'category'			=> "By RB",
		"icon"     			=> "rb_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Button extends WPBakeryShortCode {
	    }
	}
?>