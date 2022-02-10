<?php
function rb_vc_shortcode_sc_service ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"icon_lib"						=> "FontAwesome",
		"icon_img"						=> "icon",
		"style"							=> "icon_top",
		"style_tablet"					=> "inherit",
		"image"							=> "",
		"icon_shape"					=> "none",
		"title"							=> "",
		"title_tag"						=> "h5",
		"button_title"					=> "Click Me!",
		"button_url"					=> "#",
		"sharp_corners"					=> false,
		"add_divider"					=> false,
		"el_class"						=> "",
		/* -----> STYLING TAB <----- */
		"animate_hover"					=> false,
		"customize_colors"				=> true,
		"shape_gradient_1"				=> BUTTON_GRADIENT_1,
		"shape_gradient_2"				=> BUTTON_GRADIENT_2,
		"icon_color"					=> '#fff',
		"title_color"					=> PRIMARY_COLOR,
		"divider_color"					=> PRIMARY_COLOR,
		"shadow_color"					=> "",
		"text_color"					=> rb_Hex2RGBA(PRIMARY_COLOR, '0.8'),
		"text_color_hover"				=> SECONDARY_COLOR,
		"button_color"					=> PRIMARY_COLOR,
		"button_arrow_color"			=> PRIMARY_COLOR,
	);

	$responsive_vars = array(
		"all" => array(
			"custom_styles"		=> "",
			"customize_align"	=> false,
			"module_alignment"	=> "left",
			"customize_size"	=> false,
			"shape_size"		=> "100px",
			"icon_size"			=> "50px",
			"title_size"		=> "20px",
			"title_lh"			=> "25px",
			"title_margins"		=> "4px 0px 2px 0px",
			"text_size"			=> "17px",
			"text_lh"			=> "30px",
			"button_size"		=> "16px",
			"button_mt"			=> "10px",
		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$icon = esc_attr(rb_ext_vc_sc_get_icon($atts));
	$image_alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
	$image = !empty($image) ? wp_get_attachment_image_src($image, 'full')[0] : '';
	$content = apply_filters( "the_content", $content );
	$id = uniqid( "rb_service_" );

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
			#".$id."{
				text-align: ".$module_alignment.";
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
		if( !empty($button_mt) ){
			$styles .= "
				#".$id." .service-button{
					margin-top: ".(int)esc_attr($button_mt)."px;
				}
			";
		}
		if( !empty($title_margins) ){
			$styles .= "
				#".$id." .service_title{
					margin: ".esc_attr($title_margins).";
				}
			";
		}
	}
	if( $customize_colors ){
		if( !empty($icon_color) ){
			$styles .= "
				#".$id." .service_icon_wrapper i,
				#".$id." .service_icon_wrapper i:before{
					color: ".esc_attr($icon_color).";
				}
			";
		}
		if( !empty($title_color) ){
			$styles .= "
				#".$id." .service_title{
					color: ".esc_attr($title_color).";
				}
			";
		}
		if( !empty($divider_color) ){
			$styles .= "
				#".$id." .service_divider{
					background-color: ".esc_attr($divider_color).";
				}
			";	
		}
		if( !empty($shadow_color) ){
			$styles .= "
				#".$id."{
					-webkit-box-shadow: 0px 0px 15px -2px ".esc_attr($shadow_color).";
					-moz-box-shadow: 0px 0px 15px -2px ".esc_attr($shadow_color).";
					box-shadow: 0px 0px 15px -2px ".esc_attr($shadow_color).";
				}
			";	
		}
		if( !empty($text_color) ){
			$styles .= "
				#".$id." .content_wrapper,
				#".$id." .content_wrapper > a{
					color: ".esc_attr($text_color).";
				}
			";
		}
		if( !empty($text_color_hover) ){
			$styles .= "
				#".$id." .content_wrapper > a:hover{
					color: ".esc_attr($text_color_hover).";
				}
			";
		}
		if( !empty($button_color) ){
			$styles .= "
				#".$id." .service-button{
					color: ".esc_attr($button_color).";
				}
			";
		}
		if( !empty($button_arrow_color) ){
			$styles .= "
				#".$id." .service-button:after{
					color: ".esc_attr($button_arrow_color).";
				}
			";
		}
	}
	/* -----> End of default styles <----- */

	/* -----> Customize landscape styles <----- */
	if( 
		!empty($vc_landscape_styles) ||
		$customize_size_landscape || 
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
					#".$id."{
						text-align: ".$module_alignment_landscape.";
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
				if( !empty($button_mt_landscape) ){
					$styles .= "
						#".$id." .service-button{
							margin-top: ".(int)esc_attr($button_mt_landscape)."px;
						}
					";
				}
				if( !empty($title_margins_landscape) ){
					$styles .= "
						#".$id." .service_title{
							margin: ".esc_attr($title_margins_landscape).";
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
		$customize_size_portrait || 
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
					#".$id."{
						text-align: ".$module_alignment_portrait.";
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
				if( !empty($button_mt_portrait) ){
					$styles .= "
						#".$id." .service-button{
							margin-top: ".(int)esc_attr($button_mt_portrait)."px;
						}
					";
				}
				if( !empty($title_margins_portrait) ){
					$styles .= "
						#".$id." .service_title{
							margin: ".esc_attr($title_margins_portrait).";
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
		$customize_size_mobile || 
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
					#".$id."{
						text-align: ".$module_alignment_mobile.";
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
				if( !empty($button_mt_mobile) ){
					$styles .= "
						#".$id." .service-button{
							margin-top: ".(int)esc_attr($button_mt_mobile)."px;
						}
					";
				}
				if( !empty($title_margins_mobile) ){
					$styles .= "
						#".$id." .service_title{
							margin: ".esc_attr($title_margins_mobile).";
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

	$module_classes = 'rb_service_module';
	$module_classes .= ' style_'.esc_attr($style);
	$module_classes .= ' style_tablet_'.esc_attr($style_tablet);
	$module_classes .= ' shape_'.esc_attr($icon_shape);
	$module_classes .= $animate_hover ? ' animate' : '';
	$module_classes .= ' '.esc_attr($el_class);
	$icon_output = '';

	$gradient = uniqid('gradient_');

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

	/* -----> Filter Products module output <----- */
	$out .= $start_tag."id='".$id."' class='".$module_classes."'>";
		if( $icon_img == 'icon' && !empty($icon) ){
			$out .= "<div class='service_icon_wrapper'>";
				if( $icon_shape != 'none' ){
					$out .= '<svg style="width:100px; height:100px;" xmlns="http://www.w3.org/2000/svg">';
						$out .= '<defs>
									<linearGradient id="'.esc_attr($gradient).'" x1="0%" y1="0%" x2="0%" y2="100%">
										<stop offset="0%" style="stop-color:'.esc_attr($shape_gradient_1).'; stop-opacity:1" />
										<stop offset="100%" style="stop-color:'.esc_attr($shape_gradient_2).'; stop-opacity:1" />
									</linearGradient>
								</defs>';
						if( $icon_shape == 'round' ){
							$out .= '<circle cx="50" cy="50" r="50" fill="url(#'.esc_attr($gradient).')" />';
						} else if( $icon_shape == 'rhombus' ){
							if( $sharp_corners ){
								$out .= '<rect x="14.6" y="14.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -20.7107 50)" class="st0" width="70.7" height="70.7" fill="url(#'.esc_attr($gradient).')" />';
							} else {
								$out .= '<path class="st0" d="M60.5,4.4l35.1,35.1c5.8,5.8,5.8,15.2,0,21.1L60.5,95.6c-5.8,5.8-15.2,5.8-21.1,0L4.4,60.5 c-5.8-5.8-5.8-15.2,0-21.1L39.5,4.4C45.3-1.5,54.7-1.5,60.5,4.4z" fill="url(#'.esc_attr($gradient).')" />';
							}
						} else if( $icon_shape == 'hexagon' ){
							if( $sharp_corners ){
								$out .= '<polygon class="st0" points="6,25 6,75 49.3,100 92.6,75 92.6,25 49.3,0" fill="url(#'.esc_attr($gradient).')"/>';
							} else {
								$out .= '<path class="st0" d="M54.8,1.3l35.5,20.3c3,1.7,4.8,4.8,4.8,8.2v40.6c0,3.4-1.8,6.5-4.8,8.2L54.8,98.7c-3,1.7-6.6,1.7-9.5,0 L9.8,78.5c-3-1.7-4.8-4.8-4.8-8.2V29.7c0-3.4,1.8-6.5,4.8-8.2L45.2,1.3C48.2-0.4,51.8-0.4,54.8,1.3z" fill="url(#'.esc_attr($gradient).')" />';
							}
						} else if( $icon_shape == 'square' ){
							if( $sharp_corners ){
								$out .= '<rect class="st0" width="100" height="100" fill="url(#'.esc_attr($gradient).')"/>';
							} else {
								$out .= '<path d="M92,100H8c-4.4,0-8-3.6-8-8V8c0-4.4,3.6-8,8-8h84c4.4,0,8,3.6,8,8v84C100,96.4,96.4,100,92,100z" fill="url(#'.esc_attr($gradient).')"/>';
							}
						}
					$out .= '</svg>';
				}
				$out .= $icon_output;
			$out .= "</div>";
		} else if( $icon_img == 'image' && !empty($image) ){
			$out .= "<div class='service_image_wrapper'>";
				$out .= "<img src='".esc_url($image)."' alt='".esc_attr($image_alt)."' />";
			$out .= "</div>";
		}
		$out .= '<div class="service_content_wrapper">';
			if( !empty($title) ){
				$out .= '<'.$title_tag.' class="service_title">'.esc_html($title).'</'.$title_tag.'>';
			}
			if( $add_divider ){
				$out .= '<span class="service_divider"></span>';
			}
			if( !empty($content) ){
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

	$out .= $end_tag;

	return $out;
}
add_shortcode( 'rb_sc_service', 'rb_vc_shortcode_sc_service' );

?>