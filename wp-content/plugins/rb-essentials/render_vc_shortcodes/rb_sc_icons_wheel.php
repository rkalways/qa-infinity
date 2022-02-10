<?php

function rb_vc_shortcode_sc_icons_wheel ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"style"						=> "round",
		"values"					=> "",
		"hover_trigger"				=> false,
		"sharp_corners"				=> false,
		"autoplay"					=> false,
		"autoplay_speed"			=> "3000",
		"el_class"					=> "",
		/* -----> STYLING TAB <----- */
		"custom_styles"				=> "",
		"custom_color"				=> true,
		"icon_gradient_1"			=> "#ffaf00",
		"icon_gradient_2"			=> "#ff6849",
		"active_icon_gradient_1"	=> "#fff",
		"active_icon_gradient_2"	=> "#fff",
		"active_shape_gradient_1"	=> "#ffaf00",
		"active_shape_gradient_2"	=> "#ff6849",
		"icon_shape_bg"				=> "#fff",
		"subtitle_color"			=> SECONDARY_COLOR,
		"title_color"				=> PRIMARY_COLOR,
		"text_color"				=> rb_Hex2RGBA( PRIMARY_COLOR, '0.8' ),
		"circle_color"				=> "#D6D6DB",
		"shadow_color"				=> "#e3e3f0"
	);

	$responsive_vars = array(
		"all" => array(
			"custom_styles"		=> "",
			"customize_size"	=> false,
			"shape_size"		=> "160px",
			"icons_size"		=> "54px",
		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Parse values array <----- */
	$values = (array)vc_param_group_parse_atts($values);

	/* -----> Variables declaration <----- */
	$out = $styles = $extra_atts = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$id = uniqid( "rb_icons_wheel_" );
	$counter = 0;

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
				#".$id." .icons_wheel_wrapper .icons_wheel_icon .icon_wrapper svg{
					-webkit-transform: scale(".$scale.");
				    -ms-transform: scale(".$scale.");
				    transform: scale(".$scale.");
				}
			";
		}
		if( !empty($icons_size) ){
			$styles .= "
				#".$id." .icons_wheel_wrapper .icons_wheel_icon .icon_wrapper i:before{
					font-size: ".(int)$icons_size."px;
				}
			";
		}
	}
	if( $custom_color ){
		if( !empty($icon_gradient_1) && !empty($icon_gradient_2) && !empty($active_icon_gradient_1) && !empty($active_icon_gradient_2) ){
			$styles .= "
				#".$id." .icon_wrapper i{
					background-image: -webkit-linear-gradient(-10deg, ".esc_attr($active_icon_gradient_2).", ".esc_attr($active_icon_gradient_1).", ".esc_attr($icon_gradient_2).", ".esc_attr($icon_gradient_1).");
					background-image: -moz-linear-gradient(-10deg, ".esc_attr($active_icon_gradient_2).", ".esc_attr($active_icon_gradient_1).", ".esc_attr($icon_gradient_2).", ".esc_attr($icon_gradient_1).");
					background-image: linear-gradient(-10deg, ".esc_attr($active_icon_gradient_2).", ".esc_attr($active_icon_gradient_1).", ".esc_attr($icon_gradient_2).", ".esc_attr($icon_gradient_1).");
					-webkit-background-clip: text;
					-moz-background-clip: text;
					background-clip: text;
				}
			";
		}
		if( !empty($subtitle_color) ){
			$styles .= "
				#".$id." .icons_wheel_subtitle{
					color: ".esc_attr($subtitle_color).";
				}
			";
		}
		if( !empty($title_color) ){
			$styles .= "
				#".$id." .rb_icons_wheel_module .icons_wheel_wrapper .icons_wheel_info .icons_wheel_title{
					color: ".esc_attr($title_color).";
				}
			";
		}
		if( !empty($text_color) ){
			$styles .= "
				#".$id." .rb_icons_wheel_module .icons_wheel_wrapper .icons_wheel_info .icons_wheel_description{
					color: ".esc_attr($text_color).";
				}
			";
		}
		if( !empty($circle_color) ){
			$styles .= "
				#".$id." .rb_icons_wheel_module .circle_wrapper{
					border-color: ".esc_attr($circle_color).";
				}
			";
		}
		if( !empty($shadow_color) ){
			$styles .= "
				#".$id." .rb_icons_wheel_module .icons_wheel_wrapper .icons_wheel_icon .icon_wrapper .icon{
					-webkit-box-shadow: 0 6px 24px 0 ".esc_attr($shadow_color).";
				    -moz-box-shadow: 0 6px 24px 0 ".esc_attr($shadow_color).";
				    box-shadow: 0 6px 24px 0 ".esc_attr($shadow_color).";
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
							#".$id." .icons_wheel_wrapper .icons_wheel_icon .icon_wrapper svg{
								-webkit-transform: scale(".$scale.");
							    -ms-transform: scale(".$scale.");
							    transform: scale(".$scale.");
							}
						";
					}
					if( !empty($icons_size_landscape) ){
						$styles .= "
							#".$id." .icons_wheel_wrapper .icons_wheel_icon .icon_wrapper i:before{
								font-size: ".(int)$icons_size_landscape."px;
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
							#".$id." .icons_wheel_wrapper .icons_wheel_icon .icon_wrapper svg{
								-webkit-transform: scale(".$scale.");
							    -ms-transform: scale(".$scale.");
							    transform: scale(".$scale.");
							}
						";
					}
					if( !empty($icons_size_portrait) ){
						$styles .= "
							#".$id." .icons_wheel_wrapper .icons_wheel_icon .icon_wrapper i:before{
								font-size: ".(int)$icons_size_portrait."px;
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
							#".$id." .icons_wheel_wrapper .icons_wheel_icon .icon_wrapper svg{
								-webkit-transform: scale(".$scale.");
							    -ms-transform: scale(".$scale.");
							    transform: scale(".$scale.");
							}
						";
					}
					if( !empty($icons_size_mobile) ){
						$styles .= "
							#".$id." .icons_wheel_wrapper .icons_wheel_icon .icon_wrapper i:before{
								font-size: ".(int)$icons_size_mobile."px;
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

 	/* -----> Icons Wheel classes <----- */
 	$extra_classes = 'style_'.esc_attr($style);
 	$extra_classes .= $hover_trigger ? ' on_hover' : '';

 	if( $autoplay ){
 		$extra_classes .= ' autoplay';
	 	$extra_atts .= !empty($autoplay_speed) ? "data-speed='".(int)esc_attr($autoplay_speed)."'" : "data-speed='3000'";
 	}

	/* -----> Icons Wheel module output <----- */
 	foreach ($values as $key) {
 		$counter ++;
 	}

	$out .= "<div id='".$id."' class='rb_icons_wheel_module_helper'>";
		$out .= "<div class='rb_icons_wheel_module ".$extra_classes." ".esc_attr($el_class)."' ".$extra_atts.">";
			$out .= "<div class='icons_wheel_wrapper childrens_".$counter."'>";
				$counter = 0;

				foreach ($values as $key) {
					$trigger = uniqid('wheel-item-');
					$mask = uniqid('mask_');
					$bg_gradient = uniqid('bg_gradient_');
					$shadow = uniqid('shadow_');
					$shadow_hover = uniqid('shadow_hover_');

					if( $counter <= 8 ){
						/* -----> Getting Icon <----- */
						$out .= "<div class='icons_wheel_icon' data-trigger='".$trigger."'>";
							if( !empty($key['icon_lib']) ){

								$icon = function_exists('rb_ext_vc_sc_get_icon') ? rb_ext_vc_sc_get_icon( $key ) : "";
								$icon = esc_attr( $icon );

								if( !empty($icon) ){

									$out .= "<div class='icon_wrapper".($counter == 0 ? ' active' : '')."'>";
										$out .= '<svg class="svg_shape" style="width:100px; height:100px;" xmlns="http://www.w3.org/2000/svg">';
											$out .= '<defs>
														<filter id="'.$shadow.'" height="200%">
													    	<feDropShadow dx="0" dy="6" stdDeviation="4" flood-color="'.$shadow_color.'" />
													    </filter>
													    <linearGradient id="'.$bg_gradient.'" x1="0%" y1="0%" x2="0%" y2="100%">
															<stop offset="0%" style="stop-color:'.$active_shape_gradient_1.'; stop-opacity:1" />
															<stop offset="100%" style="stop-color:'.$active_shape_gradient_2.'; stop-opacity:1" />
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
															$out .= '<polygon class="default" points="6,25 6,75 49.3,100 92.6,75 92.6,25 49.3,0" fill="'.$icon_shape_bg.'" mask="url(#'.$mask.')" />';
															$out .= '<polygon class="hover" points="6,25 6,75 49.3,100 92.6,75 92.6,25 49.3,0" fill="url(#'.$bg_gradient.')" mask="url(#'.$mask.')" />';
														} else {
															$out .= '<path class="default" d="M54.8,1.3l35.5,20.3c3,1.7,4.8,4.8,4.8,8.2v40.6c0,3.4-1.8,6.5-4.8,8.2L54.8,98.7c-3,1.7-6.6,1.7-9.5,0 L9.8,78.5c-3-1.7-4.8-4.8-4.8-8.2V29.7c0-3.4,1.8-6.5,4.8-8.2L45.2,1.3C48.2-0.4,51.8-0.4,54.8,1.3z" fill="'.$icon_shape_bg.'" mask="url(#'.$mask.')" />';
															$out .= '<path class="hover" d="M54.8,1.3l35.5,20.3c3,1.7,4.8,4.8,4.8,8.2v40.6c0,3.4-1.8,6.5-4.8,8.2L54.8,98.7c-3,1.7-6.6,1.7-9.5,0 L9.8,78.5c-3-1.7-4.8-4.8-4.8-8.2V29.7c0-3.4,1.8-6.5,4.8-8.2L45.2,1.3C48.2-0.4,51.8-0.4,54.8,1.3z" fill="url(#'.$bg_gradient.')" mask="url(#'.$mask.')" />';
														}
													} else if( $style == 'square' ){
														if( $sharp_corners ){
															$out .= '<rect class="default" width="100" height="100" fill="'.$icon_shape_bg.'" mask="url(#'.$mask.')" />';
															$out .= '<rect class="hover" width="100" height="100" fill="url(#'.$bg_gradient.')" mask="url(#'.$mask.')" />';
														} else {
															$out .= '<path class="default" d="M92,100H8c-4.4,0-8-3.6-8-8V8c0-4.4,3.6-8,8-8h84c4.4,0,8,3.6,8,8v84C100,96.4,96.4,100,92,100z" fill="'.$icon_shape_bg.'" mask="url(#'.$mask.')" />';
															$out .= '<path class="hover" d="M92,100H8c-4.4,0-8-3.6-8-8V8c0-4.4,3.6-8,8-8h84c4.4,0,8,3.6,8,8v84C100,96.4,96.4,100,92,100z" fill="url(#'.$bg_gradient.')" mask="url(#'.$mask.')" />';
														}
													} else if( $style == 'rhombus' ){
														if( $sharp_corners ){
															$out .= '<rect class="default" x="14.6" y="14.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -20.7107 50)" class="st0" width="70.7" height="70.7" fill="'.$icon_shape_bg.'" mask="url(#'.$mask.')" />';
															$out .= '<rect class="hover" x="14.6" y="14.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -20.7107 50)" class="st0" width="70.7" height="70.7" fill="url(#'.$bg_gradient.')" mask="url(#'.$mask.')" />';
														} else {
															$out .= '<path class="default" d="M60.5,4.4l35.1,35.1c5.8,5.8,5.8,15.2,0,21.1L60.5,95.6c-5.8,5.8-15.2,5.8-21.1,0L4.4,60.5 c-5.8-5.8-5.8-15.2,0-21.1L39.5,4.4C45.3-1.5,54.7-1.5,60.5,4.4z" fill="'.$icon_shape_bg.'" mask="url(#'.$mask.')" />';
															$out .= '<path class="hover" d="M60.5,4.4l35.1,35.1c5.8,5.8,5.8,15.2,0,21.1L60.5,95.6c-5.8,5.8-15.2,5.8-21.1,0L4.4,60.5 c-5.8-5.8-5.8-15.2,0-21.1L39.5,4.4C45.3-1.5,54.7-1.5,60.5,4.4z" fill="url(#'.$bg_gradient.')" mask="url(#'.$mask.')" />';
														}
													} else {
														$out .= '<circle class="default" cx="50" cy="50" r="50" fill="'.$icon_shape_bg.'" mask="url(#'.$mask.')" />';
														$out .= '<circle class="hover" cx="50" cy="50" r="50" fill="url(#'.$bg_gradient.')" mask="url(#'.$mask.')" />';
													}
											$out .= '</g>';
										$out .= '</svg>';

										$out .= "<i class='".$icon."'></i>";
									$out .= "</div>";
								}
							}
						$out .= "</div>";

						/* -----> Getting Info <----- */
						if( !empty($key['subtitle']) || !empty($key['title']) || !empty($key['description']) ){
							$out .= "<section class='icons_wheel_info".($counter == 0 ? ' active' : '')."' data-id='".$trigger."'>";
								$out .= "<div class='icons_icon_cell'>";
									/* -----> Getting Subtitle <----- */
									if( !empty($key['subtitle']) ){
										$out .= "<h6 class='icons_wheel_subtitle'>".esc_html($key['subtitle'])."</h6>";
									}
									/* -----> Getting Title <----- */
									if( !empty($key['title']) ){
										$out .= "<h5 class='icons_wheel_title'>".esc_html($key['title'])."</h5>";
									}
									/* -----> Getting Description <----- */
									if( !empty($key['description']) ){
										$out .= "<p class='icons_wheel_description'>".esc_html($key['description'])."</p>";
									}
								$out .= "</div>";
							$out .= "</section>";
						}
					}

					$counter ++;
				}

			$out .= "</div>";
			$out .= "<div class='circle_wrapper'></div>";
		$out .= "</div>";
	$out .= "</div>";

	
	return $out;
}
add_shortcode( 'rb_sc_icons_wheel', 'rb_vc_shortcode_sc_icons_wheel' );

?>