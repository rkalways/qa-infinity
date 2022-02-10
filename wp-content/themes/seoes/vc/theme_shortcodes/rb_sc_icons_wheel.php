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
			"param_name"	=> "customize_size",
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"	=> "all",
			"value"			=> array( esc_html_x( 'Customize Size', 'backend', 'seoes' ) => true ),
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Shape Size', 'backend', 'seoes' ),
			"param_name"		=> "shape_size",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "160px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Icons Size', 'backend', 'seoes' ),
			"param_name"		=> "icons_size",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "54px",
		),
        array(
			"type"				=> "checkbox",
			"param_name"		=> "custom_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"value"				=> array( esc_html_x( 'Custom Colors', 'backend', 'seoes' ) => true ),
			"std"				=> "1"
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Icon Gradient 1', 'backend', 'seoes' ),
			"param_name"		=> "icon_gradient_1",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "custom_color",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#ffaf00"
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Icon Gradient 2', 'backend', 'seoes' ),
			"param_name"		=> "icon_gradient_2",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "custom_color",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#ff6849"
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Active Icon Gradient 1', 'backend', 'seoes' ),
			"param_name"		=> "active_icon_gradient_1",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "custom_color",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#fff"
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Active Icon Gradient 2', 'backend', 'seoes' ),
			"param_name"		=> "active_icon_gradient_2",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "custom_color",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#fff"
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Active Icon Shape Gradient_2', 'backend', 'seoes' ),
			"param_name"		=> "active_shape_gradient_1",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "custom_color",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#ffaf00"
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Active Icon Shape Gradient 2', 'backend', 'seoes' ),
			"param_name"		=> "active_shape_gradient_2",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "custom_color",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#ff6849"
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Icon Shape Background', 'backend', 'seoes' ),
			"param_name"		=> "icon_shape_bg",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "custom_color",
				"not_empty"	=> true
			),
			"value"				=> "#fff"
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Subtitle Color', 'backend', 'seoes' ),
			"param_name"		=> "subtitle_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "custom_color",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> SECONDARY_COLOR
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Title Color', 'backend', 'seoes' ),
			"param_name"		=> "title_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "custom_color",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> PRIMARY_COLOR
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Text Color', 'backend', 'seoes' ),
			"param_name"		=> "text_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "custom_color",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> rb_Hex2RGBA( PRIMARY_COLOR, '0.8' )
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Circle Color', 'backend', 'seoes' ),
			"param_name"		=> "circle_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "custom_color",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#D6D6DB"
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Shadow Color', 'backend', 'seoes' ),
			"param_name"		=> "shadow_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"dependency"		=> array(
				"element"	=> "custom_color",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#e3e3f0"
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
				"heading"		=> esc_html_x( 'Style', 'backend', 'seoes' ),
				"param_name"	=> "style",
				"value"			=> array(
					'Round' 		=> 'round',
					'Square'		=> 'square',
					'Rhombus' 		=> 'rhombus',
					'Hexagon' 		=> 'hexagon',
				)
			),
			array(
                'type' 			=> 'param_group',
                'heading' 		=> esc_html_x( 'Values', 'backend', 'seoes' ),
                'param_name' 	=> 'values',
                'description' 	=> 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.',
                'params' => array(
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html_x( 'Icon library', 'backend', 'seoes' ),
						"param_name"	=> "icon_lib",
						"description"	=> esc_html_x( 'Select icon library', 'backend', 'seoes' ),
						"value"			=> array(
							'Font Awesome' 	=> 'fontawesome',
							'Open Iconic'	=> 'openiconic',
							'Typicons' 		=> 'typicons',
							'Entypo' 		=> 'entypo',
							'Linecons' 		=> 'linecons',
							'Mono Social' 	=> 'monosocial',
							'RB Flaticons' => 'rb_flaticons'
						)
					),
					array(
						"type"			=> "iconpicker",
						"heading"		=> esc_html_x( 'Icon', 'backend', 'seoes' ),
						"param_name"	=> 'icon_fontawesome',
						"value"			=> '',
						"settings"		=> array(
							'emptyIcon'		=> true,
							'iconsPerPage'	=> 4000
						),
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'fontawesome'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'seoes' ),
					),
					array(
						"type"			=> "iconpicker",
						"heading"		=> esc_html_x( 'Icon', 'backend', 'seoes' ),
						"param_name"	=> 'icon_openiconic',
						"value"			=> '',
						"settings"		=> array(
							'emptyIcon'		=> true,
							'type'			=> 'openiconic',
							'iconsPerPage'	=> 4000
						),
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'openiconic'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'seoes' ),
					),
					array(
						"type"			=> "iconpicker",
						"heading"		=> esc_html_x( 'Icon', 'backend', 'seoes' ),
						"param_name"	=> 'icon_typicons',
						"value"			=> '',
						"settings"		=> array(
							'emptyIcon'		=> true,
							'type'			=> 'typicons',
							'iconsPerPage'	=> 4000
						),
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'typicons'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'seoes' ),
					),
					array(
						"type"			=> "iconpicker",
						"heading"		=> esc_html_x( 'Icon', 'backend', 'seoes' ),
						"param_name"	=> 'icon_entypo',
						"value"			=> '',
						"settings"		=> array(
							'emptyIcon'		=> true,
							'type'			=> 'entypo',
							'iconsPerPage'	=> 4000
						),
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'entypo'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'seoes' ),
					),
					array(
						"type"			=> "iconpicker",
						"heading"		=> esc_html_x( 'Icon', 'backend', 'seoes' ),
						"param_name"	=> 'icon_linecons',
						"value"			=> '',
						"settings"		=> array(
							'emptyIcon'		=> true,
							'type'			=> 'linecons',
							'iconsPerPage'	=> 4000
						),
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'linecons'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'seoes' ),
					),
					array(
						"type"			=> "iconpicker",
						"heading"		=> esc_html_x( 'Icon', 'backend', 'seoes' ),
						"param_name"	=> 'icon_monosocial',
						"value"			=> '',
						"settings"		=> array(
							'emptyIcon'		=> true,
							'type'			=> 'monosocial',
							'iconsPerPage'	=> 4000
						),
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'monosocial'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'seoes' ),
					),
					array(
						"type"			=> "iconpicker",
						"heading"		=> esc_html_x( 'Icon', 'backend', 'seoes' ),
						"param_name"	=> 'icon_rb_flaticons',
						"value"			=> '',
						"settings"		=> array(
							'emptyIcon'		=> true,
							'type'			=> 'rb_flaticons',
							'iconsPerPage'	=> 4000
						),
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'rb_flaticons'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'seoes' ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html_x( 'Subtitle', 'backend', 'seoes' ),
						"param_name"	=> "subtitle",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html_x( 'Title', 'backend', 'seoes' ),
						"param_name"	=> "title",
                        'admin_label' 	=> true,
					),
					array(
						"type"			=> "textarea",
						"heading"		=> esc_html_x( 'Description', 'backend', 'seoes' ),
						"param_name"	=> "description",
					),
                ),
				'value' 		=> array(),
            ),
			array(
                "type"          => "checkbox",
                "param_name"    => "hover_trigger",
                "value"         => array( esc_html_x( 'Trigger on hover', 'backend', 'seoes' ) => true ),
            ),
            array(
                "type"          => "checkbox",
                "param_name"    => "sharp_corners",
                "value"         => array( esc_html_x( 'Sharp Corners', 'backend', 'seoes' ) => true ),
            ),
            array(
                "type"          => "checkbox",
                "param_name"    => "autoplay",
                "value"         => array( esc_html_x( 'Autoplay', 'backend', 'seoes' ) => true ),
            ),
			array(
				"type"			=> "textfield",
				"heading"		=> esc_html_x( 'Autoplay Speed', 'backend', 'seoes' ),
				"param_name"	=> "autoplay_speed",
                "dependency"	=> array(
					"element"	=> "autoplay",
					"not_empty"	=> true
				),
				"value" 		=> "3000"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Extra class name', 'backend', 'seoes' ),
				"description"		=> esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'backend', 'seoes' ),
				"param_name"		=> "el_class",
				"value"				=> ""
			)
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
		"name"				=> esc_html_x( 'RB Icons Wheel', 'backend', 'seoes' ),
		"base"				=> "rb_sc_icons_wheel",
		'category'			=> "By RB",
		"icon"     			=> "rb_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Icons_Wheel extends WPBakeryShortCode {
	    }
	}
?>