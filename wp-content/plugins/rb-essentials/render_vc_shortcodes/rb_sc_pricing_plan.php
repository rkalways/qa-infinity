<?php

function rb_vc_shortcode_sc_pricing_plan ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"title"							=> "",
		"currency"						=> "$",
		"price"							=> "49",
		"price_desc"					=> "/month",
		"button_title"					=> "",
		"button_url"					=> "#",
		"highlighted"					=> false,
		"image"							=> "",
		"highlight_label"				=> "",
		"el_class"						=> "",
		/* -----> STYLING TAB <----- */
		"background_color"				=> "#fff",
		"text_color"					=> PRIMARY_COLOR,
		"divider_color"					=> SECONDARY_COLOR,
		"label_bg"						=> "#1ED2B4",
		"btn_font_color"				=> '#fff',
		"btn_font_color_hover"			=> PRIMARY_COLOR,
		"btn_bg_color"					=> SECONDARY_COLOR,
		"btn_bg_color_hover"			=> '#fff',
		"btn_border_color"				=> SECONDARY_COLOR,
		"btn_border_color_hover"		=> SECONDARY_COLOR,
	);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = "";
	$id = uniqid( "rb_pricing_plan_" );
	$content = apply_filters( "the_content", $content );
	$image = !empty($image) ? wp_get_attachment_image_src($image, 'full')[0] : '';

	/* -----> Customize default styles <----- */
	if( !empty($background_color) ){
		$styles .= "
			#".$id."{
				background-color: ".esc_attr($background_color).";
			}
		";
	}
	if( !empty($text_color) ){
		$styles .= "
			#".$id.",
			#".$id." h3{
				color: ".esc_attr($text_color).";
			}
		";
	}
	if( !empty($divider_color) ){
		$styles .= "
			#".$id." h3:after{
				background-color: ".esc_attr($divider_color).";
			}
		";
	}
	if( !empty($label_bg) ){
		$styles .= "
			#".$id." .hightlight{
				background-color: ".esc_attr($label_bg).";
			}
		";
	}
	if( !empty($btn_font_color) ){
		$styles .= "
			#".$id." .pricing_plan_button{
				color: ".esc_attr($btn_font_color).";	
			}
		";
	}
	if( !empty($btn_bg_color) ){
		$styles .= "
			#".$id." .pricing_plan_button{
				background-color: ".esc_attr($btn_bg_color).";	
			}
		";
	}
	if( !empty($btn_border_color) ){
		$styles .= "
			#".$id." .pricing_plan_button{
				border-color: ".esc_attr($btn_border_color).";	
			}
		";
	}
	$styles .= "
		@media 
			screen and (min-width: 1367px),
			screen and (min-width: 1200px) and (any-hover: hover),
			screen and (min-width: 1200px) and (min--moz-device-pixel-ratio:0),
			screen and (min-width: 1200px) and (-ms-high-contrast: none),
			screen and (min-width: 1200px) and (-ms-high-contrast: active)
		{
	";

		if( !empty($btn_font_color_hover) ){
			$styles .= "
				#".$id." .pricing_plan_button:hover{
					color: ".esc_attr($btn_font_color_hover).";	
				}
			";
		}
		if( !empty($btn_bg_color_hover) ){
			$styles .= "
				#".$id." .pricing_plan_button:hover{
					background-color: ".esc_attr($btn_bg_color_hover).";	
				}
			";
		}
		if( !empty($btn_border_color_hover) ){
			$styles .= "
				#".$id." .pricing_plan_button:hover{
					border-color: ".esc_attr($btn_border_color_hover).";	
				}
			";
		}

	$styles .="
		}
	";
	/* -----> End of default styles <----- */

	rb__vc_styles($styles);

	$module_classes = 'rb_pricing_plan_module';
	$module_classes .= $highlighted ? ' highlighted' : '';
	$module_classes .= !empty($el_class) ? ' '.esc_attr($el_class) : '';

	$module_bg = $highlighted ? 'background-image: url('.esc_url($image).');' : '';

	/* -----> Filter Products module output <----- */
	$out .= "<div id='".$id."' class='".$module_classes."' style='".$module_bg."'>";
		if( $highlighted && !empty($highlight_label) ){
			$out .= "<span class='hightlight'>".esc_html($highlight_label)."</span>";
		}
		if( !empty($title) ){
			$out .= "<h3>".esc_html($title)."</h3>";
		}
		if( !empty($price) ){
			$out .= "<div class='price_wrapper title_ff'>";
				if( !empty($currency) ){
					$out .= "<i>".esc_html($currency)."</i>";
				}
				$out .= "<span>".esc_html($price)."</span>";
				if( !empty($price_desc) ){
					$out .= "<p>".esc_html($price_desc)."</p>";
				}
			$out .= "</div>";
		}
		if( !empty($content) ){
			$out .= "<div class='content-wrapper'>".$content."</div>";
		}
		if( !empty($button_title) && !empty($button_url) ){
			$out .= "<a href='".esc_url($button_url)."' class='rb_button medium pricing_plan_button'>";
				$out .= esc_html($button_title);
			$out .= "</a>";
		}
	$out .= "</div>";

	return $out;
}
add_shortcode( 'rb_sc_pricing_plan', 'rb_vc_shortcode_sc_pricing_plan' );

?>