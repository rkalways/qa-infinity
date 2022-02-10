<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = rb_ext_merge_arrs( array(
		array(
			array(
				"type"			=> "css_editor",
				"param_name"	=> "custom_styles",
				"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"responsive"	=> 'all'
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Image Hover Effect', 'backend', 'seoes' ),
				"param_name"		=> "bg_hover",
				"value"				=> array(
					esc_html_x( 'No Hover', 'backend', 'seoes' )		=> 'no_hover',
					esc_html_x( '3D', 'backend', 'seoes' )				=> '3d',
					esc_html_x( 'Flip', 'backend', 'seoes' )			=> 'flip',
					esc_html_x( 'Falling Down', 'backend', 'seoes' )	=> 'fall',
					esc_html_x( 'Grayscale', 'backend', 'seoes' )		=> 'grayscale',
				),
				"std"				=> 'no_hover'
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Sensivity', "backend", 'seoes' ),
				"param_name"		=> "max_tilt",
				"group"				=> esc_html_x( "Styling", "backend", 'seoes' ),
				"edit_field_class" 	=> "vc_col-xs-6",
				"dependency"		=> array(
					"element"	=> "bg_hover",
					"value"		=> array('3d'),
				),
				"value"				=> "10"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Perspective', "backend", 'seoes' ),
				"param_name"		=> "perspective",
				"group"				=> esc_html_x( "Styling", "backend", 'seoes' ),
				"edit_field_class" 	=> "vc_col-xs-6",
				"dependency"		=> array(
					"element"	=> "bg_hover",
					"value"		=> array('3d'),
				),
				"value"				=> "1000"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Scale', "backend", 'seoes' ),
				"param_name"		=> "scale",
				"group"				=> esc_html_x( "Styling", "backend", 'seoes' ),
				"edit_field_class" 	=> "vc_col-xs-6",
				"dependency"		=> array(
					"element"	=> "bg_hover",
					"value"		=> array('3d'),
				),
				"value"				=> "1"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Speed', "backend", 'seoes' ),
				"description"		=> esc_html_x( 'Speed of the enter/exit transition', "backend", 'seoes' ),
				"param_name"		=> "speed",
				"group"				=> esc_html_x( "Styling", "backend", 'seoes' ),
				"edit_field_class" 	=> "vc_col-xs-6",
				"dependency"		=> array(
					"element"	=> "bg_hover",
					"value"		=> array('3d'),
				),
				"value"				=> "300"
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
				"std"			=> 'center',
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
				"type"				=> "attach_image",
				"heading"			=> esc_html_x( 'Image', 'backend', 'seoes' ),
				"param_name"		=> "image",
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
		"name"				=> esc_html_x( 'RB Image', 'backend', 'seoes' ),
		"base"				=> "rb_sc_image",
		"category"			=> "By RB",
		"icon" 				=> "rb_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Image extends WPBakeryShortCode {
	    }
	}
?>