<?php
function rb_vc_shortcode_sc_extended_service ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"icon_lib"						=> "FontAwesome",
		"style"							=> "round",
		"icon_shape"					=> "none",
		"icon_pos"						=> "inside",
		"title"							=> "",
		"title_tag"						=> "h5",
		"button_title"					=> "Click Me!",
		"button_url"					=> "#",
		"sharp_corners"					=> false,
		"add_divider"					=> false,
		"el_class"						=> "",
		/* -----> STYLING TAB <----- */
		"customize_colors"				=> true,
		"background_color"				=> '#fff',
		"shadow_color"					=> 'rgba(16, 1, 148, 0.18)',
		"icon_gradient_1"				=> "#1FC4BB",
		"icon_gradient_2"				=> "#2744F6",
		"icon_hover_gradient_1"			=> "#2744F6",
		"icon_hover_gradient_2"			=> "#1FC4BB",
		"bg_shape_gradient_1"			=> BUTTON_GRADIENT_1,
		"bg_shape_gradient_2"			=> BUTTON_GRADIENT_2,
		"icon_shape_gradient_1"			=> BUTTON_GRADIENT_1,
		"icon_shape_gradient_2"			=> BUTTON_GRADIENT_2,
		"main_color"					=> PRIMARY_COLOR,
		"main_color_hover"				=> PRIMARY_COLOR,
		"accent_color"					=> SECONDARY_COLOR,
		"accent_color_hover"			=> SECONDARY_COLOR,
	);

	$responsive_vars = array(
		"all" => array(
			"custom_styles"		=> "",
			"customize_size"	=> false,
			"shape_size"		=> "100px",
			"icon_size"			=> "50px",
			"title_size"		=> "20px",
			"title_lh"			=> "25px",
			"title_mt"			=> "14px",
			"text_size"			=> "17px",
			"text_lh"			=> "30px",
			"button_size"		=> "16px",
			"button_margin"		=> "10px",
		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$icon = esc_attr(rb_ext_vc_sc_get_icon($atts));
	$content = apply_filters( "the_content", $content );
	$id = uniqid( "rb_service_" );
	$title = wp_kses( $title, array(
		"b"			=> array(),
		"strong"	=> array(),
		"mark"		=> array(),
		"br"		=> array()
	));

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
	if( $customize_size ){
		if( !empty($icon_size) ){
			$styles .= "
				#".$id." .service_icon_wrapper i,
				#".$id." .service_icon_wrapper i:before{
					font-size: ".(int)esc_attr($icon_size)."px;
				}
				#".$id." .service_icon_wrapper i.svg{
					width: ".(int)esc_attr($icon_size)."px !important;
					height: ".(int)esc_attr($icon_size)."px !important;
				}
			";
		}
		if( !empty($shape_size) ){
			$styles .= "
				#".$id." .service_icon_wrapper > svg{
					width: ".(int)$shape_size."px !important;
					height: ".(int)$shape_size."px !important;
				}
				#".$id." .service_icon_wrapper > svg path,
				#".$id." .service_icon_wrapper > svg polygon,
				#".$id." .service_icon_wrapper > svg circle{
					-webkit-transform: scale(".( (int)$shape_size / 100 ).");
					transform: scale(".( (int)$shape_size / 100 ).");
				}
				#".$id." .service_icon_wrapper > svg rect{
					-webkit-transform: scale(".( (int)$shape_size / 100 ).") matrix(0.7071, -0.7071, 0.7071, 0.7071, -20.7107, 50);
					transform: scale(".( (int)$shape_size / 100 ).") matrix(0.7071, -0.7071, 0.7071, 0.7071, -20.7107, 50);
				}
				#".$id.".style_round .icon_outside{
					top: -".( (int)$shape_size / 2.5 )."px;
				}
				#".$id.".style_rhombus .icon_outside{
					top: -".( (int)$shape_size / 3.3 )."px;
				}
				#".$id.".style_square .icon_outside{
					top: -".( (int)$shape_size / 2 )."px;
				}
				#".$id.".style_hexagon .icon_outside{
					top: -".( (int)$shape_size / 3.3 )."px;
				}
			";
		}
		if( !empty($title_size) ){
			$styles .= "
				#".$id." .service_title{
					font-size: ".(int)esc_attr($title_size)."px;
				}
			";
		}
		if( !empty($title_lh) ){
			$styles .= "
				#".$id." .service_title{
					line-height: ".(int)esc_attr($title_lh)."px;
				}
			";
		}
		if( !empty($title_mt) ){
			$styles .= "
				#".$id." .service_title{
					margin-top: ".(int)esc_attr($title_mt)."px;
				}
			";
		}
		if( !empty($text_size) ){
			$styles .= "
				#".$id." .content_wrapper{
					font-size: ".(int)esc_attr($text_size)."px;
				}
			";
		}
		if( !empty($text_lh) ){
			$styles .= "
				#".$id." .content_wrapper{
					line-height: ".(int)esc_attr($text_lh)."px;
				}
			";
		}
		if( !empty($button_size) ){
			$styles .= "
				#".$id." .service-button{
					font-size: ".esc_attr($button_size).";
				}
				#".$id." .service-button:after{
					font-size: ".round( (int)esc_attr($button_size) / 1.33 )."px;
				}
			";	
		}
		if( !empty($button_margin) ){
			$styles .= "
				#".$id." .service-button{
					margin-top: ".esc_attr($button_margin).";
				}
			";	
		}
	}
	if( $customize_colors ){
		if( !empty($icon_gradient_1) && !empty($icon_gradient_2) ){
			$styles .= "
				#".$id." .service_icon_wrapper i{
					background-image: -webkit-linear-gradient(-10deg, ".esc_attr($icon_hover_gradient_2).", ".esc_attr($icon_hover_gradient_1).", ".esc_attr($icon_gradient_2).", ".esc_attr($icon_gradient_1).");
					background-image: -moz-linear-gradient(-10deg, ".esc_attr($icon_hover_gradient_2).", ".esc_attr($icon_hover_gradient_1).", ".esc_attr($icon_gradient_2).", ".esc_attr($icon_gradient_1).");
					background-image: linear-gradient(-10deg, ".esc_attr($icon_hover_gradient_2).", ".esc_attr($icon_hover_gradient_1).", ".esc_attr($icon_gradient_2).", ".esc_attr($icon_gradient_1).");
					-webkit-background-clip: text;
					-moz-background-clip: text;
					background-clip: text;
				}
			";
		}
		if( !empty($icon_hover_gradient_1) && !empty($icon_hover_gradient_2) ){
			$styles .= "
				#".$id.":hover .service_icon_wrapper i{
					background-position: 100% 100%;
				}
			";
		}
		if( !empty($main_color) ){
			$styles .= "
				#".$id." .service_title,
				#".$id." .content_wrapper,
				#".$id." .content_wrapper > a,
				#".$id." .service-button{
					color: ".esc_attr($main_color).";
				}
			";
		}
		if( !empty($main_color_hover) ){
			$styles .= "
				#".$id.":hover .service_title,
				#".$id.":hover .content_wrapper,
				#".$id.":hover .content_wrapper > a,
				#".$id.":hover .service-button{
					color: ".esc_attr($main_color_hover).";
				}
			";
		}
		if( !empty($accent_color) ){
			$styles .= "
				#".$id." .service-button:after{
					color: ".esc_attr($accent_color).";
				}
				#".$id." .divider{
					background-color: ".esc_attr($accent_color).";
				}
			";
		}
		if( !empty($accent_color_hover) ){
			$styles .= "
				#".$id.":hover .service-button:after{
					color: ".esc_attr($accent_color_hover).";
				}
				#".$id.":hover .divider{
					background-color: ".esc_attr($accent_color_hover).";
				}
			";
		}
	}
	/* -----> End of default styles <----- */

	/* -----> Customize landscape styles <----- */
	if( 
		!empty($vc_landscape_styles) ||
		$customize_size_landscape 
	){
		$styles .= "
			@media screen and (max-width: 1199px){
		";

			if( !empty($vc_landscape_styles) ){
				$styles .= "
					#".$id."{
						".$vc_landscape_styles."
					}
				";
			}
			if( $customize_size_landscape ){
				if( !empty($icon_size_landscape) ){
					$styles .= "
						#".$id." .service_icon_wrapper i,
						#".$id." .service_icon_wrapper i:before{
							font-size: ".(int)esc_attr($icon_size_landscape)."px;
						}
						#".$id." .service_icon_wrapper i.svg{
							width: ".(int)esc_attr($icon_size_landscape)."px !important;
							height: ".(int)esc_attr($icon_size_landscape)."px !important;
						}
					";
				}
				if( !empty($shape_size_landscape) ){
					$styles .= "
						#".$id." .service_icon_wrapper > svg{
							width: ".(int)$shape_size_landscape."px !important;
							height: ".(int)$shape_size_landscape."px !important;
						}
						#".$id." .service_icon_wrapper > svg path,
						#".$id." .service_icon_wrapper > svg polygon,
						#".$id." .service_icon_wrapper > svg circle{
							-webkit-transform: scale(".( (int)$shape_size_landscape / 100 ).");
							transform: scale(".( (int)$shape_size_landscape / 100 ).");
						}
						#".$id." .service_icon_wrapper > svg rect{
							-webkit-transform: scale(".( (int)$shape_size_landscape / 100 ).") matrix(0.7071, -0.7071, 0.7071, 0.7071, -20.7107, 50);
							transform: scale(".( (int)$shape_size_landscape / 100 ).") matrix(0.7071, -0.7071, 0.7071, 0.7071, -20.7107, 50);
						}
						#".$id.".style_round .icon_outside{
							top: -".( (int)$shape_size_landscape / 2.5 )."px;
						}
						#".$id.".style_rhombus .icon_outside{
							top: -".( (int)$shape_size_landscape / 3.3 )."px;
						}
						#".$id.".style_square .icon_outside{
							top: -".( (int)$shape_size_landscape / 2 )."px;
						}
						#".$id.".style_hexagon .icon_outside{
							top: -".( (int)$shape_size_landscape / 3.3 )."px;
						}
					";
				}
				if( !empty($title_size_landscape) ){
					$styles .= "
						#".$id." .service_title{
							font-size: ".(int)esc_attr($title_size_landscape)."px;
						}
					";
				}
				if( !empty($title_lh_landscape) ){
					$styles .= "
						#".$id." .service_title{
							line-height: ".(int)esc_attr($title_lh_landscape)."px;
						}
					";
				}
				if( !empty($title_mt_landscape) ){
					$styles .= "
						#".$id." .service_title{
							margin-top: ".(int)esc_attr($title_mt_landscape)."px;
						}
					";
				}
				if( !empty($text_size_landscape) ){
					$styles .= "
						#".$id." .content_wrapper{
							font-size: ".(int)esc_attr($text_size_landscape)."px;
						}
					";
				}
				if( !empty($text_lh_landscape) ){
					$styles .= "
						#".$id." .content_wrapper{
							line-height: ".(int)esc_attr($text_lh_landscape)."px;
						}
					";
				}
				if( !empty($button_size_landscape) ){
					$styles .= "
						#".$id." .service-button{
							font-size: ".esc_attr($button_size_landscape).";
						}
						#".$id." .service-button:after{
							font-size: ".round( (int)esc_attr($button_size_landscape) / 1.33 )."px;
						}
					";	
				}
				if( !empty($button_margin_landscape) ){
					$styles .= "
						#".$id." .service-button{
							margin-top: ".esc_attr($button_margin_landscape).";
						}
					";	
				}
			}

		$styles .= "
			}
		";
	}
	/* -----> End of landscape styles <----- */

	/* -----> Customize portrait styles <----- */
	if( 
		!empty($vc_portrait_styles) ||
		$customize_size_portrait
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
			if( $customize_size_portrait ){
				if( !empty($icon_size_portrait) ){
					$styles .= "
						#".$id." .service_icon_wrapper i,
						#".$id." .service_icon_wrapper i:before{
							font-size: ".(int)esc_attr($icon_size_portrait)."px;
						}
						#".$id." .service_icon_wrapper i.svg{
							width: ".(int)esc_attr($icon_size_portrait)."px !important;
							height: ".(int)esc_attr($icon_size_portrait)."px !important;
						}
					";
				}
				if( !empty($shape_size_portrait) ){
					$styles .= "
						#".$id." .service_icon_wrapper > svg{
							width: ".(int)$shape_size_portrait."px !important;
							height: ".(int)$shape_size_portrait."px !important;
						}
						#".$id." .service_icon_wrapper > svg path,
						#".$id." .service_icon_wrapper > svg polygon,
						#".$id." .service_icon_wrapper > svg circle{
							-webkit-transform: scale(".( (int)$shape_size_portrait / 100 ).");
							transform: scale(".( (int)$shape_size_portrait / 100 ).");
						}
						#".$id." .service_icon_wrapper > svg rect{
							-webkit-transform: scale(".( (int)$shape_size_portrait / 100 ).") matrix(0.7071, -0.7071, 0.7071, 0.7071, -20.7107, 50);
							transform: scale(".( (int)$shape_size_portrait / 100 ).") matrix(0.7071, -0.7071, 0.7071, 0.7071, -20.7107, 50);
						}
						#".$id.".style_round .icon_outside{
							top: -".( (int)$shape_size_portrait / 2.5 )."px;
						}
						#".$id.".style_rhombus .icon_outside{
							top: -".( (int)$shape_size_portrait / 3.3 )."px;
						}
						#".$id.".style_square .icon_outside{
							top: -".( (int)$shape_size_portrait / 2 )."px;
						}
						#".$id.".style_hexagon .icon_outside{
							top: -".( (int)$shape_size_portrait / 3.3 )."px;
						}
					";
				}
				if( !empty($title_size_portrait) ){
					$styles .= "
						#".$id." .service_title{
							font-size: ".(int)esc_attr($title_size_portrait)."px;
						}
					";
				}
				if( !empty($title_lh_portrait) ){
					$styles .= "
						#".$id." .service_title{
							line-height: ".(int)esc_attr($title_lh_portrait)."px;
						}
					";
				}
				if( !empty($title_mt_portrait) ){
					$styles .= "
						#".$id." .service_title{
							margin-top: ".(int)esc_attr($title_mt_portrait)."px;
						}
					";
				}
				if( !empty($text_size_portrait) ){
					$styles .= "
						#".$id." .content_wrapper{
							font-size: ".(int)esc_attr($text_size_portrait)."px;
						}
					";
				}
				if( !empty($text_lh_portrait) ){
					$styles .= "
						#".$id." .content_wrapper{
							line-height: ".(int)esc_attr($text_lh_portrait)."px;
						}
					";
				}
				if( !empty($button_size_portrait) ){
					$styles .= "
						#".$id." .service-button{
							font-size: ".esc_attr($button_size_portrait).";
						}
						#".$id." .service-button:after{
							font-size: ".round( (int)esc_attr($button_size_portrait) / 1.33 )."px;
						}
					";	
				}
				if( !empty($button_margin_portrait) ){
					$styles .= "
						#".$id." .service-button{
							margin-top: ".esc_attr($button_margin_portrait).";
						}
					";	
				}
			}

		$styles .= "
			}
		";
	}
	/* -----> End of portrait styles <----- */

	/* -----> Customize mobile styles <----- */
	if( 
		!empty($vc_mobile_styles) ||
		$customize_size_mobile 
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
			if( $customize_size_mobile ){
				if( !empty($icon_size_mobile) ){
					$styles .= "
						#".$id." .service_icon_wrapper i,
						#".$id." .service_icon_wrapper i:before{
							font-size: ".(int)esc_attr($icon_size_mobile)."px;
						}
						#".$id." .service_icon_wrapper i.svg{
							width: ".(int)esc_attr($icon_size_mobile)."px !important;
							height: ".(int)esc_attr($icon_size_mobile)."px !important;
						}
					";
				}
				if( !empty($shape_size_mobile) ){
					$styles .= "
						#".$id." .service_icon_wrapper > svg{
							width: ".(int)$shape_size_mobile."px !important;
							height: ".(int)$shape_size_mobile."px !important;
						}
						#".$id." .service_icon_wrapper > svg path,
						#".$id." .service_icon_wrapper > svg polygon,
						#".$id." .service_icon_wrapper > svg circle{
							-webkit-transform: scale(".( (int)$shape_size_mobile / 100 ).");
							transform: scale(".( (int)$shape_size_mobile / 100 ).");
						}
						#".$id." .service_icon_wrapper > svg rect{
							-webkit-transform: scale(".( (int)$shape_size_mobile / 100 ).") matrix(0.7071, -0.7071, 0.7071, 0.7071, -20.7107, 50);
							transform: scale(".( (int)$shape_size_mobile / 100 ).") matrix(0.7071, -0.7071, 0.7071, 0.7071, -20.7107, 50);
						}
						#".$id.".style_round .icon_outside{
							top: -".( (int)$shape_size_mobile / 2.5 )."px;
						}
						#".$id.".style_rhombus .icon_outside{
							top: -".( (int)$shape_size_mobile / 3.3 )."px;
						}
						#".$id.".style_square .icon_outside{
							top: -".( (int)$shape_size_mobile / 2 )."px;
						}
						#".$id.".style_hexagon .icon_outside{
							top: -".( (int)$shape_size_mobile / 3.3 )."px;
						}
					";
				}
				if( !empty($title_size_mobile) ){
					$styles .= "
						#".$id." .service_title{
							font-size: ".(int)esc_attr($title_size_mobile)."px;
						}
					";
				}
				if( !empty($title_lh_mobile) ){
					$styles .= "
						#".$id." .service_title{
							line-height: ".(int)esc_attr($title_lh_mobile)."px;
						}
					";
				}
				if( !empty($title_mt_mobile) ){
					$styles .= "
						#".$id." .service_title{
							margin-top: ".(int)esc_attr($title_mt_mobile)."px;
						}
					";
				}
				if( !empty($text_size_mobile) ){
					$styles .= "
						#".$id." .content_wrapper{
							font-size: ".(int)esc_attr($text_size_mobile)."px;
						}
					";
				}
				if( !empty($text_lh_mobile) ){
					$styles .= "
						#".$id." .content_wrapper{
							line-height: ".(int)esc_attr($text_lh_mobile)."px;
						}
					";
				}
				if( !empty($button_size_mobile) ){
					$styles .= "
						#".$id." .service-button{
							font-size: ".esc_attr($button_size_mobile).";
						}
						#".$id." .service-button:after{
							font-size: ".round( (int)esc_attr($button_size_mobile) / 1.33 )."px;
						}
					";	
				}
				if( !empty($button_margin_mobile) ){
					$styles .= "
						#".$id." .service-button{
							margin-top: ".esc_attr($button_margin_mobile).";
						}
					";	
				}
			}

		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */ 

	rb__vc_styles($styles);

	$module_classes = 'rb_extended_service_module';
	$module_classes .= ' style_'.esc_attr($style);
	$module_classes .= ' '.esc_attr($el_class);

	$icon_classes = 'service_icon_wrapper';
	$icon_classes .= ' icon_shape_'.esc_attr($icon_shape);
	$icon_classes .= ' icon_'.esc_attr($icon_pos);
	$icon_output = '';

	$main_gradient = uniqid('main_gradient_');
	$gradient = uniqid('gradient_');
	$bg_gradient = uniqid('bg_gradient_');
	$mask = uniqid('mask_');
	$shadow = uniqid('shadow_');

	$start_tag = !empty($button_url) && empty($button_title) ? "<a href='".esc_url($button_url)."' " : "<div ";
	$end_tag = !empty($button_url) && empty($button_title) ? "</a>" : "</div>";

	/* -----> Getting Icon <----- */
	if( !empty($icon_lib) ){
		if( $icon_lib == 'rb_svg' ){
			$icon = "icon_".$icon_lib;
			$svg_icon = json_decode(str_replace("``", "\"", $atts[$icon]), true);
			$upload_dir = wp_upload_dir();
			$this_folder = $upload_dir['basedir'] . '/rb-svgicons/' . md5($svg_icon['collection']) . '/';	

			$icon_output .= "<i class='svg' style='width:".$svg_icon['width']."px; height:".$svg_icon['height']."px;'>";
				$icon_output .= file_get_contents($this_folder . $svg_icon['name']);
			$icon_output .= "</i>";
		} else {
			if( !empty($icon) ){
				$icon_output .= '<i class="'.esc_attr($icon).'"></i>';
			}
		}
	}

	/* -----> Extended Service module output <----- */
	$out .= $start_tag."id='".$id."' class='".$module_classes."'>";
		$out .= "<div class='extended_services_shape'>";
			$out .= '<svg class="svg_shape" style="width:100px; height:100px;" xmlns="http://www.w3.org/2000/svg">';
				$out .= '<defs>
							<filter id="'.$shadow.'" height="200%">
						    	<feDropShadow dx="0" dy="6" stdDeviation="4" flood-color="'.$shadow_color.'" />
						    </filter>
						    <linearGradient id="'.$bg_gradient.'" x1="0%" y1="0%" x2="0%" y2="100%">
								<stop offset="0%" style="stop-color:'.esc_attr($bg_shape_gradient_1).'; stop-opacity:1" />
								<stop offset="100%" style="stop-color:'.esc_attr($bg_shape_gradient_2).'; stop-opacity:1" />
							</linearGradient>
						';
					$out .= '<mask id="'.$mask.'">';
						if( $style == 'hexagon' ){
							if( $sharp_corners ){
								$out .= '<polygon points="6,25 6,75 49.3,100 92.6,75 92.6,25 49.3,0" />';
							} else {
								$out .= '<path d="M54.8,1.3l35.5,20.3c3,1.7,4.8,4.8,4.8,8.2v40.6c0,3.4-1.8,6.5-4.8,8.2L54.8,98.7c-3,1.7-6.6,1.7-9.5,0 L9.8,78.5c-3-1.7-4.8-4.8-4.8-8.2V29.7c0-3.4,1.8-6.5,4.8-8.2L45.2,1.3C48.2-0.4,51.8-0.4,54.8,1.3z" />';
							}
						} else if( $style == 'square' ){
							if( $sharp_corners ){
								$out .= '<rect class="st0" width="100" height="100" />';
							} else {
								$out .= '<path d="M92,100H8c-4.4,0-8-3.6-8-8V8c0-4.4,3.6-8,8-8h84c4.4,0,8,3.6,8,8v84C100,96.4,96.4,100,92,100z" />';
							}
						} else if( $style == 'rhombus' ){
							if( $sharp_corners ){
								$out .= '<rect x="14.6" y="14.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -20.7107 50)" class="st0" width="70.7" height="70.7" />';
							} else {
								$out .= '<path d="M60.5,4.4l35.1,35.1c5.8,5.8,5.8,15.2,0,21.1L60.5,95.6c-5.8,5.8-15.2,5.8-21.1,0L4.4,60.5 c-5.8-5.8-5.8-15.2,0-21.1L39.5,4.4C45.3-1.5,54.7-1.5,60.5,4.4z" />';
							}
						} else {
							$out .= '<circle cx="50" cy="50" r="50" />';
						}
					$out .= '</mask>';
				$out .= '</defs>';

				$out .= '<g style="filter:url(#'.$shadow.')">';
					if( $style == 'hexagon' ){
							if( $sharp_corners ){
								$out .= '<polygon class="default" points="6,25 6,75 49.3,100 92.6,75 92.6,25 49.3,0" fill="'.esc_attr($background_color).'" mask="url(#'.$mask.')" />';
								$out .= '<polygon class="hover" points="6,25 6,75 49.3,100 92.6,75 92.6,25 49.3,0" fill="url(#'.$bg_gradient.')" mask="url(#'.$mask.')" />';
							} else {
								$out .= '<path class="default" d="M54.8,1.3l35.5,20.3c3,1.7,4.8,4.8,4.8,8.2v40.6c0,3.4-1.8,6.5-4.8,8.2L54.8,98.7c-3,1.7-6.6,1.7-9.5,0 L9.8,78.5c-3-1.7-4.8-4.8-4.8-8.2V29.7c0-3.4,1.8-6.5,4.8-8.2L45.2,1.3C48.2-0.4,51.8-0.4,54.8,1.3z" fill="'.esc_attr($background_color).'" mask="url(#'.$mask.')" />';
								$out .= '<path class="hover" d="M54.8,1.3l35.5,20.3c3,1.7,4.8,4.8,4.8,8.2v40.6c0,3.4-1.8,6.5-4.8,8.2L54.8,98.7c-3,1.7-6.6,1.7-9.5,0 L9.8,78.5c-3-1.7-4.8-4.8-4.8-8.2V29.7c0-3.4,1.8-6.5,4.8-8.2L45.2,1.3C48.2-0.4,51.8-0.4,54.8,1.3z" fill="url(#'.$bg_gradient.')" mask="url(#'.$mask.')" />';
							}
						} else if( $style == 'square' ){
							if( $sharp_corners ){
								$out .= '<rect class="default" width="100" height="100" fill="'.esc_attr($background_color).'" mask="url(#'.$mask.')" />';
								$out .= '<rect class="hover" width="100" height="100" fill="url(#'.$bg_gradient.')" mask="url(#'.$mask.')" />';
							} else {
								$out .= '<path class="default" d="M92,100H8c-4.4,0-8-3.6-8-8V8c0-4.4,3.6-8,8-8h84c4.4,0,8,3.6,8,8v84C100,96.4,96.4,100,92,100z" fill="'.esc_attr($background_color).'" mask="url(#'.$mask.')" />';
								$out .= '<path class="hover" d="M92,100H8c-4.4,0-8-3.6-8-8V8c0-4.4,3.6-8,8-8h84c4.4,0,8,3.6,8,8v84C100,96.4,96.4,100,92,100z" fill="url(#'.$bg_gradient.')" mask="url(#'.$mask.')" />';
							}
						} else if( $style == 'rhombus' ){
							if( $sharp_corners ){
								$out .= '<rect class="default" x="14.6" y="14.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -20.7107 50)" class="st0" width="70.7" height="70.7" fill="'.esc_attr($background_color).'" mask="url(#'.$mask.')" />';
								$out .= '<rect class="hover" x="14.6" y="14.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -20.7107 50)" class="st0" width="70.7" height="70.7" fill="url(#'.$bg_gradient.')" mask="url(#'.$mask.')" />';
							} else {
								$out .= '<path class="default" d="M60.5,4.4l35.1,35.1c5.8,5.8,5.8,15.2,0,21.1L60.5,95.6c-5.8,5.8-15.2,5.8-21.1,0L4.4,60.5 c-5.8-5.8-5.8-15.2,0-21.1L39.5,4.4C45.3-1.5,54.7-1.5,60.5,4.4z" fill="'.esc_attr($background_color).'" mask="url(#'.$mask.')" />';
								$out .= '<path class="hover" d="M60.5,4.4l35.1,35.1c5.8,5.8,5.8,15.2,0,21.1L60.5,95.6c-5.8,5.8-15.2,5.8-21.1,0L4.4,60.5 c-5.8-5.8-5.8-15.2,0-21.1L39.5,4.4C45.3-1.5,54.7-1.5,60.5,4.4z" fill="url(#'.$bg_gradient.')" mask="url(#'.$mask.')" />';
							}
						} else {
							$out .= '<circle class="default" cx="50" cy="50" r="50" fill="'.esc_attr($background_color).'" mask="url(#'.$mask.')" />';
							$out .= '<circle class="hover" cx="50" cy="50" r="50" fill="url(#'.$bg_gradient.')" mask="url(#'.$mask.')" />';
						}
				$out .= '</g>';

			$out .= '</svg>';
		$out .= "</div>";

		$out .= "<div class='extended_service_content_wrapper'>";
			if( !empty($icon) ){
				$out .= "<div class='".$icon_classes."'>";
					if( $icon_shape != 'none' ){
						$out .= '<svg style="width:100px; height:100px;" xmlns="http://www.w3.org/2000/svg">';
							$out .= '<defs>
										<linearGradient id="'.esc_attr($gradient).'" x1="0%" y1="0%" x2="0%" y2="100%">
											<stop offset="0%" style="stop-color:'.esc_attr($icon_shape_gradient_1).'; stop-opacity:1" />
											<stop offset="100%" style="stop-color:'.esc_attr($icon_shape_gradient_2).'; stop-opacity:1" />
										</linearGradient>
									</defs>';
							if( $icon_shape == 'round' ){
								$out .= '<circle cx="50" cy="50" r="50" fill="url(#'.esc_attr($gradient).')" />';
							} else if( $icon_shape == 'rhombus' ){
								if( $sharp_corners ){
									$out .= '<rect x="14.6" y="14.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -20.7107 50)" class="st0" width="70.7" height="70.7" fill="url(#'.esc_attr($gradient).')" />';
								} else {
									$out .= '<path d="M60.5,4.4l35.1,35.1c5.8,5.8,5.8,15.2,0,21.1L60.5,95.6c-5.8,5.8-15.2,5.8-21.1,0L4.4,60.5 c-5.8-5.8-5.8-15.2,0-21.1L39.5,4.4C45.3-1.5,54.7-1.5,60.5,4.4z" fill="url(#'.esc_attr($gradient).')" />';
								}
							} else if( $icon_shape == 'hexagon' ){
								if( $sharp_corners ){
									$out .= '<polygon points="6,25 6,75 49.3,100 92.6,75 92.6,25 49.3,0" fill="url(#'.esc_attr($gradient).')"/>';
								} else {
									$out .= '<path d="M54.8,1.3l35.5,20.3c3,1.7,4.8,4.8,4.8,8.2v40.6c0,3.4-1.8,6.5-4.8,8.2L54.8,98.7c-3,1.7-6.6,1.7-9.5,0 L9.8,78.5c-3-1.7-4.8-4.8-4.8-8.2V29.7c0-3.4,1.8-6.5,4.8-8.2L45.2,1.3C48.2-0.4,51.8-0.4,54.8,1.3z" fill="url(#'.esc_attr($gradient).')" />';
								}
							} else if( $icon_shape == 'square' ){
								if( $sharp_corners ){
									$out .= '<rect width="100" height="100" fill="url(#'.esc_attr($gradient).')"/>';
								} else {
									$out .= '<path d="M92,100H8c-4.4,0-8-3.6-8-8V8c0-4.4,3.6-8,8-8h84c4.4,0,8,3.6,8,8v84C100,96.4,96.4,100,92,100z" fill="url(#'.esc_attr($gradient).')" />';
								}
							}
						$out .= '</svg>';								
					}
					$out .= $icon_output;
				$out .= "</div>";
			}
			$out .= '<div class="service_content">';
				if( !empty($title) ){
					$out .= '<'.$title_tag.' class="service_title">'.$title.'</'.$title_tag.'>';
				}
				if( !empty($content) ){
					if( $add_divider ){
						$out .= '<span class="divider"></span>';
					}
					$out .= "<div class='content_wrapper'>";
						$out .= $content;
					$out .= "</div>";
				}
				if( !empty($button_title) ){
					$out .= "<a class='service-button rb_button simple' href='".esc_url($button_url)."'>";
						$out .= esc_html($button_title);
					$out .= "</a>";
				}
			$out .= '</div>';
		$out .= '</div>';

	$out .= $end_tag;

	return $out;
}
add_shortcode( 'rb_sc_extended_service', 'rb_vc_shortcode_sc_extended_service' );

?>