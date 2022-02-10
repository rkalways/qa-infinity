<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$params = rb_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Style', 'backend', 'seoes' ),
				"param_name"		=> "style",
				"value"				=> array(
					esc_html_x( 'Info', 'backend', 'seoes' )		=> 'info',
					esc_html_x( 'Success', 'backend', 'seoes' )		=> 'success',
					esc_html_x( 'Warning', 'backend', 'seoes' )		=> 'warning',
					esc_html_x( 'Error', 'backend', 'seoes' )		=> 'error',
				),
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Title', 'backend', 'seoes' ),
				"param_name"		=> "title",
			),
			array(
				"type"				=> "textarea",
				"heading"			=> esc_html_x( 'Description', 'backend', 'seoes' ),
				"param_name"		=> "description",
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "closable",
				"value"				=> array( esc_html_x( 'Closable', 'backend', 'seoes' ) => true ),
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Extra class name', 'backend', 'seoes' ),
				"description"		=> esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'backend', 'seoes' ),
				"param_name"		=> "el_class",
				"value"				=> ""
			),
		),
	));

	/* -----> MODULE DECLARATION <----- */
	vc_map( array(
		"name"				=> esc_html_x( 'RB Info Box', 'backend', 'seoes' ),
		"base"				=> "rb_sc_info_box",
		'category'			=> "By RB",
		"icon"     			=> "rb_icon",		
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Info_Box extends WPBakeryShortCode {
	    }
	}
?>