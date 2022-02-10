<?php
	/* -----> ICONS PROPERTIES <----- */
	$icons = rb_ext_icon_vc_sc_config_params();

	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles",
			"group"			=> esc_html_x( "Styling", 'RB_VC_Icon', 'seoes' ),
			"responsive"	=> 'all'
		)
	);

	/* -----> RESPONSIVE STYLING TABS PROPERTIES <----- */
	$styles_landscape = $styles_portrait = $styles_mobile = $styles;

	$styles_landscape = rb_responsive_styles($styles_landscape, 'landscape', rb_landscape_group_name());
	$styles_portrait = rb_responsive_styles($styles_portrait, 'portrait', rb_tablet_group_name());
	$styles_mobile = rb_responsive_styles($styles_mobile, 'mobile', rb_mobile_group_name());

	$params = rb_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		$icons,
		array(
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Font Size', 'RB_VC_Icon', 'seoes' ),
				"edit_field_class" 	=> "vc_col-xs-4",
				"param_name"		=> "fsize",
				"value"				=> "20px"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Link', 'RB_VC_Icon','seoes' ),
				"edit_field_class" 	=> "vc_col-xs-4",
				"param_name"		=> "url",
				"value"				=> "#"
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Color', 'RB_VC_Icon','seoes' ),
				"param_name"		=> "color",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> PRIMARY_COLOR
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Extra class name', 'RB_VC_Icon', 'seoes' ),
				"description"		=> esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'RB_VC_Icon', 'seoes' ),
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
		"name"				=> esc_html_x( 'RB Icon', 'RB_VC_Icon', 'seoes' ),
		"base"				=> "rb_sc_icon",
		"category"			=> "By RB",
		"icon" 				=> "rb_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Icon extends WPBakeryShortCode {
	    }
	}
?>