<?php

function rb_vc_shortcode_sc_roadmap ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"style"						=> "round",
		"sharp_corners"				=> false,
		"values"					=> "",
		"el_class"					=> "",
		/* -----> STYLING TAB <----- */
		"custom_styles"				=> "",
		"shape_bg"					=> "#fff",
		"number_color"				=> "#FF497C",
		"title_color"				=> "#fff",
		"text_color"				=> "rgba(255,255,255,.8)",
		"line_color"				=> "#8E90A0",
	);

	$responsive_vars = array(
		"all" => array(
			"custom_styles"		=> "",
			"customize_size"	=> false,
			"shape_size"		=> "300px",
			"icons_size"		=> "194px",
			"title_size"		=> "40px",
			"title_margins"		=> "0 0 13px 0px",
			"number_size"		=> "100px",
			"text_size"			=> "17px",
		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Parse values array <----- */
	$values = (array)vc_param_group_parse_atts($values);

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$id = uniqid( "rb_roadmap_" );

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
		if( !empty($shape_size) ){
			$scale = (int)$shape_size / 100;

			$styles .= "
				#".$id." .roadmap_icon_wrapper{
					width: ".(int)$shape_size."px;
					height: ".(int)$shape_size."px;
				}
				#".$id." .roadmap_icon_wrapper > svg{
					-webkit-transform: scale(".$scale.");
				    -ms-transform: scale(".$scale.");
				    transform: scale(".$scale.");
				}
			";
		}
		if( !empty($icons_size) ){
			$styles .= "
				#".$id." .roadmap_icon_wrapper i.svg{
					width: ".(int)$icons_size."px !important;
					height: ".(int)$icons_size."px !important;
				}
			";
		}
		if( !empty($title_size) ){
			$styles .= "
				#".$id." .rb_roadmap_item .roadmap_content_wrapper .text_wrapper .roadmap_title{
					font-size: ".(int)$title_size."px;
				}
			";
		}
		if( !empty($title_margins) ){
			$styles .= "
				#".$id." .rb_roadmap_item .roadmap_content_wrapper .text_wrapper .roadmap_title{
					margin: ".$title_margins.";
				}
			";
		}
		if( !empty($number_size) ){
			$styles .= "
				#".$id." .rb_roadmap_item .roadmap_content_wrapper .number{
					font-size: ".(int)$number_size."px;
					line-height: ".(int)$number_size."px;
				}
			";
		}
		if( !empty($text_size) ){
			$styles .= "
				#".$id." .roadmap_description{
					font-size: ".(int)$text_size."px;
					line-height: ".((int)$text_size * 1.5)."px;
				}
			";
		}
	}
	if( !empty($shape_bg) ){
		$styles .= "
			#".$id." .rb_roadmap_item .roadmap_icon_wrapper > svg *{
				fill: ".$shape_bg.";
			}
		";
	}
	if( !empty($number_color) ){
		$styles .= "
			#".$id." .roadmap_content_wrapper .number{
				color: ".$number_color.";
			}
		";
	}
	if( !empty($title_color) ){
		$styles .= "
			#".$id." .roadmap_content_wrapper .roadmap_title{
				color: ".$title_color.";
			}
		";
	}
	if( !empty($text_color) ){
		$styles .= "
			#".$id." .roadmap_content_wrapper .roadmap_description{
				color: ".$text_color.";
			}
		";
	}
	if( !empty($line_color) ){
		$styles .= "
			#".$id." .rb_roadmap_item:before{
				background-image: linear-gradient(90deg, ".$line_color.", ".$line_color." 60%, transparent 60%, transparent 100%);
			}
		";
	}
 	/* -----> End of default styles <----- */

 	/* -----> Customize landscape styles <----- */
	if( 
		!empty($vc_landscape_styles) ||
		$customize_size_landscape
	){
		$styles .= "
			@media 
				screen and (max-width: 1199px), /*Check, is device a tablet*/
				screen and (max-width: 1366px) and (any-hover: none) /*Enable this styles for iPad Pro 1024-1366*/
			{";

				if( !empty($vc_landscape_styles) ){
					$styles .= "#".$id."{
						".$vc_landscape_styles."
					}";
				}
				if( $customize_size_landscape ){
					if( !empty($shape_size_landscape) ){
						$scale = (int)$shape_size_landscape / 100;

						$styles .= "
							#".$id." .roadmap_icon_wrapper{
								width: ".(int)$shape_size_landscape."px;
								height: ".(int)$shape_size_landscape."px;
							}
							#".$id." .roadmap_icon_wrapper > svg{
								-webkit-transform: scale(".$scale.");
							    -ms-transform: scale(".$scale.");
							    transform: scale(".$scale.");
							}
						";
					}
					if( !empty($icons_size_landscape) ){
						$styles .= "
							#".$id." .roadmap_icon_wrapper i.svg{
								width: ".(int)$icons_size_landscape."px !important;
								height: ".(int)$icons_size_landscape."px !important;
							}
						";
					}
					if( !empty($title_size_landscape) ){
						$styles .= "
							#".$id." .rb_roadmap_item .roadmap_content_wrapper .text_wrapper .roadmap_title{
								font-size: ".(int)$title_size_landscape."px;
							}
						";
					}
					if( !empty($title_margins_landscape) ){
						$styles .= "
							#".$id." .rb_roadmap_item .roadmap_content_wrapper .text_wrapper .roadmap_title{
								margin: ".$title_margins_landscape.";
							}
						";
					}
					if( !empty($number_size_landscape) ){
						$styles .= "
							#".$id." .rb_roadmap_item .roadmap_content_wrapper .number{
								font-size: ".(int)$number_size_landscape."px;
								line-height: ".(int)$number_size_landscape."px;
							}
						";
					}
					if( !empty($text_size_landscape) ){
						$styles .= "
							#".$id." .roadmap_description{
								font-size: ".(int)$text_size_landscape."px;
								line-height: ".((int)$text_size_landscape * 1.5)."px;
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
					$styles .= "#".$id."{
						".$vc_portrait_styles."
					}";
				}
				if( $customize_size_portrait ){
					if( !empty($shape_size_portrait) ){
						$scale = (int)$shape_size_portrait / 100;

						$styles .= "
							#".$id." .roadmap_icon_wrapper{
								width: ".(int)$shape_size_portrait."px;
								height: ".(int)$shape_size_portrait."px;
							}
							#".$id." .roadmap_icon_wrapper > svg{
								-webkit-transform: scale(".$scale.");
							    -ms-transform: scale(".$scale.");
							    transform: scale(".$scale.");
							}
						";
					}
					if( !empty($icons_size_portrait) ){
						$styles .= "
							#".$id." .roadmap_icon_wrapper i.svg{
								width: ".(int)$icons_size_portrait."px !important;
								height: ".(int)$icons_size_portrait."px !important;
							}
						";
					}
					if( !empty($title_size_portrait) ){
						$styles .= "
							#".$id." .rb_roadmap_item .roadmap_content_wrapper .text_wrapper .roadmap_title{
								font-size: ".(int)$title_size_portrait."px;
							}
						";
					}
					if( !empty($title_margins_portrait) ){
						$styles .= "
							#".$id." .rb_roadmap_item .roadmap_content_wrapper .text_wrapper .roadmap_title{
								margin: ".$title_margins_portrait.";
							}
						";
					}
					if( !empty($number_size_portrait) ){
						$styles .= "
							#".$id." .rb_roadmap_item .roadmap_content_wrapper .number{
								font-size: ".(int)$number_size_portrait."px;
								line-height: ".(int)$number_size_portrait."px;
							}
						";
					}
					if( !empty($text_size_portrait) ){
						$styles .= "
							#".$id." .roadmap_description{
								font-size: ".(int)$text_size_portrait."px;
								line-height: ".((int)$text_size_portrait * 1.5)."px;
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
					$styles .= "#".$id."{
						".$vc_mobile_styles."
					}";
				}
				if( $customize_size_mobile ){
					if( !empty($shape_size_mobile) ){
						$scale = (int)$shape_size_mobile / 100;

						$styles .= "
							#".$id." .roadmap_icon_wrapper{
								width: ".(int)$shape_size_mobile."px;
								height: ".(int)$shape_size_mobile."px;
							}
							#".$id." .roadmap_icon_wrapper > svg{
								-webkit-transform: scale(".$scale.");
							    -ms-transform: scale(".$scale.");
							    transform: scale(".$scale.");
							}
						";
					}
					if( !empty($icons_size_mobile) ){
						$styles .= "
							#".$id." .roadmap_icon_wrapper i.svg{
								width: ".(int)$icons_size_mobile."px !important;
								height: ".(int)$icons_size_mobile."px !important;
							}
						";
					}
					if( !empty($title_size_mobile) ){
						$styles .= "
							#".$id." .rb_roadmap_item .roadmap_content_wrapper .text_wrapper .roadmap_title{
								font-size: ".(int)$title_size_mobile."px;
							}
						";
					}
					if( !empty($title_margins_mobile) ){
						$styles .= "
							#".$id." .rb_roadmap_item .roadmap_content_wrapper .text_wrapper .roadmap_title{
								margin: ".$title_margins_mobile.";
							}
						";
					}
					if( !empty($number_size_mobile) ){
						$styles .= "
							#".$id." .rb_roadmap_item .roadmap_content_wrapper .number{
								font-size: ".(int)$number_size_mobile."px;
								line-height: ".(int)$number_size_mobile."px;
							}
						";
					}
					if( !empty($text_size_mobile) ){
						$styles .= "
							#".$id." .roadmap_description{
								font-size: ".(int)$text_size_mobile."px;
								line-height: ".((int)$text_size_mobile * 1.5)."px;
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

 	/* -----> Roadmap classes <----- */
 	$extra_classes = 'style_'.esc_attr($style);

	/* -----> Roadmap module output <----- */
	$out .= "<div id='".$id."' class='rb_roadmap_module ".$extra_classes." ".esc_attr($el_class)."'>";

		foreach ($values as $value) {
			/* -----> Getting Icon <----- */
			$icon_output = '';

			if( !empty($value['icon_lib']) ){
				if( $value['icon_lib'] == 'rb_svg' ){
					$icon = "icon_".$value['icon_lib'];
					$svg_icon = json_decode(str_replace("``", "\"", $value[$icon]), true);
					$upload_dir = wp_upload_dir();
					$this_folder = $upload_dir['basedir'] . '/rb-svgicons/' . md5($svg_icon['collection']) . '/';

					$icon_output .= "<i class='svg' style='width:".$svg_icon['width']."px; height:".$svg_icon['height']."px;'>";
						$icon_output .= file_get_contents($this_folder . $svg_icon['name']);
					$icon_output .= "</i>";
				} else {
					if( !empty($value['icon']) ){
						$icon_output .= '<i class="'.esc_attr($value['icon']).'"></i>';
					}
				}
			}

			/* -----> Roadmap Item <----- */
			$out .= "<div class='rb_roadmap_item'>";
				$out .= "<div class='roadmap_icon_wrapper'>";
					$out .= '<svg style="width:100px; height:100px;" xmlns="http://www.w3.org/2000/svg">';
						if( $style == 'round' ){
							$out .= '<circle cx="50" cy="50" r="50" />';
						} else if( $style == 'rhombus' ){
							if( $sharp_corners ){
								$out .= '<rect x="14.6" y="14.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -20.7107 50)" class="st0" width="70.7" height="70.7" />';
							} else {
								$out .= '<path class="st0" d="M60.5,4.4l35.1,35.1c5.8,5.8,5.8,15.2,0,21.1L60.5,95.6c-5.8,5.8-15.2,5.8-21.1,0L4.4,60.5 c-5.8-5.8-5.8-15.2,0-21.1L39.5,4.4C45.3-1.5,54.7-1.5,60.5,4.4z"  />';
							}
						} else if( $style == 'hexagon' ){
							if( $sharp_corners ){
								$out .= '<polygon class="st0" points="6,25 6,75 49.3,100 92.6,75 92.6,25 49.3,0" />';
							} else {
								$out .= '<path class="st0" d="M54.8,1.3l35.5,20.3c3,1.7,4.8,4.8,4.8,8.2v40.6c0,3.4-1.8,6.5-4.8,8.2L54.8,98.7c-3,1.7-6.6,1.7-9.5,0 L9.8,78.5c-3-1.7-4.8-4.8-4.8-8.2V29.7c0-3.4,1.8-6.5,4.8-8.2L45.2,1.3C48.2-0.4,51.8-0.4,54.8,1.3z"  />';
							}
						} else if( $style == 'square' ){
							if( $sharp_corners ){
								$out .= '<rect class="st0" width="100" height="100" />';
							} else {
								$out .= '<path d="M92,100H8c-4.4,0-8-3.6-8-8V8c0-4.4,3.6-8,8-8h84c4.4,0,8,3.6,8,8v84C100,96.4,96.4,100,92,100z" />';
							}
						}
					$out .= '</svg>';
					$out .= $icon_output;
				$out .= "</div>";
				$out .= "<div class='roadmap_content_wrapper'>";
					if( !empty($value['number']) ){
						$out .= "<span class='number title_ff'>".esc_html($value['number'])."</span>";
					}
					if( !empty($value['title']) || !empty($value['description']) ){
						$out .= "<div class='text_wrapper'>";
							if( !empty($value['title']) ){
								$out .= "<p class='h2 roadmap_title'>".esc_html($value['title'])."</p>";
							}
							if( !empty($value['description']) ){
								$description = wp_kses( $value['description'], array(
									"b"			=> array(),
									"strong"	=> array(),
									"mark"		=> array(),
									"br"		=> array()
								));

								$out .= "<p class='roadmap_description'>".$description."</p>";
							}
						$out .= "</div>";
					}
				$out .= "</div>";
			$out .= "</div>";
		}

	$out .= "</div>";

	
	return $out;
}
add_shortcode( 'rb_sc_roadmap', 'rb_vc_shortcode_sc_roadmap' );

?>