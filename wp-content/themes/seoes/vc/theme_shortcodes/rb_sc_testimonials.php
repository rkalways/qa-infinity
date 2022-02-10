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
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Background Gradient 1', 'backend', 'seoes' ),
				"param_name"		=> "background_gradient_1",
				"edit_field_class" 	=> "vc_col-xs-6",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"dependency"		=> array(
					"element"	=> "style",
					"value"		=> "with_bg"
				),
				"value"				=> "#fff",
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Background Gradient 2', 'backend', 'seoes' ),
				"param_name"		=> "background_gradient_2",
				"edit_field_class" 	=> "vc_col-xs-6",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"dependency"		=> array(
					"element"	=> "style",
					"value"		=> "with_bg"
				),
				"value"				=> "#fff",
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Hover Background Gradient 1', 'backend', 'seoes' ),
				"param_name"		=> "hover_background_gradient_1",
				"edit_field_class" 	=> "vc_col-xs-6",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"dependency"		=> array(
					"element"	=> "style",
					"value"		=> "with_bg"
				),
				"value"				=> "#FFAF00",
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Hover Background Gradient 2', 'backend', 'seoes' ),
				"param_name"		=> "hover_background_gradient_2",
				"edit_field_class" 	=> "vc_col-xs-6",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"dependency"		=> array(
					"element"	=> "style",
					"value"		=> "with_bg"
				),
				"value"				=> "#FF6849",
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Text color', 'backend', 'seoes' ),
				"param_name"		=> "text_color",
				"edit_field_class" 	=> "vc_col-xs-6",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"value"				=> "rgba(62,74,89, .8)",
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Hover Text color', 'backend', 'seoes' ),
				"param_name"		=> "text_color_hover",
				"edit_field_class" 	=> "vc_col-xs-6",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"dependency"		=> array(
					"element"	=> "style",
					"value"		=> "with_bg"
				),
				"value"				=> "#fff",
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Title color', 'backend', 'seoes' ),
				"param_name"		=> "title_color",
				"edit_field_class" 	=> "vc_col-xs-6",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"value"				=> PRIMARY_COLOR,
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Hover Title color', 'backend', 'seoes' ),
				"param_name"		=> "title_color_hover",
				"edit_field_class" 	=> "vc_col-xs-6",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"dependency"		=> array(
					"element"	=> "style",
					"value"		=> "with_bg"
				),
				"value"				=> "#fff",
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Accent color', 'backend', 'seoes' ),
				"param_name"		=> "accent_color",
				"edit_field_class" 	=> "vc_col-xs-6",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"value"				=> SECONDARY_COLOR,
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Hover Accent color', 'backend', 'seoes' ),
				"param_name"		=> "accent_color_hover",
				"edit_field_class" 	=> "vc_col-xs-6",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"dependency"		=> array(
					"element"	=> "style",
					"value"		=> "with_bg"
				),
				"value"				=> "#fff",
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Image Shadow color', 'backend', 'seoes' ),
				"param_name"		=> "image_shadow_color",
				"edit_field_class" 	=> "vc_col-xs-6",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"dependency"		=> array(
					"element"	=> "style",
					"value"		=> "with_bg"
				),
				"value"				=> "rgba(255,255,255,.35)",
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Background Shadow color', 'backend', 'seoes' ),
				"param_name"		=> "shadow_color",
				"edit_field_class" 	=> "vc_col-xs-6",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"dependency"		=> array(
					"element"	=> "style",
					"value"		=> "with_bg"
				),
				"value"				=> "rgba(85,76,181,.17)",
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Carousel Dots Color', 'backend', 'seoes' ),
				"param_name"		=> "dots_color",
				"edit_field_class" 	=> "vc_col-xs-6",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"dependency"		=> array(
					"element"	=> "carousel",
					"not_empty"	=> true
				),
				"value"				=> "#e5e5e5",
			),
			array(
				"type"				=> "colorpicker",
				"heading"			=> esc_html_x( 'Carousel Active Dot', 'backend', 'seoes' ),
				"param_name"		=> "active_dot",
				"edit_field_class" 	=> "vc_col-xs-6",
				"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
				"dependency"		=> array(
					"element"	=> "carousel",
					"not_empty"	=> true
				),
				"value"				=> SECONDARY_COLOR,
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
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Style', 'backend', 'seoes' ),
				"param_name"		=> "style",
				"value"				=> array(
					esc_html_x( 'Clear', 'backend', 'seoes' )			=> 'clear',
					esc_html_x( 'With Background', 'backend', 'seoes' )	=> 'with_bg',
				)
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Columns', 'backend', 'seoes' ),
				"param_name"		=> "columns",
				"value"				=> array(
					esc_html_x( 'One', 'backend', 'seoes' )			=> '1',
					esc_html_x( 'Two', 'backend', 'seoes' )			=> '2',
					esc_html_x( 'Three', 'backend', 'seoes' )		=> '3',
					esc_html_x( 'Four', 'backend', 'seoes' )		=> '4',
				)
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "carousel",
				"value"				=> array( esc_html_x( 'Carousel', 'backend', 'seoes' ) => true ),
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "autoplay",
				"dependency"		=> array(
					"element"	=> "carousel",
					"not_empty"	=> true
				),
				"value"				=> array( esc_html_x( 'Autoplay', 'backend', 'seoes' ) => true ),
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Slides to Scroll', 'backend', 'seoes' ),
				"param_name"		=> "slides_to_scroll",
				"edit_field_class" 	=> "vc_col-xs-6",
				"dependency"		=> array(
					"element"	=> "carousel",
					"not_empty"	=> true
				),
				"value"				=> array(
					esc_html_x( 'One', 'backend', 'seoes' )			=> '1',
					esc_html_x( 'Two', 'backend', 'seoes' )			=> '2',
					esc_html_x( 'Three', 'backend', 'seoes' )		=> '3',
					esc_html_x( 'Four', 'backend', 'seoes' )		=> '4',
				)
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Autoplay Speed', 'backend', 'seoes' ),
				"param_name"		=> "autoplay_speed",
				"edit_field_class" 	=> "vc_col-xs-6",
				"dependency"		=> array(
					"element"	=> "carousel",
					"not_empty"	=> true
				),
				"value"				=> "3000"
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Content Position', 'backend', 'seoes' ),
				"param_name"		=> "content_pos",
				"value"				=> array(
					esc_html_x( 'Bottom', 'backend', 'seoes' )		=> 'bottom',
					esc_html_x( 'Top', 'backend', 'seoes' )			=> 'top',
				)
			),
			array(
                'type' 			=> 'param_group',
                'heading' 		=> esc_html_x( 'Testimonials', 'backend', 'seoes' ),
                'param_name' 	=> 'values',
                'params' 		=> array(
                	array(
						"type"				=> "attach_image",
						"heading"			=> esc_html_x( 'Image', 'RB_VC_Image', 'seoes' ),
						"param_name"		=> "image",
					),
					array(
						"type"				=> "dropdown",
						"heading"			=> esc_html_x( 'Image Shape', 'backend', 'seoes' ),
						"param_name"		=> "shape",
						"value"				=> array(
							esc_html_x( 'Round', 'backend', 'seoes' )		=> 'round',
							esc_html_x( 'Square', 'backend', 'seoes' )		=> 'square',
							esc_html_x( 'Rhombus', 'backend', 'seoes' )		=> 'rhombus',
							esc_html_x( 'Hexagon', 'backend', 'seoes' )		=> 'hexagon',
						)
					),
                	array(
						"type"				=> "textfield",
						"admin_label"		=> true,
						"heading"			=> esc_html_x( 'Name', 'backend', 'seoes' ),
						"param_name"		=> "name",
						"edit_field_class" 	=> "vc_col-xs-6",
						"value"				=> ""
					),
					array(
						"type"				=> "textfield",
						"admin_label"		=> true,
						"heading"			=> esc_html_x( 'Position', 'backend', 'seoes' ),
						"param_name"		=> "position",
						"edit_field_class" 	=> "vc_col-xs-6",
						"value"				=> ""
					),
					array(
						"type"				=> "checkbox",
						"param_name"		=> "phone",
						"value"				=> array( esc_html_x( 'Add Phone Icon', 'backend', 'seoes' ) => true ),
					),
					array(
						"type"				=> "textarea",
						"heading"			=> esc_html_x( 'Content', 'backend', 'seoes' ),
						"param_name"		=> "description",
						"value"				=> ""
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
		"name"				=> esc_html_x( 'RB Testimonials', 'backend', 'seoes' ),
		"base"				=> "rb_sc_testimonials",
		"category"			=> "By RB",
		"icon" 				=> "rb_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Testimonials extends WPBakeryShortCode {
	    }
	}
?>