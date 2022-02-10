<?php

function rb_vc_shortcode_sc_banners ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"title"							=> "",
		"description"					=> "",
		"button_title"					=> "",
		"banner_url"					=> "#",
		"button_pos"					=> "default",
		"new_tab"						=> true,
		"el_class"						=> "",
		/* -----> STYLING TAB <----- */
		"customize_colors"				=> true,
		"text_color"					=> "#fff",
		"button_size"					=> 'medium',
	);

	$responsive_vars = array(
		"all" => array(
			"custom_styles"		=> "",
			"customize_size"	=> false,
			"title_size"		=> "25px",
			"title_lh"			=> "35px",
			"desc_size"			=> "17px",
			"desc_lh"			=> "30px",
			"customize_align"	=> false,
			"module_alignment"	=> "left",
		),
	);
	$responsive_vars = add_bg_properties($responsive_vars); //Add custom background properties to responsive vars array

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$id = uniqid( "rb_banner_" );
	$title = wp_kses( $title, array(
		"b"			=> array(),
		"strong"	=> array(),
		"mark"		=> array(),
		"br"		=> array()
	));
	$start_tag = empty($button_title) && !empty($banner_url) ? '<a href="'.esc_url($banner_url).'"'.($new_tab ? ' target="_blank"' : '') : '<div';
	$end_tag = empty($button_title) && !empty($banner_url) ? '</a>' : '</div>';
	
	/* -----> Visual Composer Responsive styles <----- */
	list( $vc_desktop_class, $vc_landscape_class, $vc_portrait_class, $vc_mobile_class ) = vc_responsive_styles($atts);

	preg_match("/(?<=\{).+?(?=\})/", $vc_desktop_class, $vc_desktop_styles); 
	$vc_desktop_styles = implode($vc_desktop_styles);
	$vc_desktop_styles .= "
		background-position: ".(!empty($custom_bg_position) ? $custom_bg_position : $bg_position ).";
		background-size: ".(!empty($custom_bg_size) ? $custom_bg_size : $bg_size ).";
		background-repeat: ".$bg_repeat.";
		". ($bg_display == '1' ? 'background-image: none !important;' : '') ."
	";

	preg_match("/(?<=\{).+?(?=\})/", $vc_landscape_class, $vc_landscape_styles);
	$vc_landscape_styles = implode($vc_landscape_styles);
	$vc_landscape_styles .= "
		background-position: ".(!empty($custom_bg_position_landscape) ? $custom_bg_position_landscape : $bg_position_landscape ).";
		background-size: ".(!empty($custom_bg_size_landscape) ? $custom_bg_size_landscape : $bg_size_landscape ).";
		background-repeat: ".$bg_repeat_landscape.";
		". ($bg_display_landscape == '1' ? 'background-image: none !important;' : '') ."
	";

	preg_match("/(?<=\{).+?(?=\})/", $vc_portrait_class, $vc_portrait_styles);
	$vc_portrait_styles = implode($vc_portrait_styles);
	$vc_portrait_styles .= "
		background-position: ".(!empty($custom_bg_position_portrait) ? $custom_bg_position_portrait : $bg_position_portrait ).";
		background-size: ".(!empty($custom_bg_size_portrait) ? $custom_bg_size_portrait : $bg_size_portrait ).";
		background-repeat: ".$bg_repeat_portrait.";
		". ($bg_display_portrait == '1' ? 'background-image: none !important;' : '') ."
	";

	preg_match("/(?<=\{).+?(?=\})/", $vc_mobile_class, $vc_mobile_styles);
	$vc_mobile_styles = implode($vc_mobile_styles);
	$vc_mobile_styles .= "
		background-position: ".(!empty($custom_bg_position_mobile) ? $custom_bg_position_mobile : $bg_position_mobile ).";
		background-size: ".(!empty($custom_bg_size_mobile) ? $custom_bg_size_mobile : $bg_size_mobile ).";
		background-repeat: ".$bg_repeat_mobile.";
		". ($bg_display_mobile == '1' ? 'background-image: none !important;' : '') ."
	";

	/* -----> Customize default styles <----- */
	if( !empty($vc_desktop_styles) ){
		$styles .= "
			#".$id."{
				".$vc_desktop_styles."
			}
		";
	}
	if( $customize_colors ){
		if( !empty($text_color) ){
			$styles .= "
				#".$id."{
					color: ".esc_attr($text_color).";
				}
				#".$id." .banner_divider{
					background-color: ".esc_attr($text_color).";
				}
			";
		}
	}
	if( $customize_align ){
		$styles .= "
			#".$id."{
				text-align: ".$module_alignment.";
			}
		";
	}
	if( $customize_size ){
		if( !empty($title_size) ){
			$styles .= "
				#".$id." .banner_title{
					font-size: ".esc_attr($title_size).";
				}
			";
		}
		if( !empty($title_lh) ){
			$styles .= "
				#".$id." .banner_title{
					line-height: ".esc_attr($title_lh).";
				}
			";
		}
		if( !empty($desc_size) ){
			$styles .= "
				#".$id." .banner_desc{
					font-size: ".esc_attr($desc_size).";
				}
			";
		}
		if( !empty($desc_lh) ){
			$styles .= "
				#".$id." .banner_desc{
					line-height: ".esc_attr($desc_lh).";
				}
			";
		}
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
			if( $customize_align_landscape ){
				$styles .= "
					#".$id."{
						text-align: ".$module_alignment_landscape.";
					}
				";
			}
			if( $customize_size_landscape ){
				if( !empty($title_size_landscape) ){
					$styles .= "
						#".$id." .banner_title{
							font-size: ".esc_attr($title_size_landscape).";
						}
					";
				}
				if( !empty($title_lh_landscape) ){
					$styles .= "
						#".$id." .banner_title{
							line-height: ".esc_attr($title_lh_landscape).";
						}
					";
				}
				if( !empty($desc_size_landscape) ){
					$styles .= "
						#".$id." .banner_desc{
							font-size: ".esc_attr($desc_size_landscape).";
						}
					";
				}
				if( !empty($desc_lh_landscape) ){
					$styles .= "
						#".$id." .banner_desc{
							line-height: ".esc_attr($desc_lh_landscape).";
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
			if( $customize_align_portrait ){
				$styles .= "
					#".$id."{
						text-align: ".$module_alignment_portrait.";
					}
				";
			}
			if( $customize_size_portrait ){
				if( !empty($title_size_portrait) ){
					$styles .= "
						#".$id." .banner_title{
							font-size: ".esc_attr($title_size_portrait).";
						}
					";
				}
				if( !empty($title_lh_portrait) ){
					$styles .= "
						#".$id." .banner_title{
							line-height: ".esc_attr($title_lh_portrait).";
						}
					";
				}
				if( !empty($desc_size_portrait) ){
					$styles .= "
						#".$id." .banner_desc{
							font-size: ".esc_attr($desc_size_portrait).";
						}
					";
				}
				if( !empty($desc_lh_portrait) ){
					$styles .= "
						#".$id." .banner_desc{
							line-height: ".esc_attr($desc_lh_portrait).";
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
			if( $customize_align_mobile ){
				$styles .= "
					#".$id."{
						text-align: ".$module_alignment_mobile.";
					}
				";
			}
			if( $customize_size_mobile ){
				if( !empty($title_size_mobile) ){
					$styles .= "
						#".$id." .banner_title{
							font-size: ".esc_attr($title_size_mobile).";
						}
					";
				}
				if( !empty($title_lh_mobile) ){
					$styles .= "
						#".$id." .banner_title{
							line-height: ".esc_attr($title_lh_mobile).";
						}
					";
				}
				if( !empty($desc_size_mobile) ){
					$styles .= "
						#".$id." .banner_desc{
							font-size: ".esc_attr($desc_size_mobile).";
						}
					";
				}
				if( !empty($desc_lh_mobile) ){
					$styles .= "
						#".$id." .banner_desc{
							line-height: ".esc_attr($desc_lh_mobile).";
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

	$module_classes = "rb_banner_module";
	$module_classes .= " button_".esc_attr($button_pos);
	$module_classes .= " align_".esc_attr($module_alignment);
	$module_classes .= $customize_align_landscape ? " landscape_align_".esc_attr($module_alignment_landscape) : '';
	$module_classes .= $customize_align_portrait ? " portrait_align_".esc_attr($module_alignment_portrait) : '';
	$module_classes .= $customize_align_mobile ? " mobile_align_".esc_attr($module_alignment_mobile) : '';
	$module_classes .= !empty($el_class) ? " ".esc_attr($el_class) : '';

	/* -----> Banner module output <----- */
	$out .= $start_tag." id='".$id."' class='".$module_classes."'>";
		$out .= "<div class='banner_desc_wrapper'>";
			if( !empty($title) ){
				$out .= "<p class='banner_title title_ff'>".$title."</p>";
			}
			if( !empty($description) ){
				$out .= "<span class='banner_divider'></span>";
				$out .= "<p class='banner_desc'>".esc_html($description)."</p>";
			}
		$out .= "</div>";
		if( !empty($button_title) ){
			$out .= "<a href='".esc_url($banner_url)."' ".($new_tab ? "target='_blank'" : "")." class='rb_button ".esc_attr($button_size)."'>".esc_html($button_title)."</a>";
		}
	$out .= $end_tag;

	return $out;
}
add_shortcode( 'rb_sc_banners', 'rb_vc_shortcode_sc_banners' );

?>