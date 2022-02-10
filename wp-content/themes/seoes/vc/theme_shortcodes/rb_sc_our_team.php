<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles",
			"group"			=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"responsive"	=> "all",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Titles Color', 'backend', 'seoes' ),
			"param_name"		=> "titles_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> PRIMARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Links Color', 'backend', 'seoes' ),
			"param_name"		=> "links_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> SECONDARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Text Color', 'backend', 'seoes' ),
			"param_name"		=> "text_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> rb_Hex2RGBA( PRIMARY_COLOR, '0.8' ),
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Border Color', 'backend', 'seoes' ),
			"param_name"		=> "border_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#e5e5e5",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Socials Color', 'backend', 'seoes' ),
			"param_name"		=> "socials_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> PRIMARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Socials Hover Color', 'backend', 'seoes' ),
			"param_name"		=> "socials_hover_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> SECONDARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Background Color', 'backend', 'seoes' ),
			"param_name"		=> "background_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#fff",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Shadow Color', 'backend', 'seoes' ),
			"param_name"		=> "shadow_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "rgba(16, 1, 148, 0.18)",
		),
	);

	/* -----> GET TAXONOMIES <----- */
	$post_type = "rb_staff";
	$taxonomies = $titles_arr = array();
	$taxes = get_object_taxonomies ( 'rb_staff', 'object' );
	$avail_taxes = array(
		esc_html_x( 'None', 'backend', 'seoes' )	=> '',
		esc_html_x( 'Titles', 'backend', 'seoes' )	=> 'title',
	);

	$staff_hide_meta = get_theme_mod('rb_staff_hide_meta') ? get_theme_mod('rb_staff_hide_meta') : array();

	foreach( $taxes as $tax => $tax_obj ){
		$tax_name = isset( $tax_obj->labels->name ) && !empty( $tax_obj->labels->name ) ? $tax_obj->labels->name : $tax;
		$avail_taxes[$tax_name] = $tax;
	}
	array_push( $taxonomies, array(
		"type"			=> "dropdown",
		"heading"		=> esc_html__( 'Filter by', 'seoes' ),
		"param_name"	=> "tax",
		"value"			=> $avail_taxes
	));
	foreach ( $avail_taxes as $tax_name => $tax ) {
		if ($tax == 'title'){
			global $wpdb;

			$results = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type LIKE %s and post_status = 'publish'", $post_type ) );

		    foreach( $results as $index => $post ) {
		    	$post_title = $post->post_title;
		        $titles_arr[$post_title] = $post->ID;
		    }
			array_push( $taxonomies, array(
				"type"				=> "rb_dropdown",
				"multiple"			=> "true",
				"heading"			=> esc_html_x( 'Titles', 'backend', 'seoes' ),
				"param_name"		=> "titles",
				'edit_field_class'	=> 'inside-box vc_col-xs-12',
				"dependency"		=> array(
					"element"	=> "tax",
					"value"		=> 'title'
				),
				"value"				=> $titles_arr
			));		
		} else {
			$terms = get_terms( $tax );
			$avail_terms = array(
				''				=> ''
			);
			if ( !is_a( $terms, 'WP_Error' ) ){
				foreach ( $terms as $term ) {
					$avail_terms[$term->name] = $term->slug;
				}
			}
			array_push( $taxonomies, array(
				"type"			=> "rb_dropdown",
				"multiple"		=> "true",
				"heading"		=> $tax_name,
				"param_name"	=> "{$tax}_terms",
				"dependency"	=> array(
					"element"	=> "tax",
					"value"		=> $tax
				),
				"value"			=> $avail_terms
			));				
		}
	}

	$params = rb_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Type', 'backend', 'seoes' ),
				"description"		=> esc_html_x( 'Animated Background mode: best to use square photos and social icons should be present. ', 'backend', 'seoes' ),
				"param_name"		=> "style",
				"value"				=> array(
					esc_html_x( 'Simple', 'backend', 'seoes' )				=> 'simple',
					esc_html_x( 'Animated Background', 'backend', 'seoes' )	=> 'advanced',
				),
				'std'				=> get_theme_mod('rb_staff_style')
			)
		),
		$taxonomies,
		array(
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Order By', 'backend', 'seoes' ),
				"param_name"		=> "orderby",
				"value"				=> array(
					esc_html_x( 'Date', 'backend', 'seoes' )		=> 'date',
					esc_html_x( 'Order ID', 'backend', 'seoes' )	=> 'menu_order',
					esc_html_x( 'Title', 'backend', 'seoes' )		=> 'title',
				),
				'std'				=> get_theme_mod('rb_staff_order_by')
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Order', 'backend', 'seoes' ),
				"param_name"		=> "order",
				"value"				=> array(
					esc_html_x( 'ASC', 'backend', 'seoes' )		=> 'ASC',
					esc_html_x( 'DESC', 'backend', 'seoes' )	=> 'DESC',
				),
				'std'				=> get_theme_mod('rb_staff_order')
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Columns', 'backend', 'seoes' ),
				"param_name"		=> "columns",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> array(
					esc_html_x( '2', 'backend', 'seoes' )		=> '2',
					esc_html_x( '3', 'backend', 'seoes' )		=> '3',
					esc_html_x( '4', 'backend', 'seoes' )		=> '4',
				),
				"std"				=> get_theme_mod('rb_staff_columns')
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Items to Show', 'backend', 'seoes' ),
				"description"		=> esc_html_x( 'Enter "-1" to show all posts', 'backend', 'seoes' ),
				"param_name"		=> "total_items_count",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> "-1"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Items per Page', 'backend', 'seoes' ),
				"param_name"		=> "items_pp",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> get_theme_mod('rb_staff_items_pp'),
			),
			array(
				'type'				=> 'dropdown',
				'heading'			=> esc_html_x( 'Max Thumbnail Size', 'backend', 'seoes' ),
				'param_name'		=> 'thumb_size',
				'value'				=> array(
					esc_html_x( 'Full', 'backend', 'seoes' )		=> 'full',
					esc_html_x( 'Large', 'backend', 'seoes' )		=> 'large',
					esc_html_x( 'Medium', 'backend', 'seoes' )		=> 'medium',
					esc_html_x( 'Thumbnail', 'backend', 'seoes' )	=> 'thumbnail',
				)
			),
			array(
				'type'				=> 'checkbox',
				'param_name'		=> 'carousel',
				'value'				=> array(
					esc_html_x( 'Carousel', 'backend', 'seoes' ) => true
				)
			),
			array(
				'type'				=> 'checkbox',
				'param_name'		=> 'hide_meta',
				'value'				=> array(
					esc_html_x( 'Hide Meta Data', 'backend', 'seoes' ) => true
				)
			),
			array(
				'type'			=> 'rb_dropdown',
				'multiple'		=> "true",
				'heading'		=> esc_html_x( 'Hide', 'backend', 'seoes' ),
				'param_name'	=> 'team_hide_meta',
				'dependency'	=> array(
					'element'	=> 'hide_meta',
					'not_empty'	=> true
				),
				'value'			=> array(
					esc_html_x( 'None', 'backend', 'seoes' )					=> '',
					esc_html_x( 'Photo', 'backend', 'seoes' )					=> 'photo',
					esc_html_x( 'Name', 'backend', 'seoes' )					=> 'name',
					esc_html_x( 'Position', 'backend', 'seoes' )				=> 'position',
					esc_html_x( 'Department', 'backend', 'seoes' )				=> 'department',
					esc_html_x( 'Experience', 'backend', 'seoes' )				=> 'experience',
					esc_html_x( 'Email', 'backend', 'seoes' )					=> 'email',
					esc_html_x( 'Phone Number', 'backend', 'seoes' )			=> 'phone',
					esc_html_x( 'Socials', 'backend', 'seoes' )					=> 'socials',
					esc_html_x( 'Biography', 'backend', 'seoes' )				=> 'biography',
					esc_html_x( 'Personal Info', 'backend', 'seoes' )			=> 'info',
				),
				'std'			=> implode(',', $staff_hide_meta)
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
		"name"				=> esc_html_x( 'RB Our Team', 'backend', 'seoes' ),
		"base"				=> "rb_sc_our_team",
		"category"			=> "By RB",
		"icon" 				=> "rb_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Our_Team extends WPBakeryShortCode {
	    }
	}
?>