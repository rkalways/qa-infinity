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
			"heading"			=> esc_html_x( 'Title Color', 'backend', 'seoes' ),
			"param_name"		=> "title_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#fff",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Meta Color', 'backend', 'seoes' ),
			"param_name"		=> "meta_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'seoes' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> 'rgba(255,255,255, .8)',
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Divider Color', 'backend', 'seoes' ),
			"param_name"		=> "divider_color",
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
			"value"				=> 'rgba(0,0,0, .8)',
		),
	);

	/* -----> GET TAXONOMIES <----- */
	$post_type = "rb_portfolio";
	$taxonomies = $titles_arr = array();
	$taxes = get_object_taxonomies ( 'rb_portfolio', 'object' );
	$avail_taxes = array(
		esc_html_x( 'None', 'backend', 'seoes' )	=> '',
		esc_html_x( 'Titles', 'backend', 'seoes' )	=> 'title',
	);
	$portfolio_hide_meta = get_theme_mod('rb_portfolio_hide_meta') ? get_theme_mod('rb_portfolio_hide_meta') : array();

	foreach( $taxes as $tax => $tax_obj ){
		$tax_name = isset( $tax_obj->labels->name ) && !empty( $tax_obj->labels->name ) ? $tax_obj->labels->name : $tax;
		$avail_taxes[$tax_name] = $tax;
	}
	array_push( $taxonomies, array(
		"type"			=> "dropdown",
		"heading"		=> esc_html__( 'Filter by', 'seoes' ),
		"param_name"	=> "tax",
		"description"	=> esc_html_x( 'Filter by titles is not applicable when Motion Category Layout used.', 'backend', 'seoes' ),
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
				"heading"			=> esc_html_x( 'Layout', 'backend', 'seoes' ),
				"param_name"		=> "layout",
				"value"				=> array(
					esc_html_x( 'Grid', 'backend', 'seoes' )					=> 'grid',
					esc_html_x( 'Grid with Filter', 'backend', 'seoes' )		=> 'grid_filter',
					esc_html_x( 'Masonry', 'backend', 'seoes' )					=> 'masonry',
					esc_html_x( 'Pinterest', 'backend', 'seoes' )				=> 'pinterest',
					esc_html_x( 'Asymmetric', 'backend', 'seoes' )				=> 'asymmetric',
					esc_html_x( 'Carousel', 'backend', 'seoes' )				=> 'carousel',
					esc_html_x( 'Carousel Wide', 'backend', 'seoes' )			=> 'carousel_wide',
					esc_html_x( 'Motion Category', 'backend', 'seoes' )			=> 'motion_category',
				),
				"std"				=> get_theme_mod('rb_portfolio_layout')
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Hover', 'backend', 'seoes' ),
				"param_name"		=> "hover",
				"value"				=> array(
					esc_html_x( 'Overlay', 'backend', 'seoes' )					=> 'overlay',
					esc_html_x( 'Slide From Bottom', 'backend', 'seoes' )		=> 'slide_bottom',
					esc_html_x( 'Slide From Left', 'backend', 'seoes' )			=> 'slide_left',
					esc_html_x( 'Swipe Right', 'backend', 'seoes' )				=> 'swipe_right',
				),
				'dependency'	=> array(
					'element'		=> 'layout',
					'value'			=> array( "grid", "grid_filter", "masonry", "pinterest", "asymmetric", "carousel", "motion_category" )
				),
				"std"			=> get_theme_mod('rb_portfolio_hover')
			),
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
				'std'				=> get_theme_mod('rb_portfolio_orderby')
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Order', 'backend', 'seoes' ),
				"param_name"		=> "order",
				"value"				=> array(
					esc_html_x( 'ASC', 'backend', 'seoes' )		=> 'ASC',
					esc_html_x( 'DESC', 'backend', 'seoes' )	=> 'DESC',
				),
				'std'				=> get_theme_mod('rb_portfolio_order')
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
					esc_html_x( '5', 'backend', 'seoes' )		=> '5',
					esc_html_x( '6', 'backend', 'seoes' )		=> '6',
				),
				'dependency'	=> array(
					'element'	=> 'layout',
					'value'		=> array( "grid", "grid_filter", "masonry", "pinterest", "carousel" )
				),
				"std"				=> get_theme_mod('rb_portfolio_columns')
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
				"value"				=> "-1",
				'dependency'		=> array(
					'element'	=> 'layout',
					'value'		=> array( "grid", "grid_filter", "masonry", "pinterest", "asymmetric" )
				),
				"std"				=> get_theme_mod('rb_portfolio_items_pp')
			),
			array(
				'type'				=> 'checkbox',
				'param_name'		=> 'square_img',
				'value'				=> array(
					esc_html_x( 'Square Images', 'backend', 'seoes' ) => true
				),
				'std'				=> get_theme_mod('rb_portfolio_square_img')
			),
			array(
				'type'				=> 'checkbox',
				'param_name'		=> 'no_spacing',
				'value'				=> array(
					esc_html_x( 'Disable Spacings', 'backend', 'seoes' ) => true
				),
				'dependency'	=> array(
					'element'	=> 'layout',
					'value'		=> array( "grid", "grid_filter", "masonry", "pinterest" )
				),
				'std'				=> get_theme_mod('rb_portfolio_no_spacing')
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Pagination', 'backend', 'seoes' ),
				"param_name"		=> "pagination",
				"value"				=> array(
					esc_html_x( 'Standart', 'backend', 'seoes' )		=> 'standart',
					esc_html_x( 'Load More', 'backend', 'seoes' )		=> 'load_more',
				),
				'dependency'		=> array(
					'element'	=> 'layout',
					'value'		=> array( "grid", "grid_filter", "masonry", "pinterest", "asymmetric" )
				),
				"std"				=> get_theme_mod('rb_portfolio_pagination')
			),
			array(
				'type'				=> 'checkbox',
				'param_name'		=> 'hide_meta',
				'value'				=> array(
					esc_html_x( 'Hide Meta Data', 'backend', 'seoes' ) => true
				),
				'std'				=> '1'
			),
			array(
				'type'			=> 'rb_dropdown',
				'multiple'		=> "true",
				'heading'		=> esc_html_x( 'Hide', 'backend', 'seoes' ),
				'param_name'	=> 'portfolio_hide_meta',
				'dependency'	=> array(
					'element'	=> 'hide_meta',
					'not_empty'	=> true
				),
				'value'			=> array(
					esc_html_x( 'None', 'backend', 'seoes' )					=> '',
					esc_html_x( 'Title', 'backend', 'seoes' )					=> 'title',
					esc_html_x( 'Categories', 'backend', 'seoes' )				=> 'categories',
					esc_html_x( 'Tags', 'backend', 'seoes' )					=> 'tags',
				),
				'std'			=> implode(',', $portfolio_hide_meta)
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
		"name"				=> esc_html_x( 'RB Portfolio', 'backend', 'seoes' ),
		"base"				=> "rb_sc_portfolio",
		"category"			=> "By RB",
		"icon" 				=> "rb_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_RB_Sc_Portfolio extends WPBakeryShortCode {
	    }
	}
?>