<?php

function rb_vc_shortcode_sc_button ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"title"							=> "Click Me!",
		"url"							=> "#",
		"new_tab"						=> true,
		"el_class"						=> "",
		/* -----> STYLING TAB <----- */
		"btn_size"						=> "large",
		"font_size"						=> "18px",
		"spacings"						=> "",
		"btn_style"						=> "advanced",
		"btn_custom_style"				=> "advanced",
		"square"						=> false,
		"no_shadow"						=> true,
		"btn_font_color"				=> '#fff',
		"btn_arrow_color"				=> SECONDARY_COLOR,
		"btn_font_color_hover"			=> PRIMARY_COLOR,
		"btn_bg_color"					=> SECONDARY_COLOR,
		"btn_bg_color_hover"			=> '#fff',
		"btn_border_color"				=> SECONDARY_COLOR,
		"btn_border_color_hover"		=> SECONDARY_COLOR,
	);

	$responsive_vars = array(
		"all" => array(
			"custom_styles"		=> "",
			"customize_align"	=> false,
			"aligning"			=> "left",
		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$id_wrapper = uniqid( "rb_button_wrapper_" );
	$id = uniqid( "rb_button_" );

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
	if( $customize_align ){
		$styles .= "
			#".$id_wrapper."{
				text-align: ".$aligning.";
			}
		";
	}
	if( !empty($vc_desktop_styles) ){
		$styles .= "
			#".$id."{
				".$vc_desktop_styles."
			}
		";
	}
	if( $square ){
		$styles .= "
			#".$id."{
				-webkit-border-radius: 0px !important;
				border-radius: 0px !important;
			}
		";
	}
	if( $btn_style == 'custom' ){
		if( !empty($btn_font_color) ){
			$styles .= "
				#".$id."{
					color: ".esc_attr($btn_font_color).";	
				}
			";
		}
		if( $btn_custom_style == 'simple' ){
			if( !empty($btn_arrow_color) ){
				$styles .= "
					#".$id.":after{
						color: ".esc_attr($btn_arrow_color).";	
					}
				";
			}
		}
		if( $btn_custom_style == 'advanced' ){
			if( !empty($btn_bg_color) ){
				$styles .= "
					#".$id."{
						background-color: ".esc_attr($btn_bg_color).";	
					}
				";
			}
			if( !empty($btn_border_color) ){
				$styles .= "
					#".$id."{
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
						#".$id.":hover{
							color: ".esc_attr($btn_font_color_hover).";	
						}
					";
				}
				if( !empty($btn_bg_color_hover) ){
					$styles .= "
						#".$id.":hover{
							background-color: ".esc_attr($btn_bg_color_hover).";	
						}
					";
				}
				if( !empty($btn_border_color_hover) ){
					$styles .= "
						#".$id.":hover{
							border-color: ".esc_attr($btn_border_color_hover).";	
						}
					";
				}

			$styles .="
				}
			";
		}
	}
	/* -----> End of default styles <----- */

	/* -----> Customize landscape styles <----- */
	if( 
		!empty($vc_landscape_styles) || 
		$customize_align_landscape 
	){
		$styles .= "
			@media 
				screen and (max-width: 1199px), /*Check, is device a tablet*/
				screen and (max-width: 1366px) and (any-hover: none) /*Enable this styles for iPad Pro 1024-1366*/
			{
		";

			if( !empty($vc_landscape_styles) ){
				$styles .= "
					#".$id."{
						".$vc_landscape_styles."
					}
				";
			}
			if( $customize_align_landscape ){
				$styles .= "
					#".$id_wrapper."{
						text-align: ".$aligning_landscape.";
					}
				";
			}

		$styles .= "
			}
		";
	}
	/* -----> End of landscape styles <----- */

	/* -----> Customize portrait styles <----- */
	if( 
		!empty($vc_portrait_styles) || 
		$customize_align_portrait 
	){
		$styles .= "
			@media screen and (max-width: 991px){
		";

			if( !empty($vc_portrait_styles) ){
				$styles .= "
					#".$id."{
						".$vc_portrait_styles."
					}
				";
			}
			if( $customize_align_portrait ){
				$styles .= "
					#".$id_wrapper."{
						text-align: ".$aligning_portrait.";
					}
				";
			}

		$styles .= "
			}
		";
	}
	/* -----> End of portrait styles <----- */

	/* -----> Customize mobile styles <----- */
	if( 
		!empty($vc_mobile_styles) || 
		$customize_align_mobile 
	){
		$styles .= "
			@media screen and (max-width: 767px){
		";

			if( !empty($vc_mobile_styles) ){
				$styles .= "
					#".$id."{
						".$vc_mobile_styles."
					}
				";
			}
			if( $customize_align_mobile ){
				$styles .= "
					#".$id_wrapper."{
						text-align: ".$aligning_mobile.";
					}
				";
			}

		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */ 

	rb__vc_styles($styles);

	$button_classes = 'rb_button ';
	$button_classes .= $btn_style != 'custom' ? esc_attr($btn_style).' ' : esc_attr($btn_custom_style).' ';
	$button_classes .= ' '.esc_attr($btn_size);
	$button_classes .= $no_shadow ? ' no_shadow' : '';

	/* -----> Button module output <----- */
	if( !empty($title) ){
		$out .= "<div id='".$id_wrapper."' class='rb_button_wrapper ".esc_attr($el_class)."'>";
			$out .= "<a id='".$id."' class='".$button_classes."' href='".(!empty($url) ? $url : '#')."' ".($new_tab ? 'target="_blank"' : '').">";
				$out .= esc_html($title);
			$out .= "</a>";
		$out .= "</div>";
	}

	return $out;
}
add_shortcode( 'rb_sc_button', 'rb_vc_shortcode_sc_button' );

?>