<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$background_properties = rb_module_background_props();

	$styles = rb_ext_merge_arrs( array(
		array(
			array(
				"type"			=> "css_editor",
				"param_name"	=> "custom_styles",
				"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"responsive"	=> 'all'
			)
		),
		$background_properties,
		array(
			array(
				"type"			=> "checkbox",
				"param_name"	=> "customize_colors",
				"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"value"			=> array( esc_html_x( 'Customize Colors', 'backend', 'seoes' ) => true ),
				"std"			=> '1'
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Text color', 'backend', 'seoes' ),
				"param_name"		=> "text_color",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"dependency"		=> array(
					"element"	=> "customize_colors",
					"not_empty"	=> true
				),
				"value"				=> "#fff",
			),
			array(
				"type"			=> "checkbox",
				"param_name"	=> "customize_size",
				"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"responsive"	=> "all",
				"value"			=> array( esc_html_x( 'Customize Sizes', 'backend', 'seoes' ) => true ),
			),
			array(
				"type"			=> "dropdown",
				"heading"		=> esc_html_x( 'Button Size', 'backend', 'seoes' ),
				"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"param_name"	=> "button_size",
				"dependency"	=> array(
					"element"		=> "customize_size",
					"not_empty"		=> true
				),
				"value"			=> array(
					esc_html_x( "Small", 'backend', 'seoes' ) 	=> 'small',
					esc_html_x( "Medium", 'backend', 'seoes' ) 	=> 'medium',
					esc_html_x( "Large", 'backend', 'seoes' ) 	=> 'large',
				),
				"std"			=> "medium"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Title Size', 'backend', 'seoes' ),
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"param_name"		=> "title_size",
				"edit_field_class" 	=> "vc_col-xs-6",
				"responsive"		=> "all",
				"dependency"		=> array(
					"element"	=> "customize_size",
					"not_empty"	=> true
				),
				"value"				=> "25px"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Title Line-Height', 'backend', 'seoes' ),
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"param_name"		=> "title_lh",
				"edit_field_class" 	=> "vc_col-xs-6",
				"responsive"		=> "all",
				"dependency"		=> array(
					"element"	=> "customize_size",
					"not_empty"	=> true
				),
				"value"				=> "35px"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Description Size', 'backend', 'seoes' ),
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"param_name"		=> "desc_size",
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
				"heading"			=> esc_html_x( 'Description Line-Height', 'backend', 'seoes' ),
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"param_name"		=> "desc_lh",
				"edit_field_class" 	=> "vc_col-xs-6",
				"responsive"		=> "all",
				"dependency"		=> array(
					"element"	=> "customize_size",
					"not_empty"	=> true
				),
				"value"				=> "30px"
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
					esc_html_x( "Left", 'backend', 'seoes' ) 	=> 'left',
					esc_html_x( "Center", 'backend', 'seoes' ) 	=> 'center',
					esc_html_x( "Right", 'backend', 'seoes' ) 	=> 'right',
				),
			),
		)
	));

	/* -----> RESPONSIVE STYLING TABS PROPERTIES <----- */
	$styles_landscape = $styles_portrait = $styles_mobile = $styles;

	$styles_landscape = rb_responsive_styles($styles_landscape, 'landscape', rb_landscape_group_name());
	$styles_portrait = rb_responsive_styles($styles_portrait, 'portrait', rb_tablet_group_name());
	$styles_mobile = rb_responsive_styles($styles_mobile, 'mobile', rb_mobile_group_name());

	$params = rb_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"				=> "textarea",
				"admin_label"		=> true,
				"heading"			=> esc_html_x( 'Title', 'backend', 'seoes' ),
				"param_name"		=> "title",
				"value"				=> ""
			),
			array(
				"type"				=> "textarea",
				"admin_label"		=> true,
				"heading"			=> esc_html_x( 'Description', 'backend', 'seoes' ),
				"param_name"		=> "description",
				"value"				=> ""
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Button Title', 'backend', 'seoes' ),
				"param_name"		=> "button_title",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> ""
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Banner Url', 'backend', 'seoes' ),
				"param_name"		=> "banner_url",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> "#"
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Button Position', 'backend', 'seoes' ),
				"param_name"		=> "button_pos",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> array(
					esc_html_x( 'Default', 'backend', 'seoes' )		=> 'default',
					esc_html_x( 'Floated', 'backend', 'seoes' )		=> 'floated',
				)
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "new_tab",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> array( esc_html_x( 'Open Link in New Tab', 'backend', 'seoes' ) => true ),
				"std"				=> '1'
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
		"name"				=> esc_html_x( 'RB Banner', 'backend', 'seoes' ),
		"base"				=> "rb_sc_banners",
		"category"			=> "By RB",
		"icon" 				=> "rb_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Banners extends WPBakeryShortCode {
	    }
	}
?>