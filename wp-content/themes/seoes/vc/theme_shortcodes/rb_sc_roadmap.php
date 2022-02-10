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
			"value"				=> "300px",
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
			"value"				=> "194px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Title Size', 'backend', 'seoes' ),
			"param_name"		=> "title_size",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "40px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Title Margins', 'backend', 'seoes' ),
			"param_name"		=> "title_margins",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "0 0 13px 0px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Number Size', 'backend', 'seoes' ),
			"param_name"		=> "number_size",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "100px",
		),
        array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Text Size', 'backend', 'seoes' ),
			"param_name"		=> "text_size",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "17px",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Shape Background', 'backend', 'seoes' ),
			"param_name"		=> "shape_bg",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#fff",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Number_color', 'backend', 'seoes' ),
			"param_name"		=> "number_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#FF497C",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Title Color', 'backend', 'seoes' ),
			"param_name"		=> "title_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#fff",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Text Color', 'backend', 'seoes' ),
			"param_name"		=> "text_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "rgba(255,255,255,.8)",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Line Color', 'backend', 'seoes' ),
			"param_name"		=> "line_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#8E90A0",
		)
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
							'RB Flaticons' => 'rb_flaticons',
							'RB SVG' 		=> 'rb_svg'
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
						"type"			=> "rb_svg",
						"heading"		=> esc_html_x( 'SVG Icon', 'backend', 'seoes' ),
						"param_name"	=> 'icon_rb_svg',
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'rb_svg'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'seoes' ),
					),
					array(
						"type"				=> "textfield",
						"heading"			=> esc_html_x( 'Number', 'backend', 'seoes' ),
						"param_name"		=> "number",
						"edit_field_class" 	=> "vc_col-xs-3",
					),
					array(
						"type"				=> "textfield",
						"heading"			=> esc_html_x( 'Title', 'backend', 'seoes' ),
						"param_name"		=> "title",
						"edit_field_class" 	=> "vc_col-xs-9",
                        'admin_label' 		=> true,
					),
					array(
						"type"				=> "textarea",
						"heading"			=> esc_html_x( 'Description', 'backend', 'seoes' ),
						"param_name"		=> "description",
					),
                ),
				'value' 		=> array(),
            ),
			array(
                "type"          => "checkbox",
                "param_name"    => "sharp_corners",
                "value"         => array( esc_html_x( 'Sharp Corners', 'backend', 'seoes' ) => true ),
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
		"name"				=> esc_html_x( 'RB Roadmap', 'backend', 'seoes' ),
		"base"				=> "rb_sc_roadmap",
		'category'			=> "By RB",
		"icon"     			=> "rb_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Roadmap extends WPBakeryShortCode {
	    }
	}
?>