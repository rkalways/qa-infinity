<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Background Color', 'backend', 'seoes' ),
			"param_name"		=> "background_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"value"				=> "#fff"
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Text Color', 'backend', 'seoes' ),
			"param_name"		=> "text_color",
			"edit_field_class" 	=> "vc_col-xs-6",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"value"				=> PRIMARY_COLOR
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Divider Color', 'backend', 'seoes' ),
			"param_name"		=> "divider_color",
			"edit_field_class" 	=> "vc_col-xs-6",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"value"				=> SECONDARY_COLOR
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Label Background', 'backend', 'seoes' ),
			"param_name"		=> "label_bg",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "highlighted",
				"not_empty"	=> true
			),
			"value"				=> "#1ED2B4",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Button Title', 'backend', 'seoes' ),
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
			"heading"			=> esc_html_x( 'Button Title Hover', 'backend', 'seoes' ),
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
			"heading"			=> esc_html_x( 'Button Background', 'backend', 'seoes' ),
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
			"heading"			=> esc_html_x( 'Button Background Hover', 'backend', 'seoes' ),
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
			"heading"			=> esc_html_x( 'Button Border', 'backend', 'seoes' ),
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
			"heading"			=> esc_html_x( 'Button Border Hover', 'backend', 'seoes' ),
			"param_name"		=> "btn_border_color_hover",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "btn_custom_style",
				"value"		=> "advanced"
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> SECONDARY_COLOR
		)
	);
	$params = rb_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Title', 'backend', 'seoes' ),
				"param_name"		=> "title",
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Currency', 'backend', 'seoes' ),
				"param_name"		=> "currency",
				"edit_field_class" 	=> "vc_col-xs-4",
				"default"			=> "$"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Price', 'backend', 'seoes' ),
				"param_name"		=> "price",
				"edit_field_class" 	=> "vc_col-xs-4",
				"default"			=> "49"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Price Description', 'backend', 'seoes' ),
				"param_name"		=> "price_desc",
				"edit_field_class" 	=> "vc_col-xs-4",
				"default"			=> "/month"
			),
			array(
				"type"				=> "textarea_html",
				"heading"			=> esc_html_x( 'Text', 'backend', 'seoes' ),
				"param_name"		=> "content",
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
				"param_name"		=> "highlighted",
				"value"				=> array( esc_html_x( 'Highlighted', 'backend', 'seoes' ) => true ),
			),
			array(
				"type"				=> "attach_image",
				"heading"			=> esc_html_x( 'Image', 'RB_VC_Image', 'seoes' ),
				"param_name"		=> "image",
				"edit_field_class" 	=> "vc_col-xs-6",
				"dependency"		=> array(
					"element"	=> "highlighted",
					"not_empty"	=> true
				),
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Highlight Label', 'backend', 'seoes' ),
				"param_name"		=> "highlight_label",
				"edit_field_class" 	=> "vc_col-xs-6",
				"default"			=> "Popular",
				"dependency"		=> array(
					"element"	=> "highlighted",
					"not_empty"	=> true
				),
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
		$styles
	));

	/* -----> MODULE DECLARATION <----- */
	vc_map( array(
		"name"				=> esc_html_x( 'RB Pricing Plan', 'backend', 'seoes' ),
		"base"				=> "rb_sc_pricing_plan",
		'category'			=> "By RB",
		"icon"     			=> "rb_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Pricing_Plan extends WPBakeryShortCode {
	    }
	}

?>