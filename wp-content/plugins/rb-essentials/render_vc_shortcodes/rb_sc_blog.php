<?php

function rb_vc_shortcode_sc_blog ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"post_tax"					=> "",
		"orderby"					=> "date",
		"order"						=> "DESC",
		"layout"					=> "def",
		"enable_masonry"			=> false,
		"enable_carousel"			=> false,
		"post_hide_meta_override"	=> false,
		"post_hide_meta"			=> "",
		"total_items_count"			=> "-1",
		"items_pp"					=> get_theme_mod("blog_posts_per_page"),
		"chars_count"				=> get_theme_mod('blog_chars_count'),
		"more_btn_text"				=> get_theme_mod('blog_read_more'),
		"thumb_size"				=> "full",
		"el_class"					=> "",
		/* -----> STYLING TAB <----- */
		"hover_animate"				=> false,
		"customize_size"			=> false,
		"title_size"				=> "24px",
		"title_lh"					=> "31px",
		"background_color"			=> "#fff",
		"title_color"				=> PRIMARY_COLOR,
		"text_color"				=> rb_Hex2RGBA( PRIMARY_COLOR, '0.8' ),
		"accent_color"				=> SECONDARY_COLOR,
		"meta_color"				=> PRIMARY_COLOR,
		"date_color"				=> PRIMARY_COLOR,
		"date_background"			=> "#FFF",
		"btn_font_color"			=> PRIMARY_COLOR,
		"btn_border_color"			=> '#E2E2E2',
		"btn_arrow_color"			=> SECONDARY_COLOR,
		"btn_background"			=> "#fff",
		"category_colors"			=> "default",
		"active_dot"				=> SECONDARY_COLOR,
		"arrows_color"				=> PRIMARY_COLOR,
	);

	$responsive_vars = array(
 		/* -----> RESPONSIVE TABS <----- */
 		"all" => array(
 			"custom_styles"		=> "",
 		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $tax_query = $count = "";
	$id = uniqid( "rb_blog_" );
	$total_items_count = $total_items_count == '-1' ? 999 : $total_items_count;
	if( $layout == 'def' ){
		$layout = get_theme_mod('blog_view') == 'large' ? '1' : get_theme_mod('blog_columns');	
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
				".$vc_desktop_styles."
			}
		";
	}
	if( $customize_size ){
		if( !empty($title_size) ){
			$styles .= "
				#".$id." .post-title{
					font-size: ".esc_attr($title_size).";
				}
			";
		}
		if( !empty($title_lh) ){
			$styles .= "
				#".$id." .post-title{
					line-height: ".esc_attr($title_lh).";
				}
			";
		}
	}
	if( !empty($background_color) ){
		$styles .= "
			#".$id." .post-inner{
				background-color: ".esc_attr($background_color).";
			}
		";
	}
	if( !empty($title_color) ){
		$styles .= "
			#".$id." .post-title a{
				color: ".esc_attr($title_color).";
			}
		";
	}
	if( !empty($text_color) ){
		$styles .= "
			#".$id." .post-content{
				color: ".esc_attr($text_color).";
			}
		";
	}
	if( !empty($accent_color) ){
		$styles .= "
			#".$id." .post-meta-wrapper .coments_count a:before{
				color: ".esc_attr($accent_color).";
			}
			#".$id." .blog_grid .content_inner .post .post-inner .post-meta-wrapper:before{
				background-color: ".esc_attr($accent_color).";
			}
		";
	}
	if( !empty($meta_color) ){
		$styles .= "
			#".$id." .post-meta-wrapper,
			#".$id." .post-meta-wrapper a{
				color: ".esc_attr($meta_color).";
			}
		";
	}
	if( $enable_carousel ){
		if( !empty($active_dot) ){
			$styles .= "
				#".$id." .slick-dots li.slick-active button{
					border-color: ".esc_attr($active_dot).";
				}
			";
		}
		if( !empty($arrows_color) ){
			$styles .= "
				#".$id." .rb_carousel .slick-arrow{
					color: ".esc_attr($arrows_color).";
				}
			";
		}
	}
	if( !empty($date_color) ){
		$styles .= "
			#".$id." .post-inner .post-media-wrapper .post-date a{
				color: ".esc_attr($date_color).";
			}
		";
	}
	if( !empty($date_background) ){
		$styles .= "
			#".$id." .post-inner .post-media-wrapper .post-date{
				background-color: ".esc_attr($date_background).";
			}
		";
	}
	if( !empty($btn_font_color) ){
		$styles .= "
			#".$id." .rb_button{
				color: ".esc_attr($btn_font_color).";
			}
		";
	}
	if( !empty($btn_border_color) ){
		$styles .= "
			#".$id." .rb_button{
				border-color: ".esc_attr($btn_border_color).";
			}
		";
	}
	if( !empty($btn_arrow_color) ){
		$styles .= "
			#".$id." .rb_button.simple:after{
				color: ".esc_attr($btn_arrow_color).";
			}
		";
	}
	if( !empty($btn_background) ){
		$styles .= "
			#".$id." .rb_button{
				background-color: ".esc_attr($btn_background).";
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
				#".$id."{
					".$vc_landscape_styles.";
				}
			}
		";
	}
	/* -----> End of landscape styles <----- */

	/* -----> Customize portrait styles <----- */
	if( !empty($vc_portrait_styles) ){
		$styles .= "
			@media screen and (max-width: 991px){
				#".$id."{
					".$vc_portrait_styles.";
				}
			}
		";
	}
	/* -----> End of portrait styles <----- */

	/* -----> Customize mobile styles <----- */
	if( !empty($vc_mobile_styles) ){
		$styles .= "
			@media screen and (max-width: 767px){
				#".$id."{
					".$vc_mobile_styles.";
				}
			}
		";
	}
	/* -----> End of mobile styles <----- */

	rb__vc_styles($styles);

	/* -----> Filter by Titles, Category, Tags, Formats <----- */
	$post_tax = $atts['post_tax'];
	
	if( 
		( !empty($post_tax) && $post_tax == 'category' && !empty($atts['post_category_terms']) ) ||
		( !empty($post_tax) && $post_tax == 'post_tag' && !empty($atts['post_post_tag_terms']) ) ||
		( !empty($post_tax) && $post_tax == 'post_format' && !empty($atts['post_post_format_terms']) )
	){
		$tax_query = array(
			array(
				"taxonomy"	=> $atts['post_tax'],
				"field"		=> "slug",
				"operator"	=> "IN"
			)
		);

		if( $atts['post_tax'] == 'category' ){
			$terms = $atts['post_category_terms'];
			$tax_query[0]['terms'] = strripos($terms, ',') ? explode(',', $terms) : $terms;
		} else if( $atts['post_tax'] == 'post_tag' ){
			$terms = $atts['post_post_tag_terms'];
			$tax_query[0]['terms'] = strripos($terms, ',') ? explode(',', $terms) : $terms;
		} else if( $atts['post_tax'] == 'post_format' ){
			$terms = $atts['post_post_format_terms'];
			$tax_query[0]['terms'] = strripos($terms, ',') ? explode(',', $terms) : $terms;
		}
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

	$query_atts = array(
		'post_type'				=> 'post',
		'post_status'			=> 'publish',
		'posts_per_page'		=> $items_pp,
		'paged'					=> $paged,
		'tax_query'				=> $tax_query,
		'orderby'				=> $orderby,
		'order'					=> $order,
		'ignore_sticky_posts'	=> true
	);

	if( !empty($post_tax) && $post_tax == 'title' && !empty($atts['titles']) ){
		$query_atts['post__in'] = explode(',', $atts['titles']);
	}

	/* -----> Blog module output <----- */
	$q = new WP_Query( $query_atts );

	if ( $q->have_posts() ):
		ob_start();

		echo "<div id='".$id."' class='rb_blog_module_wrapper".($hover_animate ? ' animate' : '')."'>";

			if( $layout == 'large' || $layout == '2' ){
				echo '<div class="blog blog_'. $layout . ( $enable_masonry && $layout == '2' ? " masonry" : "" ) .'">';

					if( $enable_carousel ){
						echo '<div class="rb_carousel_wrapper" data-columns="2" data-pagination="on" data-navigation="on" data-draggable="on">';
							echo '<div class="rb_carousel">';
					}

					while( $q->have_posts() && $count < $total_items_count ):
						$q->the_post(); 

						$extra_class = 'post';
					?>

						<div id="post-<?php the_ID() ?>" <?php post_class( $extra_class ) ?>>

							<div class="post-inner">
								<?php if( !empty(seoes__post_featured( $post_hide_meta )) ) : ?>
									<div class="post-media-wrapper">
										<!-- Featured Media -->
										<?php echo seoes__post_featured( $post_hide_meta, '', $thumb_size, $enable_carousel ) ?>

										<!-- Post Date -->
										<?php seoes__post_date( $post_hide_meta, 'complex' ) ?>
									</div>
								<?php endif; ?>
								
								<!-- Post Categories -->
								<?php seoes__post_category( $post_hide_meta, $category_colors ) ?>

								<!-- Post Title -->
								<?php seoes__post_title( $post_hide_meta ) ?>

								<?php if( !empty(seoes__the_content()) ) : ?>
									<!-- Post Content -->
									<div class="post-content">
										<?php echo seoes__the_content($chars_count, $more_btn_text, $post_hide_meta, 'simple') ?>
									</div>
								<?php endif; ?>
							
								<!-- Post Meta -->
								<?php seoes__post_meta($post_hide_meta) ?>
							</div>
						</div>
					<?php $count++; endwhile;

					if( $enable_carousel ){
							echo '</div>';
						echo '</div>';
					}

				echo '</div>';
			} else if( $layout == 'small' || $layout == 'checkerboard' ){
				echo '<div class="blog layout_'.$layout.'">';
					echo '<div class="content_inner">';

						if( $enable_carousel ){
							echo '<div class="rb_carousel_wrapper" data-columns="1" data-pagination="on" data-navigation="on" data-auto-height="on" data-draggable="on">';
								echo '<div class="rb_carousel">';
						}

						while( $q->have_posts() && $count < $total_items_count ):
							$q->the_post(); 

							$extra_class = 'post';
						?>
							<div id="post-<?php the_ID() ?>" <?php post_class( $extra_class ) ?>>
								<div class="post-inner">
									<?php if( !empty(seoes__post_featured( $post_hide_meta )) ) : ?>
										<div class="post-media-wrapper">
											<!-- Featured Media -->
											<?php echo seoes__post_featured( $post_hide_meta, '', $thumb_size, $enable_carousel ) ?>

											<!-- Post Date -->
											<?php seoes__post_date( $post_hide_meta, 'complex' ) ?>
										</div>
									<?php endif; ?>
									
									<div class='post-information'>
										<!-- Post Categories -->
										<?php seoes__post_category( $post_hide_meta, $category_colors ) ?>

										<!-- Post Title -->
										<?php seoes__post_title( $post_hide_meta ) ?>

										<?php if( !empty(seoes__the_content()) ) : ?>
											<!-- Post Content -->
											<div class="post-content"><?php echo seoes__the_content($chars_count, $more_btn_text, $post_hide_meta, 'simple') ?></div>
										<?php endif; ?>

										<!-- Post Meta -->
										<?php seoes__post_meta($post_hide_meta) ?>
									</div>
								</div>
							</div>
						<?php $count++; endwhile;

						if( $enable_carousel ){
								echo '</div>';
							echo '</div>';
						}

					echo '</div>';
				echo '</div>';
			} else {
				echo '<div class="blog blog_grid layout_'.$layout.'">';
					echo '<div class="content_inner'.($enable_masonry ? " masonry" : "").'" data-columns="'.$layout.'">';

						if( $enable_carousel ){
							echo '<div class="rb_carousel_wrapper" data-columns="'.esc_attr($layout).'" data-pagination="on" data-navigation="on" data-draggable="on">';
								echo '<div class="rb_carousel">';
						}

						while( $q->have_posts() && $count < $total_items_count ):
							$q->the_post(); 

							$extra_class = 'post';
						?>
							<div id="post-<?php the_ID() ?>" <?php post_class( $extra_class ) ?>>
								<div class="post-inner">
									<?php if( !empty(seoes__post_featured( $post_hide_meta )) ) : ?>
										<div class="post-media-wrapper">
											<!-- Featured Media -->
											<?php echo seoes__post_featured( $post_hide_meta, '', $thumb_size, $enable_carousel ) ?>

											<!-- Post Date -->
											<?php seoes__post_date( $post_hide_meta, 'complex' ) ?>
										</div>
									<?php endif; ?>
									
									<!-- Post Categories -->
									<?php seoes__post_category( $post_hide_meta, $category_colors ) ?>

									<!-- Post Title -->
									<?php seoes__post_title( $post_hide_meta ) ?>

									<!-- Post Meta -->
									<?php seoes__post_meta($post_hide_meta) ?>

									<?php 
										$content = seoes__the_content($chars_count, $more_btn_text, $post_hide_meta, 'simple');
										if( !empty($content) ) : 
									?>
										<!-- Post Content -->
										<div class="post-content">
											<?php echo $content; ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php $count++; endwhile;

						if( $enable_carousel ){
								echo '</div>';
							echo '</div>';
						}

					echo '</div>';
				echo '</div>';
			}

			if( !$enable_carousel ) seoes__pagination( $q, $total_items_count, $items_pp );

		echo "</div>";

		wp_reset_postdata();
		$out .= ob_get_clean();
	endif;

	return $out;
}
add_shortcode( 'rb_sc_blog', 'rb_vc_shortcode_sc_blog' );

?>