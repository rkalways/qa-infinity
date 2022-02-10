<?php

function rb_vc_shortcode_sc_filter_products ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"values"						=> "",
		"el_class"						=> "",
		/* -----> STYLING TAB <----- */
	);

	$responsive_vars = array(
		"all" => array(
			"custom_styles"		=> "",
		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$values = (array)vc_param_group_parse_atts($values);
	$id = uniqid( "rb_filter_products_" );
	$def_cat = $values[0]['category'];
	$def_col = $values[0]['columns'];
	$def_quant = $values[0]['quantity'];

	/* -----> Visual Composer Responsive styles <----- */
	list( $vc_desktop_class, $vc_landscape_class, $vc_portrait_class, $vc_mobile_class ) = vc_responsive_styles($atts);

	preg_match("/(?<=\{).+?(?=\})/", $vc_desktop_class, $vc_desktop_styles); 
	$vc_desktop_styles = implode($vc_desktop_styles);

	preg_match("/(?<=\{).+?(?=\})/", $vc_landscape_class, $vc_landscape_styles);
	$vc_landscape_styles = implode($vc_landscape_styles);

	preg_match("/(?<=\{).+?(?=\})/", $vc_portrait_class, $vc_portrait_styles);
	$vc_portrait_styles = implode($vc_portrait_styles);

	preg_match("/(?<=\{).+?(?=\})/", $vc_mobile_class, $vc_mobile_styles);
	$vc_mobile_styles = implode($vc_mobile_styles);


	/* -----> Customize default styles <----- */
	if( !empty($vc_desktop_styles) ){
		$styles .= "
			#".$id."{
				".$vc_desktop_styles."
			}
		";
	}
	/* -----> End of default styles <----- */

	rb__vc_styles($styles);

	/* -----> Filter Products module output <----- */
	if( !empty($values) ){
		$out .= "<div id='".$id."' class='rb_filter_products ".esc_attr($el_class)."'>";

			$out .= "<ul class='rb_filter_products_wrapper'>";
				foreach( $values as $key => $value ){
					$out .= "<li class='rb_filter_product".( $key == 0 ? ' active' : '' )."' data-category='".esc_attr($value['category'])."' data-columns='".esc_attr($value['columns'])."' data-quantity='".esc_attr($value['quantity'])."'>".esc_html($value['title'])."</li>";
				}
			$out .= "</ul>";

			$out .= "<div class='rb_filter_products_content'>";

				$out .= '<div class="ajax_preloader content_loader">';
					$out .= '<div class="dots-wrapper">';
						$out .= '<span></span><span></span><span></span>';
					$out .= '</div>';
				$out .= '</div>';

				$out .= "<div class='ajax_container'>";
					$out .= do_shortcode('[products limit="'.(int)$def_quant.'" columns="'.(int)$def_col.'" category="'.esc_attr($def_cat).'"]');
				$out .= "</div>";

			$out .= "</div>";

		$out .= "</div>";
	}

	return $out;
}
add_shortcode( 'rb_sc_filter_products', 'rb_vc_shortcode_sc_filter_products' );

?>