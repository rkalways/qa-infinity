<?php

function rb_vc_shortcode_sc_milestone ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"style"							=> "simple",
		"icon_lib"						=> "FontAwesome",
		"icon_shape"					=> "none",
		"title"							=> "",
		"count"							=> "50",
		"symbol"						=> "%",
		"sharp_corners"					=> false,
		"el_class"						=> "",
		/* -----> STYLING TAB <----- */
		"main_shape_gradient_1"			=> "#F89516",
		"main_shape_gradient_2"			=> "#FF6B46",
		"icon_shape_gradient_1"			=> "#F89516",
		"icon_shape_gradient_2"			=> "#FF6B46",
		"icon_gradient_1"				=> PRIMARY_COLOR,
		"icon_gradient_2"				=> PRIMARY_COLOR,
		"number_gradient_1"				=> PRIMARY_COLOR,
		"number_gradient_2"				=> PRIMARY_COLOR,
		"title_color"					=> PRIMARY_COLOR,
	);

	$responsive_vars = array(
		"all" => array(
			"custom_styles"		=> "",
			"customize_align"	=> false,
			"alignment"			=> "left",
			"customize_size"	=> false,
			"icon_shape_size"	=> "80px",
			"icon_size"			=> "38px",
			"count_size"		=> "60px",
			"count_margins"		=> "0px 0px 0px 0px",
			"title_size"		=> "20px"
		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $icon_output = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$icon = esc_attr(rb_ext_vc_sc_get_icon($atts));
	$id = uniqid( "rb_milestone_" );
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
	if( $customize_align ){
		$styles .= "
			#".$id." .milestone_content{
				text-align: ".$alignment.";
			}
		";
	}
	if( $customize_size ){
		if( !empty($icon_shape_size) ){
			$scale = (int)$icon_shape_size / 100;

			$styles .= "
				#".$id." .milestone_icon > svg{
					-webkit-transform: translate(-50%, -50%) scale(".$scale.");
					-ms-transform: translate(-50%, -50%) scale(".$scale.");
					transform: translate(-50%, -50%) scale(".$scale.");
				}

				#".$id." .milestone_icon:not(.shape_none){
					width: ".(int)$icon_shape_size."px;
					height: ".(int)$icon_shape_size."px;
				}
			";
		}
		if( !empty($icon_size) ){
			if( $icon_lib == 'rb_svg' ){
				$styles .= "
					#".$id." .milestone_icon i{
						width: ".(int)esc_attr($icon_size)."px !important;
						height: ".(int)esc_attr($icon_size)."px !important;
					}
				";
			} else {
				$styles .= "
					#".$id." .milestone_icon i,
					#".$id." .milestone_icon i:before{
						font-size: ".(int)esc_attr($icon_size)."px;
						line-height: ".(int)esc_attr($icon_size)."px;
					}
				";
			}
		}
		if( !empty($count_size) ){
			$styles .= "
				#".$id." .count_wrapper{
					font-size: ".(int)esc_attr($count_size)."px;
				}
			";
		}
		if( !empty($count_margins) ){
			$styles .= "
				#".$id." .count_wrapper{
					margin: ".esc_attr($count_margins).";
				}
			";
		}
		if( !empty($title_size) ){
			$styles .= "
				#".$id." .milestone_title{
					font-size: ".(int)esc_attr($title_size)."px;
				}
			";
			if( (int)$title_size < 18 ){
				$styles .= "
					#".$id." .milestone_title{
						font-weight: 400;
					}
				";	
			}
		}
	}
	if( !empty($icon_gradient_1) && !empty($icon_gradient_2) ){
		$styles .= "
			#".$id." .milestone_icon i{
				background-image: -webkit-linear-gradient(to bottom, ".esc_attr($icon_gradient_1).", ".esc_attr($icon_gradient_2).");
				background-image: -moz-linear-gradient(to bottom, ".esc_attr($icon_gradient_1).", ".esc_attr($icon_gradient_2).");
				background-image: linear-gradient(to bottom, ".esc_attr($icon_gradient_1).", ".esc_attr($icon_gradient_2).");
				-webkit-background-clip: text;
				-moz-background-clip: text;
				background-clip: text;
			}
		";
	}
	if( !empty($number_gradient_1) && !empty($number_gradient_2) ){
		$styles .= "
			#".$id." .count_wrapper{
				background-image: -webkit-linear-gradient(to bottom, ".esc_attr($number_gradient_1).", ".esc_attr($number_gradient_2).");
				background-image: -moz-linear-gradient(to bottom, ".esc_attr($number_gradient_1).", ".esc_attr($number_gradient_2).");
				background-image: linear-gradient(to bottom, ".esc_attr($number_gradient_1).", ".esc_attr($number_gradient_2).");
				-webkit-background-clip: text;
				-moz-background-clip: text;
				background-clip: text;
			}
		";
	}
	if( !empty($title_color) ){
		$styles .= "
			#".$id." .milestone_title{
				color: ".esc_attr($title_color).";
			}
		";
	}
	/* -----> End of default styles <----- */

	/* -----> Customize landscape styles <----- */
	if( 
		!empty($vc_landscape_styles) ||
		$customize_align_landscape ||
		$customize_size_landscape
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
					#".$id." .milestone_content{
						text-align: ".$alignment_landscape.";
					}
				";
			}
			if( $customize_size_landscape ){
				if( !empty($icon_shape_size_landscape) ){
					$scale = (int)$icon_shape_size_landscape / 100;

					$styles .= "
						#".$id." .milestone_icon > svg{
							-webkit-transform: translate(-50%, -50%) scale(".$scale.");
							-ms-transform: translate(-50%, -50%) scale(".$scale.");
							transform: translate(-50%, -50%) scale(".$scale.");
						}

						#".$id." .milestone_icon:not(.shape_none){
							width: ".(int)$icon_shape_size_landscape."px;
							height: ".(int)$icon_shape_size_landscape."px;
						}
					";
				}
				if( !empty($icon_size_landscape) ){
					if( $icon_lib == 'rb_svg' ){
						$styles .= "
							#".$id." .milestone_icon i{
								width: ".(int)esc_attr($icon_size_landscape)."px !important;
								height: ".(int)esc_attr($icon_size_landscape)."px !important;
							}
						";
					} else {
						$styles .= "
							#".$id." .milestone_icon i,
							#".$id." .milestone_icon i:before{
								font-size: ".(int)esc_attr($icon_size_landscape)."px;
								line-height: ".(int)esc_attr($icon_size_landscape)."px;
							}
						";
					}
				}
				if( !empty($count_size_landscape) ){
					$styles .= "
						#".$id." .count_wrapper{
							font-size: ".(int)esc_attr($count_size_landscape)."px;
						}
					";
				}
				if( !empty($count_margins_landscape) ){
					$styles .= "
						#".$id." .count_wrapper{
							margin: ".esc_attr($count_margins_landscape).";
						}
					";
				}
				if( !empty($title_size_landscape) ){
					$styles .= "
						#".$id." .milestone_title{
							font-size: ".(int)esc_attr($title_size_landscape)."px;
						}
					";
					if( (int)$title_size_landscape < 18 ){
						$styles .= "
							#".$id." .milestone_title{
								font-weight: 400;
							}
						";	
					}
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
		$customize_align_portrait ||
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
			if( $customize_align_portrait ){
				$styles .= "
					#".$id." .milestone_content{
						text-align: ".$alignment_portrait.";
					}
				";
			}
			if( $customize_size_portrait ){
				if( !empty($icon_shape_size_portrait) ){
					$scale = (int)$icon_shape_size_portrait / 100;

					$styles .= "
						#".$id." .milestone_icon > svg{
							-webkit-transform: translate(-50%, -50%) scale(".$scale.");
							-ms-transform: translate(-50%, -50%) scale(".$scale.");
							transform: translate(-50%, -50%) scale(".$scale.");
						}

						#".$id." .milestone_icon:not(.shape_none){
							width: ".(int)$icon_shape_size_portrait."px;
							height: ".(int)$icon_shape_size_portrait."px;
						}
					";
				}
				if( !empty($icon_size_portrait) ){
					if( $icon_lib == 'rb_svg' ){
						$styles .= "
							#".$id." .milestone_icon i{
								width: ".(int)esc_attr($icon_size_portrait)."px !important;
								height: ".(int)esc_attr($icon_size_portrait)."px !important;
							}
						";
					} else {
						$styles .= "
							#".$id." .milestone_icon i,
							#".$id." .milestone_icon i:before{
								font-size: ".(int)esc_attr($icon_size_portrait)."px;
								line-height: ".(int)esc_attr($icon_size_portrait)."px;
							}
						";
					}
				}
				if( !empty($count_size_portrait) ){
					$styles .= "
						#".$id." .count_wrapper{
							font-size: ".(int)esc_attr($count_size_portrait)."px;
						}
					";
				}
				if( !empty($count_margins_portrait) ){
					$styles .= "
						#".$id." .count_wrapper{
							margin: ".esc_attr($count_margins_portrait).";
						}
					";
				}
				if( !empty($title_size_portrait) ){
					$styles .= "
						#".$id." .milestone_title{
							font-size: ".(int)esc_attr($title_size_portrait)."px;
						}
					";
					if( (int)$title_size_portrait < 18 ){
						$styles .= "
							#".$id." .milestone_title{
								font-weight: 400;
							}
						";	
					}
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
		$customize_align_mobile ||
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
			if( $customize_align_mobile ){
				$styles .= "
					#".$id." .milestone_content{
						text-align: ".$alignment_mobile.";
					}
				";
			}
			if( $customize_size_mobile ){
				if( !empty($icon_shape_size_mobile) ){
					$scale = (int)$icon_shape_size_mobile / 100;

					$styles .= "
						#".$id." .milestone_icon > svg{
							-webkit-transform: translate(-50%, -50%) scale(".$scale.");
							-ms-transform: translate(-50%, -50%) scale(".$scale.");
							transform: translate(-50%, -50%) scale(".$scale.");
						}

						#".$id." .milestone_icon:not(.shape_none){
							width: ".(int)$icon_shape_size_mobile."px;
							height: ".(int)$icon_shape_size_mobile."px;
						}
					";
				}
				if( !empty($icon_size_mobile) ){
					if( $icon_lib == 'rb_svg' ){
						$styles .= "
							#".$id." .milestone_icon i{
								width: ".(int)esc_attr($icon_size_mobile)."px !important;
								height: ".(int)esc_attr($icon_size_mobile)."px !important;
							}
						";
					} else {
						$styles .= "
							#".$id." .milestone_icon i,
							#".$id." .milestone_icon i:before{
								font-size: ".(int)esc_attr($icon_size_mobile)."px;
								line-height: ".(int)esc_attr($icon_size_mobile)."px;
							}
						";
					}
				}
				if( !empty($count_size_mobile) ){
					$styles .= "
						#".$id." .count_wrapper{
							font-size: ".(int)esc_attr($count_size_mobile)."px;
						}
					";
				}
				if( !empty($count_margins_mobile) ){
					$styles .= "
						#".$id." .count_wrapper{
							margin: ".esc_attr($count_margins_mobile).";
						}
					";
				}
				if( !empty($title_size_mobile) ){
					$styles .= "
						#".$id." .milestone_title{
							font-size: ".(int)esc_attr($title_size_mobile)."px;
						}
					";
					if( (int)$title_size_mobile < 18 ){
						$styles .= "
							#".$id." .milestone_title{
								font-weight: 400;
							}
						";	
					}
				}
			}

		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */ 

	rb__vc_styles($styles);

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

	$module_classes = 'rb_milestone_module';
	$module_classes .= ' style_'.$style;
	$gradient = uniqid('gradient_');
	$icon_gradient = uniqid('icon_gradient_');

	/* -----> Milestone module output <----- */
	$out .= "<div id='".$id."' class='".$module_classes."'>";
		if( $style != 'simple' ){
			$out .= '<svg style="width:100px; height:100px;" xmlns="http://www.w3.org/2000/svg">';
				$out .= '<defs>
							<linearGradient id="'.esc_attr($gradient).'" x1="0%" y1="0%" x2="0%" y2="100%">
								<stop offset="0%" style="stop-color:'.esc_attr($main_shape_gradient_1).'; stop-opacity:1" />
								<stop offset="100%" style="stop-color:'.esc_attr($main_shape_gradient_2).'; stop-opacity:1" />
							</linearGradient>
						</defs>';
				if( $style == 'round' ){
					$out .= '<circle cx="50" cy="50" r="50" fill="url(#'.esc_attr($gradient).')" />';
				} else if( $style == 'rhombus' ){
					if( $sharp_corners ){
						$out .= '<rect x="14.6" y="14.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -20.7107 50)" class="st0" width="70.7" height="70.7" fill="url(#'.esc_attr($gradient).')" />';
					} else {
						$out .= '<path d="M60.5,4.4l35.1,35.1c5.8,5.8,5.8,15.2,0,21.1L60.5,95.6c-5.8,5.8-15.2,5.8-21.1,0L4.4,60.5 c-5.8-5.8-5.8-15.2,0-21.1L39.5,4.4C45.3-1.5,54.7-1.5,60.5,4.4z" fill="url(#'.esc_attr($gradient).')" />';
					}
				} else if( $style == 'hexagon' ){
					if( $sharp_corners ){
						$out .= '<polygon points="6,25 6,75 49.3,100 92.6,75 92.6,25 49.3,0" fill="url(#'.esc_attr($gradient).')"/>';
					} else {
						$out .= '<path d="M54.8,1.3l35.5,20.3c3,1.7,4.8,4.8,4.8,8.2v40.6c0,3.4-1.8,6.5-4.8,8.2L54.8,98.7c-3,1.7-6.6,1.7-9.5,0 L9.8,78.5c-3-1.7-4.8-4.8-4.8-8.2V29.7c0-3.4,1.8-6.5,4.8-8.2L45.2,1.3C48.2-0.4,51.8-0.4,54.8,1.3z" fill="url(#'.esc_attr($gradient).')" />';
					}
				} else if( $style == 'square' ){
					if( $sharp_corners ){
						$out .= '<rect width="100" height="100" fill="url(#'.esc_attr($gradient).')"/>';
					} else {
						$out .= '<path d="M92,100H8c-4.4,0-8-3.6-8-8V8c0-4.4,3.6-8,8-8h84c4.4,0,8,3.6,8,8v84C100,96.4,96.4,100,92,100z" fill="url(#'.esc_attr($gradient).')" />';
					}
				}
			$out .= '</svg>';
		}
		$out .= "<div class='milestone_content'>";
			if( !empty($icon_output) ){
				$out .= "<div class='milestone_icon shape_".$icon_shape."'>";
					if( $icon_shape != 'none' ){
						$out .= '<svg style="width:100px; height:100px;" xmlns="http://www.w3.org/2000/svg">';
							$out .= '<defs>
										<linearGradient id="'.esc_attr($icon_gradient).'" x1="0%" y1="0%" x2="0%" y2="100%">
											<stop offset="0%" style="stop-color:'.esc_attr($icon_shape_gradient_1).'; stop-opacity:1" />
											<stop offset="100%" style="stop-color:'.esc_attr($icon_shape_gradient_2).'; stop-opacity:1" />
										</linearGradient>
									</defs>';
							if( $icon_shape == 'round' ){
								$out .= '<circle cx="50" cy="50" r="50" fill="url(#'.esc_attr($icon_gradient).')" />';
							} else if( $icon_shape == 'rhombus' ){
								if( $sharp_corners ){
									$out .= '<rect x="14.6" y="14.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -20.7107 50)" class="st0" width="70.7" height="70.7" fill="url(#'.esc_attr($icon_gradient).')" />';
								} else {
									$out .= '<path d="M60.5,4.4l35.1,35.1c5.8,5.8,5.8,15.2,0,21.1L60.5,95.6c-5.8,5.8-15.2,5.8-21.1,0L4.4,60.5 c-5.8-5.8-5.8-15.2,0-21.1L39.5,4.4C45.3-1.5,54.7-1.5,60.5,4.4z" fill="url(#'.esc_attr($icon_gradient).')" />';
								}
							} else if( $icon_shape == 'hexagon' ){
								if( $sharp_corners ){
									$out .= '<polygon points="6,25 6,75 49.3,100 92.6,75 92.6,25 49.3,0" fill="url(#'.esc_attr($icon_gradient).')"/>';
								} else {
									$out .= '<path d="M54.8,1.3l35.5,20.3c3,1.7,4.8,4.8,4.8,8.2v40.6c0,3.4-1.8,6.5-4.8,8.2L54.8,98.7c-3,1.7-6.6,1.7-9.5,0 L9.8,78.5c-3-1.7-4.8-4.8-4.8-8.2V29.7c0-3.4,1.8-6.5,4.8-8.2L45.2,1.3C48.2-0.4,51.8-0.4,54.8,1.3z" fill="url(#'.esc_attr($icon_gradient).')" />';
								}
							} else if( $icon_shape == 'square' ){
								if( $sharp_corners ){
									$out .= '<rect width="100" height="100" fill="url(#'.esc_attr($icon_gradient).')"/>';
								} else {
									$out .= '<path d="M92,100H8c-4.4,0-8-3.6-8-8V8c0-4.4,3.6-8,8-8h84c4.4,0,8,3.6,8,8v84C100,96.4,96.4,100,92,100z" fill="url(#'.esc_attr($icon_gradient).')" />';
								}
							}
						$out .= '</svg>';								
					}
					$out .= $icon_output;
				$out .= "</div>";
			}
			if( !empty($count) ){
				$out .= "<div class='count_wrapper title_ff'>";
					$out .= "<span class='counter'>".esc_html($count)."</span>";
					if( !empty($symbol) ){
						$out .= esc_html($symbol);
					}
				$out .= "</div>";
			}
			if( !empty($title) ){
				$out .= "<p class='milestone_title'>".$title."</p>";
			}
		$out .= "</div>";
	$out .= "</div>";

	return $out;
}
add_shortcode( 'rb_sc_milestone', 'rb_vc_shortcode_sc_milestone' );

?>