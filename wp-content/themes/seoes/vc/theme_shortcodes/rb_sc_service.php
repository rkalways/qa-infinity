<?php
	/* -----> ICONS PROPERTIES <----- */
	$icons = rb_ext_icon_vc_sc_config_params( 'icon_img', 'icon' );

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
			"param_name"	=> "animate_hover",
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"value"			=> array( esc_html_x( 'Animate on Hover', 'backend', 'seoes' ) => true ),
			"dependency"		=> array(
				"element"	=> "style",
				"value"		=> array( "icon_top" )
			),
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
			"group"			=> esc_html_x( "Styling", "backend", 'seoes' ),
			"responsive"	=> "all",
			"value"			=> array( esc_html_x( 'Customize Sizes', "backend", 'seoes' ) => true ),
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Icon Size', "backend", 'seoes' ),
			"param_name"		=> "icon_size",
			"group"				=> esc_html_x( "Styling", "backend", 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"responsive"		=> "all",
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "50px"
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Icon Shape Size', "backend", 'seoes' ),
			"param_name"		=> "shape_size",
			"group"				=> esc_html_x( "Styling", "backend", 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"responsive"		=> "all",
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "100px"
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Title Size', "backend", 'seoes' ),
			"param_name"		=> "title_size",
			"group"				=> esc_html_x( "Styling", "backend", 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-4",
			"responsive"		=> "all",
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "20px"
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Title Line-Height', "backend", 'seoes' ),
			"param_name"		=> "title_lh",
			"group"				=> esc_html_x( "Styling", "backend", 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-4",
			"responsive"		=> "all",
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "25px"
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Title Margins', "backend", 'seoes' ),
			"param_name"		=> "title_margins",
			"group"				=> esc_html_x( "Styling", "backend", 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-4",
			"responsive"		=> "all",
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "4px 0px 2px 0px"
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Text Size', "backend", 'seoes' ),
			"param_name"		=> "text_size",
			"group"				=> esc_html_x( "Styling", "backend", 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"responsive"		=> "all",
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "17px"
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Text Line-Height', "backend", 'seoes' ),
			"param_name"		=> "text_lh",
			"group"				=> esc_html_x( "Styling", "backend", 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"responsive"		=> "all",
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "30px"
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Button Size', "backend", 'seoes' ),
			"param_name"		=> "button_size",
			"group"				=> esc_html_x( "Styling", "backend", 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"responsive"		=> "all",
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "16px"
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Button Margin Top', "backend", 'seoes' ),
			"param_name"		=> "button_mt",
			"group"				=> esc_html_x( "Styling", "backend", 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"responsive"		=> "all",
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "10px"
		),
		array(
			"type"			=> "checkbox",
			"param_name"	=> "customize_colors",
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"value"			=> array( esc_html_x( 'Customize Colors', 'backend', 'seoes' ) => true ),
			"std"			=> '1'
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Shape Gradient 1', 'backend', 'seoes' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"param_name"		=> "shape_gradient_1",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> BUTTON_GRADIENT_1
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Shape Gradient 2', 'backend', 'seoes' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"param_name"		=> "shape_gradient_2",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> BUTTON_GRADIENT_2
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Icon Color', 'backend', 'seoes' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"param_name"		=> "icon_color",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> '#fff'
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Title Color', 'backend', 'seoes' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"param_name"		=> "title_color",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> PRIMARY_COLOR
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Divider Color', 'backend', 'seoes' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"param_name"		=> "divider_color",
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> PRIMARY_COLOR
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Shadow Color', 'backend', 'seoes' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"param_name"		=> "shadow_color",
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> ""
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Text Color', 'backend', 'seoes' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"param_name"		=> "text_color",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> rb_Hex2RGBA(PRIMARY_COLOR, '0.8')
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Text Color Hover', 'backend', 'seoes' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"param_name"		=> "text_color_hover",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> SECONDARY_COLOR
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Button Color', 'backend', 'seoes' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"param_name"		=> "button_color",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> PRIMARY_COLOR
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Button Arrow Color', 'backend', 'seoes' ),
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"param_name"		=> "button_arrow_color",
			"dependency"		=> array(
				"element"	=> "customize_colors",
				"not_empty"	=> true
			),
			"value"				=> PRIMARY_COLOR
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
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Icon / Image', 'backend', 'seoes' ),
				"param_name"		=> "icon_img",
				"value"				=> array(
					esc_html_x( "Icon", 'backend', 'seoes' ) 		=> 'icon',
					esc_html_x( "Image", 'backend', 'seoes' ) 		=> 'image',
				),
			),
		),
		$icons,
		array(
			array(
				"type"				=> "attach_image",
				"heading"			=> esc_html_x( 'Image', 'RB_VC_Image', 'seoes' ),
				"param_name"		=> "image",
				"dependency"		=> array(
					"element"	=> "icon_img",
					"value"		=> 'image'
				),
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Icon Position', 'backend', 'seoes' ),
				"param_name"		=> "style",
				"value"				=> array(
					esc_html_x( "Icon/Image Top", 'backend', 'seoes' ) 		=> 'icon_top',
					esc_html_x( "Icon/Image Left", 'backend', 'seoes' ) 	=> 'icon_left',
					esc_html_x( "Icon/Image Right", 'backend', 'seoes' ) 	=> 'icon_right',
				),
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Tablet Portrait Icon Position', 'backend', 'seoes' ),
				"param_name"		=> "style_tablet",
				"value"				=> array(
					esc_html_x( "Inherit", 'backend', 'seoes' ) 			=> 'inherit',
					esc_html_x( "Icon/Image Top", 'backend', 'seoes' ) 		=> 'icon_top',
					esc_html_x( "Icon/Image Left", 'backend', 'seoes' ) 	=> 'icon_left',
					esc_html_x( "Icon/Image Right", 'backend', 'seoes' ) 	=> 'icon_right',
				),
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Icon Shape', 'backend', 'seoes' ),
				"param_name"		=> "icon_shape",
				"dependency"		=> array(
					"element"	=> "icon_img",
					"value"		=> 'icon'
				),
				"value"				=> array(
					esc_html_x( "None", 'backend', 'seoes' ) 		=> 'none',
					esc_html_x( "Round", 'backend', 'seoes' ) 		=> 'round',
					esc_html_x( "Rhombus", 'backend', 'seoes' ) 	=> 'rhombus',
					esc_html_x( "Square", 'backend', 'seoes' ) 		=> 'square',
					esc_html_x( "Hexagon", 'backend', 'seoes' ) 	=> 'hexagon',
				),
			),
			array(
				"type"				=> "textfield",
				"admin_label"		=> true,
				"heading"			=> esc_html_x( 'Title', 'backend', 'seoes' ),
				"edit_field_class" 	=> "vc_col-xs-6",
				"param_name"		=> "title",
				"value"				=> ""
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Title HTML Tag', 'backend', 'seoes' ),
				"edit_field_class" 	=> "vc_col-xs-6",
				"param_name"		=> "title_tag",
				"value"				=> array(
					esc_html_x( "Default - (H5)", 'backend', 'seoes' ) 	=> 'h5',
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
				"admin_label"		=> true,
				"heading"			=> esc_html_x( 'Button Title', 'backend', 'seoes' ),
				"edit_field_class" 	=> "vc_col-xs-6",
				"param_name"		=> "button_title",
				"value"				=> "Click Me!"
			),
			array(
				"type"				=> "textfield",
				"admin_label"		=> true,
				"heading"			=> esc_html_x( 'Url', 'backend', 'seoes' ),
				"edit_field_class" 	=> "vc_col-xs-6",
				"param_name"		=> "button_url",
				"value"				=> "#"
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "sharp_corners",
				"edit_field_class" 	=> "vc_col-xs-6",
				"dependency"		=> array(
					"element"	=> "icon_shape",
					"value"		=> array( 'rhombus', 'square', 'hexagon' )
				),
				"value"				=> array( esc_html_x( 'Sharp Corners', 'backend', 'seoes' ) => true ),
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "add_divider",
				"edit_field_class" 	=> "vc_col-xs-6",
				"value"				=> array( esc_html_x( 'Add Divider', 'backend', 'seoes' ) => true ),
			),
			array(
				"type"				=> "textarea_html",
				"heading"			=> esc_html_x( 'Content', 'backend', 'seoes' ),
				"param_name"		=> "content"
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
		"name"				=> esc_html_x( 'RB Service', 'backend', 'seoes' ),
		"base"				=> "rb_sc_service",
		"category"			=> "By RB",
		"icon" 				=> "rb_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Service extends WPBakeryShortCode {
	    }
	}
?>