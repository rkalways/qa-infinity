<?php

function rb_vc_shortcode_sc_testimonials ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"style"							=> "clear",
		"columns"						=> "1",
		"carousel"						=> false,
		"autoplay"						=> false,
		"slides_to_scroll"				=> "1",
		"autoplay_speed"				=> "3000",
		"content_pos"					=> "bottom",
		"values"						=> "",
		"el_class"						=> "",
		/* -----> STYLING TAB <----- */
		"customize_colors"				=> true,
		"background_gradient_1"			=> "#fff",
		"background_gradient_2"			=> "#fff",
		"hover_background_gradient_1"	=> "#FFAF00",
		"hover_background_gradient_2"	=> "#FF6849",
		"text_color"					=> "rgba(62,74,89, .8)",
		"text_color_hover"				=> "#fff",
		"title_color"					=> PRIMARY_COLOR,
		"title_color_hover"				=> "#fff",
		"accent_color"					=> SECONDARY_COLOR,
		"accent_color_hover"			=> "#fff",
		"image_shadow_color"			=> "rgba(255,255,255,.35)",
		"shadow_color"					=> "rgba(85,76,181,.17)",
		"dots_color"					=> "#e5e5e5",
		"active_dot"					=> SECONDARY_COLOR,
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
	$id = uniqid( "rb_testimonials_" );

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
	if( !empty($background_gradient_1) && !empty($background_gradient_2) && !empty($hover_background_gradient_1) && !empty($hover_background_gradient_2) ){
		$styles .= "
			#".$id.".style_with_bg .testimonial{
				background-image: linear-gradient(0deg, ".esc_attr($hover_background_gradient_2).", ".esc_attr($hover_background_gradient_1).", ".esc_attr($background_gradient_2).", ".esc_attr($background_gradient_1).");
			}
		";
	}
	if( !empty($text_color) ){
		$styles .= "
			#".$id." .testimonial_pos,
			#".$id." .testimonial_desc,
			#".$id." .testimonial_desc a{
				color: ".esc_attr($text_color).";
			}
		";
	}
	if( !empty($title_color) ){
		$styles .= "
			#".$id." .testimonial_name{
				color: ".esc_attr($title_color).";
			}
		";
	}
	if( !empty($accent_color) ){
		$styles .= "
			#".$id." .testimonial_desc:before{
				background-color: ".esc_attr($accent_color).";
			}
		";
	}
	if( !empty($image_shadow_color) ){
		$styles .= "
			#".$id.".style_with_bg .image_wrapper.round,
			#".$id.".style_with_bg .image_wrapper.square{
				-webkit-box-shadow: 0 5px 15px 0 ".esc_attr($image_shadow_color).";
			    -moz-box-shadow: 0 5px 15px 0 ".esc_attr($image_shadow_color).";
			    box-shadow: 0 5px 15px 0 ".esc_attr($image_shadow_color).";
			}
		";
	}
	if( !empty($shadow_color) ){
		$styles .= "
			#".$id.".style_with_bg .testimonial{
				-webkit-box-shadow: 0 8px 14px 2px ".esc_attr($shadow_color).";
			    -moz-box-shadow: 0 8px 14px 2px ".esc_attr($shadow_color).";
			    box-shadow: 0 8px 14px 2px ".esc_attr($shadow_color).";
			}
		";
	}
	if( !empty($dots_color) ){
		$styles .= "
			#".$id." .slick-dots li button{
				border-color: ".esc_attr($dots_color).";
			}
			#".$id." .slick-dots li:after{
				background-color: ".esc_attr($dots_color).";
			}
		";
	}
	if( !empty($active_dot) ){
		$styles .= "
			#".$id." .slick-dots li.slick-active button{
				border-color: ".esc_attr($active_dot).";
			}
		";
	}
	if( 
		!empty($text_color_hover) ||
		!empty($title_color_hover) ||
		!empty($accent_color_hover)
	){
		$styles .= "
			@media 
				screen and (min-width: 1367px),
				screen and (min-width: 1200px) and (any-hover: hover),
				screen and (min-width: 1200px) and (min--moz-device-pixel-ratio:0),
				screen and (min-width: 1200px) and (-ms-high-contrast: none),
				screen and (min-width: 1200px) and (-ms-high-contrast: active)
			{
		";

			if( !empty($text_color_hover) ){
				$styles .= "
					#".$id.".style_with_bg .testimonial:hover .testimonial_pos,
					#".$id.".style_with_bg .testimonial:hover .testimonial_desc{
						color: ".esc_attr($text_color_hover).";
					}
				";
			}
			if( !empty($title_color_hover) ){
				$styles .= "
					#".$id.".style_with_bg .testimonial:hover .testimonial_name{
						color: ".esc_attr($title_color_hover).";
					}
				";	
			}
			if( !empty($accent_color_hover) ){
				$styles .= "
					#".$id.".style_with_bg .testimonial:hover .testimonial_desc:before{
						background-color: ".esc_attr($accent_color_hover).";
					}
				";
			}

		$styles .= "
			}
		";
	}
	/* -----> End of default styles <----- */

	/* -----> Customize landscape styles <----- */
	if( !empty($vc_landscape_styles) ){
		$styles .= "
			@media 
				screen and (max-width: 1199px),
				screen and (max-width: 1366px) and (any-hover: none)
			{
		";

			if( !empty($vc_landscape_styles) ){
				$styles .= "
					#".$id."{
						".$vc_landscape_styles.";
					}
				";
			}

		$styles .= "
			}
		";
	}
	/* -----> End of landscape styles <----- */

	/* -----> Customize portrait styles <----- */
	if( !empty($vc_portrait_styles) ){
		$styles .= "
			@media screen and (max-width: 991px){
		";

			if( !empty($vc_portrait_styles) ){
				$styles .= "
					#".$id."{
						".$vc_portrait_styles.";
					}
				";
			}

		$styles .= "
			}
		";
	}
	/* -----> End of portrait styles <----- */

	/* -----> Customize mobile styles <----- */
	if( !empty($vc_mobile_styles) ){
		$styles .= "
			@media screen and (max-width: 767px){
		";

			if( !empty($vc_mobile_styles) ){
				$styles .= "
					#".$id."{
						".$vc_mobile_styles.";
					}
				";
			}

		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */

	rb__vc_styles($styles);

	$module_classes = "rb_testimonials_module";
	$module_classes .= " content_".$content_pos;
	$module_classes .= " style_".$style;
	$module_classes .= $carousel ? " rb_carousel_wrapper" : '';
	$module_classes .= !empty($el_class) ? " ".esc_attr($el_class) : '';

	$module_atts = 'data-columns="'.$columns.'"';
	$module_atts .= ' data-pagination="on" data-draggable="on" data-infinite="on"';
	$module_atts .= ' data-slides-to-scroll="'.esc_attr($slides_to_scroll).'"';
	$module_atts .= $autoplay ? ' data-autoplay="on"' : '';
	$module_atts .= $autoplay && !empty($autoplay_speed) ? ' data-autoplay-speed="'.esc_attr($autoplay_speed).'"' : '';

	/* -----> Banner module output <----- */
	$out .= "<div id='".$id."' class='".$module_classes."' ".($carousel ? $module_atts : '').">";
		$out .= "<div class='".($carousel ? 'rb_carousel' : 'rb_testimonials_wrapper columns_'.$columns)."'>";

			foreach ($values as $value) {
				$out .= "<div class='testimonial'>";
					if( !empty($value['image']) ){
						$image_alt = get_post_meta($value['image'], '_wp_attachment_image_alt', TRUE);
						$image = !empty($value['image']) ? wp_get_attachment_image_src($value['image'], 'full')[0] : '';

						$out .= "<div class='image_wrapper ".esc_attr($value['shape'])."'>";
							$out .= "<img src='".esc_url($image)."' alt='".esc_attr($image_alt)."' />";
						$out .= "</div>";
					}
					if( !empty($value['name']) ){
						$out .= "<p class='h4 testimonial_name'>".esc_html($value['name'])."</p>";
					}
					if( !empty($value['position']) ){
						$out .= "<p class='testimonial_pos'>".esc_html($value['position'])."</p>";
					}
					if( !empty($value['description']) ){
						$out .= "<p class='testimonial_desc'>";
							$out .= (isset($value['phone']) && $value['phone']) ? "<i class='fa fa-phone'></i>" : '';
							$out .= $value['description'];
						$out .= "</p>";
					}
				$out .= "</div>";
			}

		$out .= "</div>";
	$out .= "</div>";

	return $out;
}
add_shortcode( 'rb_sc_testimonials', 'rb_vc_shortcode_sc_testimonials' );

?>