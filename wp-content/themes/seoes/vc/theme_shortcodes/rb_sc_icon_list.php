<?php
	/* -----> SIDEBARS PROPERTIES <----- */
	$sidebars = get_theme_mod('theme_sidebars');
	$sb_arr = array();

	if( !empty($sidebars) ){
		foreach( $sidebars as $k => $v ){
			$sb_arr[$v] = $k;
		}
	}

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
			"heading"		=> esc_html_x( 'Alignment', 'backend', 'seoes' ),
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"param_name"	=> "alignment",
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
			"responsive"	=> "all",
			"value"			=> array( esc_html_x( 'Customize Size', 'backend', 'seoes' ) => true ),
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Icons Size', 'backend', 'seoes' ),
			"param_name"		=> "icons_size",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-4",
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "20px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Title Size', 'backend', 'seoes' ),
			"param_name"		=> "title_size",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-4",
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "16px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Spacings', 'backend', 'seoes' ),
			"param_name"		=> "spacing",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-4",
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "15px",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Icons Color', 'backend', 'seoes' ),
			"param_name"		=> "icons_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> PRIMARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Icons Color on Hover', 'backend', 'seoes' ),
			"param_name"		=> "icons_color_hover",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> SECONDARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Background Gradient 1', 'backend', 'seoes' ),
			"param_name"		=> "icon_gradient_1",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "icon_bg",
				"not_empty"	=> true
			),
			"value"				=> "rgba(255,255,255, .05)",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Background Gradient 2', 'backend', 'seoes' ),
			"param_name"		=> "icon_gradient_2",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "icon_bg",
				"not_empty"	=> true
			),
			"value"				=> "rgba(255,255,255, .05)",
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
				"heading"		=> esc_html_x( 'Direction', 'RB_VC_Button', 'seoes' ),
				"param_name"	=> "dir",
				"value"			=> array(
					esc_html_x( 'Column', 'RB_VC_Button', 'seoes' )	=> 'column',
					esc_html_x( 'Line', 'RB_VC_Button', 'seoes' )		=> 'line'
				),
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "icon_bg",
				'description' 		=> esc_html_x( 'It will be work only for "Custom URL" & "Custom Sidebar" icons', 'backend', 'seoes' ),
				"value"				=> array( esc_html_x( 'Add Icons Background', 'backend', 'seoes' ) => true ),
			),
			array(
                'type' 			=> 'param_group',
                'heading' 		=> esc_html_x( 'Menu List', 'backend', 'seoes' ),
                'param_name' 	=> 'values',
                'params' 		=> array(
					array(
						"type"				=> "dropdown",
						"heading"			=> esc_html_x( 'Function', 'backend', 'seoes' ),
						"param_name"		=> "function",
						"admin_label"		=> true,
						"value"				=> array(
							esc_html_x( "Custom URL", 'backend', 'seoes' ) 		=> 'custom',
							esc_html_x( "Woo Cart", 'backend', 'seoes' )		=> 'cart',
							esc_html_x( "WPML", 'backend', 'seoes' )			=> 'wpml',
							esc_html_x( "Search", 'backend', 'seoes' )			=> 'rb_search',
							esc_html_x( "Custom Sidebar", 'backend', 'seoes' )	=> 'sidebar',
						)		
					),
					array(
						"type"				=> "dropdown",
						"heading"			=> esc_html_x( 'Type', 'backend', 'seoes' ),
						"param_name"		=> "type",
						"dependency"		=> array(
							"element"	=> "function",
							"value"		=> "custom"
						),
						"value"				=> array(
							esc_html_x( "Simple", 'backend', 'seoes' ) 		=> 'simple',
							esc_html_x( "Phone Call", 'backend', 'seoes' )	=> 'phone',
							esc_html_x( "Send Mail", 'backend', 'seoes' )	=> 'mail',
						)
					),
					array(
						"type"				=> "textfield",
						"heading"			=> esc_html_x( 'Title', 'backend', 'seoes' ),
						"param_name"		=> "title",
						"edit_field_class" 	=> "vc_col-xs-6",
						"dependency"		=> array(
							"element"	=> "function",
							"value"		=> array("custom", "sidebar", "rb_search")
						),
						"value"				=> ""
					),
					array(
						"type"				=> "textfield",
						"heading"			=> esc_html_x( 'Url', 'backend', 'seoes' ),
						"param_name"		=> "url",
						"edit_field_class" 	=> "vc_col-xs-6",
						"dependency"		=> array(
							"element"	=> "function",
							"value"		=> "custom"
						),
						"value"				=> ""
					),
					array(
						"type"				=> "dropdown",
						"heading"			=> esc_html_x( 'Sidebar', 'backend', 'seoes' ),
						"param_name"		=> "sidebar",
						"edit_field_class" 	=> "vc_col-xs-6",
						"dependency"		=> array(
							"element"	=> "function",
							"value"		=> "sidebar"
						),
						"value"				=> $sb_arr
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> __( 'Icon library', 'seoes' ),
						'param_name'	=> 'icon_lib',
						'value'			=> array(
							__( 'Flaticon', 'seoes' ) 		=> 'flaticon',
							__( 'Font Awesome', 'seoes' ) 	=> 'fontawesome',
						),
						"dependency"	=> array(
							"element"		=> "function",
							"value"			=> array("custom", "sidebar")
						)
					),
					array(
						'type' 			=> 'iconpicker',
						'heading' 		=> __( 'Icon', 'seoes' ),
						'param_name' 	=> 'icon_rb_flaticons',
						'value' 		=> '',
						'settings' 		=> array(
							'emptyIcon' 	=> true,
							'type' 			=> 'rb_flaticons',
							'iconsPerPage' => 4000,
						),
						"dependency"	=> array(
							"element"		=> "icon_lib",
							"value"			=> "flaticon"
						)
					),
					array(
						'type' 			=> 'iconpicker',
						'heading' 		=> __( 'Icon', 'seoes' ),
						'param_name' 	=> 'icon_fontawesome',
						'value' 		=> '',
						'settings' 		=> array(
							'emptyIcon' 	=> true,
							'iconsPerPage' 	=> 4000,
						),
						'dependency' 	=> array(
							'element' 		=> 'icon_lib',
							'value' 		=> 'fontawesome',
						)
					),
                ),
                "value"			=> "",
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
		"name"				=> esc_html_x( 'RB Icon List', 'backend', 'seoes' ),
		"base"				=> "rb_sc_icon_list",
		"category"			=> "By RB",
		"icon" 				=> "rb_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Icon_List extends WPBakeryShortCode {
	    }
	}
?>