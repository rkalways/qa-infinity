<?php
function rb_vc_shortcode_sc_icon_list ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"dir"							=> "column",
		"icon_bg"						=> false,
		"values"						=> "",
		"el_class"						=> "",
		/* -----> STYLING TAB <----- */
		"icons_color"					=> PRIMARY_COLOR,
		"icons_color_hover"				=> SECONDARY_COLOR,
		"icon_gradient_1"				=> "rgba(255,255,255, .05)",
		"icon_gradient_2"				=> "rgba(255,255,255, .05)",
	);

	$responsive_vars = array(
		"all" => array(
			"custom_styles"		=> "",
			"customize_align"	=> false,
			"alignment"			=> "left",
			"customize_size"	=> false,
			"icons_size"		=> "20px",
			"title_size"		=> "16px",
			"spacing"			=> "15px"
		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$values = (array)vc_param_group_parse_atts($values);
	$image = !empty($image) ? wp_get_attachment_image_src($image, 'full')[0] : '';
	$id = uniqid( "rb_icon_list_" );
	if( class_exists('WooCommerce') ){
		$rb_woocommerce = new Seoes_WooExt();
	}

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
				".$vc_desktop_styles.";
			}
		";
	}
	if( $customize_align ){
		$styles .= "
			#".$id."{
				text-align: ".esc_attr($alignment).";
			}
		";	
	}
	if( $customize_size ){
		if( !empty($icons_size) ){
			$styles .= "
				#".$id." i:before{
					font-size: ".(int)esc_attr($icons_size)."px;
				}
			";
			$styles .= "
				#".$id." .icon_wrapper svg{
					transform: scale(".(float)( ((int)esc_attr($icons_size) + 30) / 100 ).");
				}
			";
		}
		if( !empty($title_size) ){
			$styles .= "
				#".$id." .title{
					font-size: ".(int)esc_attr($title_size)."px;
				}
			";
		}
		if( !empty($spacing) ){
			$styles .= "
				#".$id.".direction_line > *{
					margin-right: ".(int)esc_attr($spacing)."px;
				}
				#".$id.".direction_column > * > *{
					margin-top: ".(int)esc_attr($spacing)."px;
				}
			";
		}
	}
	if( !empty($icons_color) ){
		$styles .= "
			#".$id." > a,
			#".$id." > .mini-cart > a,
			#".$id." .wpml-ls-statics-shortcode_actions .wpml-ls-current-language > a{
				color: ".esc_attr($icons_color).";
			}
			#".$id.".header_icons > * ~ .mini-cart:not(:first-child) .woo_mini-count{
				border-color: ".esc_attr($icons_color).";
			}		
		";
	}
	if( !empty($icons_color_hover) ){
		$styles .= "
			@media 
				screen and (min-width: 1367px), /*Disable this styles for iPad Pro 1024-1366*/
				screen and (min-width: 1200px) and (any-hover: hover), /*Check, is device a desktop (Not working on IE & FireFox)*/
				screen and (min-width: 1200px) and (min--moz-device-pixel-ratio:0), /*Check, is device a desktop with firefox*/
				screen and (min-width: 1200px) and (-ms-high-contrast: none), /*Check, is device a desktop with IE 10 or above*/
				screen and (min-width: 1200px) and (-ms-high-contrast: active) /*Check, is device a desktop with IE 10 or above*/
			{
				#".$id." > a:hover,
				#".$id." > .mini-cart > a:hover,
				#".$id." .wpml-ls-statics-shortcode_actions .wpml-ls-current-language > a:hover{
					color: ".$icons_color_hover.";
				}
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
			if( $customize_size_landscape ){
				if( !empty($icons_size_landscape) ){
					$styles .= "
						#".$id." *:before{
							font-size: ".(int)esc_attr($icons_size_landscape)."px;
						}
					";
				}
				if( !empty($title_size_landscape) ){
					$styles .= "
						#".$id." .title{
							font-size: ".(int)esc_attr($title_size_landscape)."px;
						}
					";	
				}
				if( !empty($spacing_landscape) ){
					$styles .= "
						#".$id.".direction_line > *{
							margin-right: ".(int)esc_attr($spacing_landscape)."px;
						}
						#".$id.".direction_column > * > *{
							margin-top: ".(int)esc_attr($spacing_landscape)."px;
						}
					";
				}
			}
			if( $customize_align_landscape ){
				$styles .= "
					#".$id."{
						text-align: ".esc_attr($alignment_landscape).";
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
		$customize_align_portrait || 
		$customize_size_portrait 
	){
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
			if( $customize_size_portrait ){
				if( !empty($icons_size_portrait) ){
					$styles .= "
						#".$id." *:before{
							font-size: ".(int)esc_attr($icons_size_portrait)."px;
						}
					";
				}
				if( !empty($title_size_portrait) ){
					$styles .= "
						#".$id." .title{
							font-size: ".(int)esc_attr($title_size_portrait)."px;
						}
					";	
				}
				if( !empty($spacing_portrait) ){
					$styles .= "
						#".$id.".direction_line > *{
							margin-right: ".(int)esc_attr($spacing_portrait)."px;
						}
						#".$id.".direction_column > * > *{
							margin-top: ".(int)esc_attr($spacing_portrait)."px;
						}
					";
				}
			}
			if( $customize_align_portrait ){
				$styles .= "
					#".$id."{
						text-align: ".esc_attr($alignment_portrait).";
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
		$customize_align_mobile || 
		$customize_size_mobile
	){
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
			if( $customize_size_mobile ){
				if( !empty($icons_size_mobile) ){
					$styles .= "
						#".$id." *:before{
							font-size: ".(int)esc_attr($icons_size_mobile)."px;
						}
					";
				}
				if( !empty($title_size_mobile) ){
					$styles .= "
						#".$id." .title{
							font-size: ".(int)esc_attr($title_size_mobile)."px;
						}
					";	
				}
				if( !empty($spacing_mobile) ){
					$styles .= "
						#".$id.".direction_line > *{
							margin-right: ".(int)esc_attr($spacing_mobile)."px;
						}
						#".$id.".direction_column > * > *{
							margin-top: ".(int)esc_attr($spacing_mobile)."px;
						}
					";
				}
			}
			if( $customize_align_mobile ){
				$styles .= "
					#".$id."{
						text-align: ".esc_attr($alignment_mobile).";
					}
				";	
			}

		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */

	rb__vc_styles($styles);

	$module_classes = 'rb_icon_list_module';
	$module_classes .= ' header_icons';
	$module_classes .= ' direction_'.esc_attr($dir);
	$module_classes .= $icon_bg ? ' icon_bg' : '';
	$module_classes .= !empty($el_class) ? ' '.esc_attr($el_class) : '';

	$module_classes .= $customize_align ? ' align_'.esc_attr($alignment) : '';
	$module_classes .= $customize_align_landscape ? ' landscape_align_'.esc_attr($alignment_landscape) : '';
	$module_classes .= $customize_align_portrait ? ' portrait_align_'.esc_attr($alignment_portrait) : '';
	$module_classes .= $customize_align_mobile ? ' mobile_align_'.esc_attr($alignment_mobile) : '';

	/* -----> Filter Products module output <----- */
	$out .= "<div id='".$id."' class='".$module_classes."'>";

		foreach( $values as $value ){
			$title = !empty($value['title']) ? esc_html($value['title']) : '';
			$url = !empty($value['url']) ? esc_url($value['url']) : '';
			$sidebar = !empty($value['sidebar']) ? esc_attr($value['sidebar']) : '';
			$value['icon_lib'] = !empty($value['icon_lib']) ? $value['icon_lib'] : 'flaticon';

			if( $value['icon_lib'] == 'flaticon' && !empty($value['icon_rb_flaticons']) ){
				$icon = esc_attr($value['icon_rb_flaticons']);
			} else if( $value['icon_lib'] == 'fontawesome' && !empty($value['icon_fontawesome']) ){
				$icon = esc_attr($value['icon_fontawesome']);
			} else {
				$icon = '';
			}

			$gradient = uniqid('gradient_');

			switch( $value['function'] ){
				case 'sidebar':
					$out .= "<a href='#' class='custom_sidebar_trigger' data-sidebar='".esc_attr($sidebar)."'>";
						if( $icon_bg ){
							$out .= "<div class='icon_wrapper'>";

								$out .= '<svg style="width:100px; height:100px;" xmlns="http://www.w3.org/2000/svg">';
									$out .= '<defs>
										<linearGradient id="'.esc_attr($gradient).'" x1="0%" y1="0%" x2="0%" y2="100%">
											<stop offset="0%" style="stop-color:'.esc_attr($icons_bg).'; stop-opacity:1" />
											<stop offset="100%" style="stop-color:'.esc_attr($icons_bg).'; stop-opacity:1" />
										</linearGradient>
									</defs>';
									$out .= '<polygon class="st0" points="6,25 6,75 49.3,100 92.6,75 92.6,25 49.3,0" fill="url(#'.esc_attr($gradient).')"/>';
								$out .= '</svg>';
								$out .= "<i class='".$icon."'></i>";
								
							$out .= "</div>";
						}
						$out .= "<span class='title'>".$title."</span>";
					$out .= "</a>";
					break;
				case 'cart':
					if( class_exists('WooCommerce') ){
						$out .= $rb_woocommerce->rb_woocommerce_get_mini_cart();
					}
					break;
				case 'wpml':
					if( class_exists('SitePress') ){
						ob_start();
							do_action('wpml_add_language_selector');
						$out .= ob_get_clean();
					}
					break;
				case 'rb_search':
					$out .= "<a class='search-trigger'>";
						$out .= "<span class='title'>".$title."</span>";
					$out .= "</a>";
					break;
				case 'custom':
					if( $value['type'] == 'phone' ){
						$link = 'tel:'.$value['url'];
					} else if( $value['type'] == 'mail' ){
						$link = 'mailto:'.$value['url'];
					} else {
						$link = $value['url'];
					}

					$out .= "<a href='".esc_url($link)."' class='custom_url'>";
						if( $icon_bg ){
							$out .= "<div class='icon_wrapper'>";

								$out .= '<svg style="width:100px; height:100px;" xmlns="http://www.w3.org/2000/svg">';
									$out .= '<defs>
										<linearGradient id="'.esc_attr($gradient).'" x1="0%" y1="0%" x2="0%" y2="100%">
											<stop offset="0%" style="stop-color:'.esc_attr($icon_gradient_1).'; stop-opacity:1" />
											<stop offset="100%" style="stop-color:'.esc_attr($icon_gradient_2).'; stop-opacity:1" />
										</linearGradient>
									</defs>';
									$out .= '<polygon class="st0" points="6,25 6,75 49.3,100 92.6,75 92.6,25 49.3,0" fill="url(#'.esc_attr($gradient).')"/>';
								$out .= '</svg>';
								$out .= "<i class='".$icon."'></i>";

							$out .= "</div>";
						} else {
							$out .= "<i class='".$icon."'></i>";
						}
						$out .= "<span class='title'>".$title."</span>";
					$out .= "</a>";
					break;
			}
		}

	$out .= "</div>";

	return $out;
}
add_shortcode( 'rb_sc_icon_list', 'rb_vc_shortcode_sc_icon_list' );

?>