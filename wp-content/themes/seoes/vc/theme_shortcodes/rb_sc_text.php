<?php
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
			"heading"		=> esc_html_x( 'Text Alignment', 'backend', 'seoes' ),
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"param_name"	=> "module_alignment",
			"responsive"	=> "all",
			"dependency"		=> array(
				"element"	=> "customize_align",
				"not_empty"	=> true
			),
			"value"			=> array(
				esc_html_x( "Left", 'backend', 'seoes' ) => 'left',
				esc_html_x( "Center", 'backend', 'seoes' ) => 'center',
				esc_html_x( "Right", 'backend', 'seoes' ) => 'right',
			),
		),
		array(
			"type"			=> "checkbox",
			"param_name"	=> "customize_size",
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"	=> 'all',
			"value"			=> array( esc_html_x( 'Customize Sizes', 'backend', 'seoes' ) => true ),
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Subtitle Size', 'backend', 'seoes' ),
			"param_name"		=> "subtitle_size",
			"edit_field_class" 	=> "vc_col-xs-6",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "20px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Subtitle Line-Height', 'backend', 'seoes' ),
			"param_name"		=> "subtitle_lh",
			"edit_field_class" 	=> "vc_col-xs-6",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "25px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Title Size', 'backend', 'seoes' ),
			"param_name"		=> "title_size",
			"edit_field_class" 	=> "vc_col-xs-4",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "50px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Title Line-Height', 'backend', 'seoes' ),
			"param_name"		=> "title_lh",
			"edit_field_class" 	=> "vc_col-xs-4",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "1.2em",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Title Margin Bottom', 'backend', 'seoes' ),
			"param_name"		=> "title_margin",
			"edit_field_class" 	=> "vc_col-xs-4",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "50px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Content Size', 'backend', 'seoes' ),
			"param_name"		=> "content_size",
			"edit_field_class" 	=> "vc_col-xs-6",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "17px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Content Line-Height', 'backend', 'seoes' ),
			"param_name"		=> "content_lh",
			"edit_field_class" 	=> "vc_col-xs-6",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "30px",
		),
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html_x( 'Button Size', 'backend', 'seoes' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"param_name"		=> "button_size",
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"		=> "customize_size",
				"not_empty"		=> true
			),
			"value"				=> array(
				esc_html_x( "Small", 'backend', 'seoes' ) 	=> 'small',
				esc_html_x( "Medium", 'backend', 'seoes' ) 	=> 'medium',
				esc_html_x( "Large", 'backend', 'seoes' ) 	=> 'large',
			),
			"std"				=> "medium"
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Button Margin Top', 'backend', 'seoes' ),
			"param_name"		=> "button_margin",
			"edit_field_class" 	=> "vc_col-xs-6",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "35px",
		),
		array(
			"type"			=> "checkbox",
			"param_name"	=> "customize_colors",
			"std"			=> "1",
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"value"			=> array( esc_html_x( 'Customize Colors', 'backend', 'seoes' ) => true ),
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Title Color', 'backend', 'seoes' ),
			"param_name"		=> "custom_title_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> PRIMARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Subtitle Color', 'backend', 'seoes' ),
			"param_name"		=> "custom_subtitle_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> SECONDARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Font Color', 'backend', 'seoes' ),
			"param_name"		=> "custom_font_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> rb_Hex2RGBA( PRIMARY_COLOR, '0.8' ),
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Font Color Hover', 'backend', 'seoes' ),
			"param_name"		=> "custom_font_color_hover",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> SECONDARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'List Markers Color', 'backend', 'seoes' ),
			"param_name"		=> "custom_font_list_markers",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> SECONDARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Divider Color', 'backend', 'seoes' ),
			"param_name"		=> "divider_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> SECONDARY_COLOR,
		),
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html_x( 'Button Type', 'backend', 'seoes' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"param_name"		=> "button_type",
			"value"				=> array(
				esc_html_x( "Advanced", 'backend', 'seoes' ) 	=> 'advanced',
				esc_html_x( "Simple", 'backend', 'seoes' ) 		=> 'simple',
				esc_html_x( 'Custom', 'backend', 'seoes' )		=> 'custom',
			),
			"std"				=> "advanced" 
		),
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html_x( 'Custom Button Style', 'backend', 'seoes' ),
			"param_name"		=> "btn_custom_style",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "button_type",
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
				"element"	=> "button_type",
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

	$styles_landscape = rb_responsive_styles($styles_landscape, 'landscape', rb_landscape_group_name());
	$styles_portrait = rb_responsive_styles($styles_portrait, 'portrait', rb_tablet_group_name());
	$styles_mobile = rb_responsive_styles($styles_mobile, 'mobile', rb_mobile_group_name());

	$params = rb_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Subtitle', 'backend', 'seoes' ),
				"param_name"		=> "subtitle",
				"value"				=> "",
				"admin_label"		=> true,
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Subtitle Position', 'backend', 'seoes' ),
				"param_name"		=> "subtitle_pos",
				"value"				=> "",
				"value"				=> array(
					esc_html_x( "Below Title", 'backend', 'seoes' ) 	=> 'below',
					esc_html_x( "Above Title", 'backend', 'seoes' ) 	=> 'above',
				),
			),
			array(
				"type"				=> "textarea",
				"heading"			=> esc_html_x( 'Title', 'backend', 'seoes' ),
				"param_name"		=> "title",
				"value"				=> "",
				"edit_field_class" 	=> "vc_col-xs-6",
				"admin_label"		=> true,
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Title HTML Tag', 'backend', 'seoes' ),
				"param_name"		=> "title_tag",
				"edit_field_class" 	=> "vc_col-xs-6",
				"value"				=> array(
					esc_html_x( "Default - (H3)", 'backend', 'seoes' ) 	=> 'h3',
					esc_html_x( "H1", 'backend', 'seoes' ) 				=> 'h1',
					esc_html_x( "H2", 'backend', 'seoes' ) 				=> 'h2',
					esc_html_x( "H3", 'backend', 'seoes' ) 				=> 'h3',
					esc_html_x( "H4", 'backend', 'seoes' ) 				=> 'h4',
					esc_html_x( "H5", 'backend', 'seoes' ) 				=> 'h5',
					esc_html_x( "H6", 'backend', 'seoes' ) 				=> 'h6',
				),
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Button Title', 'backend', 'seoes' ),
				"param_name"		=> "button_title",
				"value"				=> "",
				"edit_field_class" 	=> "vc_col-xs-6",
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Button URL', 'backend', 'seoes' ),
				"param_name"		=> "button_url",
				"value"				=> "#",
				"edit_field_class" 	=> "vc_col-xs-6",
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "show_divider",
				"value"				=> array( esc_html_x( 'Show Divider', 'backend', 'seoes' ) => true ),
				"std"				=> true
			),
			array(
				"type"				=> "textarea_html",
				"heading"			=> esc_html_x( 'Text', 'backend', 'seoes' ),
				"param_name"		=> "content",
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
		"name"				=> esc_html_x( 'RB Text', 'backend', 'seoes' ),
		"base"				=> "rb_sc_text",
		'category'			=> "By RB",
		"icon"     			=> "rb_icon",		
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Text extends WPBakeryShortCode {
	    }
	}
?>