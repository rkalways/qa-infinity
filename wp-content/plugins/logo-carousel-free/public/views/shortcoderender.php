<?php
/**
 * This file render the shortcode to the frontend
 *
 * @package logo-carousel-free
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( ! class_exists( 'SPLC_Shortcode_Render' ) ) {
	/**
	 * Logo Carousel - Shortcode Render class
	 *
	 * @since 3.0
	 */
	class SPLC_Shortcode_Render {
		/**
		 * Single instance of the class
		 *
		 * @var mixed SPLC_Shortcode_Render single instance of the class
		 *
		 * @since 3.0
		 */
		protected static $_instance = null;


		/**
		 * Main SPLC Instance
		 *
		 * @since 3.0
		 * @static
		 * @return self Main instance
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * SPLC_Shortcode_Render constructor.
		 */
		public function __construct() {
			add_shortcode( 'logocarousel', array( $this, 'sp_logo_carousel_render' ) );
		}

		/**
		 * Full html show.
		 *
		 * @param array $post_id Shortcode ID.
		 * @param array $logo_data get all meta options.
		 * @param array $main_section_title shows section title.
		 */
		public static function splcp_html_show( $post_id, $logo_data, $main_section_title ) {
			$columns             = isset( $logo_data['lcp_number_of_columns'] ) ? $logo_data['lcp_number_of_columns'] : '';
			$items               = isset( $columns['lg_desktop'] ) ? $columns['lg_desktop'] : 5;
			$items_desktop       = isset( $columns['desktop'] ) ? $columns['desktop'] : 4;
			$items_desktop_small = isset( $columns['tablet'] ) ? $columns['tablet'] : 3;
			$items_tablet        = isset( $columns['mobile_landscape'] ) ? $columns['mobile_landscape'] : 2;
			$items_mobile        = isset( $columns['mobile'] ) ? $columns['mobile'] : 1;
			$total_items         = isset( $logo_data['lcp_number_of_total_items'] ) && $logo_data['lcp_number_of_total_items'] ? $logo_data['lcp_number_of_total_items'] : 10000;
			// Navigation.
			$nav_data = isset( $logo_data['lcp_nav_show'] ) ? $logo_data['lcp_nav_show'] : '';
			if ( 'show' === $nav_data ) {
				$nav        = 'true';
				$nav_mobile = 'true';
			} elseif ( 'hide_on_mobile' === $nav_data ) {
				$nav        = 'true';
				$nav_mobile = 'false';
			} else {
				$nav        = 'false';
				$nav_mobile = 'false';
			}
			$dots_data = isset( $logo_data['lcp_carousel_dots'] ) ? $logo_data['lcp_carousel_dots'] : '';
			if ( 'show' === $dots_data ) {
				$dots        = 'true';
				$dots_mobile = 'true';
			} elseif ( 'hide_on_mobile' === $dots_data ) {
				$dots        = 'true';
				$dots_mobile = 'false';
			} else {
				$dots        = 'false';
				$dots_mobile = 'false';
			}
			$auto_play      = isset( $logo_data['lcp_carousel_auto_play'] ) && $logo_data['lcp_carousel_auto_play'] ? 'true' : 'false';
			$pause_on_hover = isset( $logo_data['lcp_carousel_pause_on_hover'] ) && $logo_data['lcp_carousel_pause_on_hover'] ? 'true' : 'false';
			$swipe          = isset( $logo_data['lcp_carousel_swipe'] ) && $logo_data['lcp_carousel_swipe'] ? 'true' : 'false';
			$draggable      = isset( $logo_data['lcp_carousel_draggable'] ) && $logo_data['lcp_carousel_draggable'] ? 'true' : 'false';
			$infinite       = 'true';
			if ( isset( $logo_data['lcp_carousel_infinite'] ) ) {
				$infinite = $logo_data['lcp_carousel_infinite'] ? 'true' : 'false';
			}
			$logo_border = isset( $logo_data['lc_logo_border'] ) ? $logo_data['lc_logo_border'] : true;
			$rtl_mode    = isset( $logo_data['lcp_rtl_mode'] ) ? $logo_data['lcp_rtl_mode'] : 'false';
			$rtl         = ( 'true' == $rtl_mode ) ? 'rtl' : 'ltr';

			$autoplay_speed   = isset( $logo_data['lcp_carousel_auto_play_speed'] ) ? $logo_data['lcp_carousel_auto_play_speed'] : '3000';
			$pagination_speed = isset( $logo_data['lcp_carousel_scroll_speed'] ) ? $logo_data['lcp_carousel_scroll_speed'] : '600';
			$nav_color_data   = isset( $logo_data['lcp_nav_color'] ) ? $logo_data['lcp_nav_color'] : '';
			$nav_color        = isset( $nav_color_data['color1'] ) ? $nav_color_data['color1'] : '#aaaaaa';
			$nav_hover_color  = isset( $nav_color_data['color2'] ) ? $nav_color_data['color2'] : '#ffffff';
			$nav_bg           = isset( $nav_color_data['color3'] ) ? $nav_color_data['color3'] : '#f0f0f0';
			$nav_hover_bg     = isset( $nav_color_data['color4'] ) ? $nav_color_data['color4'] : '#16a08b';
			$nav_border       = isset( $logo_data['lcp_nav_border'] ) ? $logo_data['lcp_nav_border'] : '';

			$nav_border_width       = isset( $nav_border['all'] ) ? $nav_border['all'] : '1';
			$nav_border_style       = isset( $nav_border['style'] ) ? $nav_border['style'] : 'solid';
			$nav_border_color       = isset( $nav_border['color'] ) ? $nav_border['color'] : '#aaaaaa';
			$nav_border_hover_color = isset( $nav_border['hover_color'] ) ? $nav_border['hover_color'] : '#16a08b';
			$nav_border_width       = (int) $nav_border_width;

			$dots_color_data         = isset( $logo_data['lcp_carousel_dots_color'] ) ? $logo_data['lcp_carousel_dots_color'] : '';
			$dots_color              = isset( $dots_color_data['color1'] ) ? $dots_color_data['color1'] : '#dddddd';
			$dots_active_color       = isset( $dots_color_data['color2'] ) ? $dots_color_data['color2'] : '#16a08b';
			$logo_border             = isset( $logo_data['lcp_logo_border'] ) ? $logo_data['lcp_logo_border'] : '';
			$logo_border_width       = isset( $logo_border['all'] ) ? $logo_border['all'] : 1;
			$logo_border_style       = isset( $logo_border['style'] ) ? $logo_border['style'] : 'solid';
			$logo_border_color       = isset( $logo_border['color'] ) ? $logo_border['color'] : '#ddd';
			$logo_border_hover_color = isset( $logo_border['hover_color'] ) ? $logo_border['hover_color'] : '#ddd';

			$section_title               = isset( $logo_data['lcp_section_title'] ) ? $logo_data['lcp_section_title'] : 'false';
			$order_by                    = isset( $logo_data['lcp_item_order_by'] ) ? $logo_data['lcp_item_order_by'] : 'date';
			$order                       = isset( $logo_data['lcp_item_order'] ) ? $logo_data['lcp_item_order'] : 'ASC';
			$preloader                   = isset( $logo_data['lcp_preloader'] ) ? $logo_data['lcp_preloader'] : false;
			$show_image                  = isset( $logo_data['lcp_logo_image'] ) ? $logo_data['lcp_logo_image'] : true;
			$image_sizes                 = isset( $logo_data['lcp_image_sizes'] ) ? $logo_data['lcp_image_sizes'] : '';
			$show_image_title_attr       = isset( $logo_data['lcp_image_title_attr'] ) ? $logo_data['lcp_image_title_attr'] : false;
			$section_title_margin_bottom = isset( $logo_data['lcp_section_title_margin']['bottom'] ) ? $logo_data['lcp_section_title_margin']['bottom'] : '30';
			$logo_margin                 = isset( $logo_data['lcp_logo_margin']['all'] ) && ! empty( $logo_data['lcp_logo_margin']['all'] ) ? $logo_data['lcp_logo_margin']['all'] : '12';

			$args = new WP_Query(
				array(
					'post_type'      => 'sp_logo_carousel',
					'orderby'        => $order_by,
					'order'          => $order,
					'posts_per_page' => intval( $total_items ),
				)
			);

			wp_enqueue_style( 'sp-lc-swiper' );
			wp_enqueue_style( 'sp-lc-font-awesome' );
			wp_enqueue_style( 'sp-lc-style' );
			// Enqueue Script.
			wp_enqueue_script( 'sp-lc-swiper-js' );
			wp_enqueue_script( 'sp-lc-script' );

			// Custom CSS Added.
			$setting_data = get_option( '_sp_lcpro_options' );
			$custom_css   = trim( html_entity_decode( $setting_data['lcpro_custom_css'] ) );

			$output = '';
			ob_start();
			$output .= '<style type="text/css">';
			$output .= 'div#logo-carousel-free-' . esc_attr( $post_id ) . '.logo-carousel-free .sp-lc-logo{
				border: ' . esc_attr( $logo_border_width ) . 'px ' . esc_attr( $logo_border_style ) . ' ' . esc_attr( $logo_border_color ) . ';
			}';
			$output .= 'div#logo-carousel-free-' . esc_attr( $post_id ) . '.logo-carousel-free .sp-lc-logo:hover{
				border-color: ' . esc_attr( $logo_border_hover_color ) . ';
			}';
			if ( 'true' === $dots || 'true' === $dots_mobile ) {
				$output .= '#logo-carousel-free-' . esc_attr( $post_id ) . '.sp-lc-container .sp-logo-carousel {
					padding-bottom: 46px;
				}
				#logo-carousel-free-' . esc_attr( $post_id ) . '.sp-lc-container .sp-lc-pagination .swiper-pagination-bullet {
					background-color: ' . esc_attr( $dots_color ) . ';
				}
				#logo-carousel-free-' . esc_attr( $post_id ) . '.sp-lc-container .sp-lc-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active{background-color: ' . esc_attr( $dots_active_color ) . '; }
				';
			}
			if ( 'true' === $nav || 'true' === $nav_mobile ) {
				$output .= '#logo-carousel-free-' . esc_attr( $post_id ) . '.sp-lc-container .sp-logo-carousel {
					padding-top: 46px;
				}
				#logo-carousel-free-' . esc_attr( $post_id ) . '.sp-lc-container .sp-lc-button-prev,
				#logo-carousel-free-' . esc_attr( $post_id ) . '.sp-lc-container .sp-lc-button-next {
					color: ' . esc_attr( $nav_color ) . ';
					background: ' . esc_attr( $nav_bg ) . ';
					border: ' . esc_attr( $nav_border_width ) . 'px ' . esc_attr( $nav_border_style ) . ' ' . esc_attr( $nav_border_color ) . ';
					line-height: ' . ( 30 - 2 * $nav_border_width ) . 'px;
				}
				#logo-carousel-free-' . esc_attr( $post_id ) . '.sp-lc-container .sp-lc-button-prev:hover,
				#logo-carousel-free-' . esc_attr( $post_id ) . '.sp-lc-container .sp-lc-button-next:hover{
					background-color: ' . esc_attr( $nav_hover_bg ) . ';
					color: ' . esc_attr( $nav_hover_color ) . ';
					border-color: ' . esc_attr( $nav_border_hover_color ) . ';
				}';
			}
			$output .= '@media only screen and (max-width: 576px) {';
			if ( 'false' === $nav_mobile ) {
				$output .= '#logo-carousel-free-' . esc_attr( $post_id ) . '.sp-lc-container .sp-lc-button-prev,
					#logo-carousel-free-' . esc_attr( $post_id ) . '.sp-lc-container .sp-lc-button-next {
						display: none;
					}';
				if ( 'false' === $dots_mobile ) {
					$output .= '#logo-carousel-free-' . esc_attr( $post_id ) . '.sp-lc-container .sp-lc-pagination .swiper-pagination-bullet  {
							display: none;
						}';
				}
			}
			$output .= '}';
			if ( $preloader ) {
				$output .= ' .logo-carousel-free-area#logo-carousel-free-' . esc_attr( $post_id ) . '{
					position: relative;
				}
				#lcp-preloader-' . esc_attr( $post_id ) . '{
					position: absolute;
					left: 0;
					top: 0;
					height: 100%;
					width: 100%;
					text-align: center;
					display: flex;
					align-items: center;
					justify-content: center;
					background: #fff;
					z-index: 9999;
				}
				';
			}

			$output .= ' .logo-carousel-free-area#logo-carousel-free-' . esc_attr( $post_id ) . ' .sp-logo-carousel-section-title{
					margin-bottom: ' . esc_attr( $section_title_margin_bottom ) . 'px;
				}';

			$output .= $custom_css;
			$output .= '</style>';
			$output .= "<div id='logo-carousel-free-$post_id' class=\"logo-carousel-free logo-carousel-free-area sp-lc-container\">";
			// Preloader.
			$preloader_class = '';
			if ( $preloader ) {
				$preloader_class = ' lcp-preloader';
				$preloader_image = SP_LC_URL . 'public/assets/css/images/bx_loader.gif';
				if ( ! empty( $preloader_image ) ) {
					$output .= '<div id="lcp-preloader-' . esc_attr( $post_id ) . '" class="sp-logo-carousel-preloader"><img src="' . esc_url( $preloader_image ) . '"/></div>';
				}
			}

			if ( $section_title ) {
				$output .= '<h2 class="sp-logo-carousel-section-title">' . wp_kses_post( $main_section_title ) . '</h2>';
			}
			$output .= '<div id="sp-logo-carousel-id-' . esc_attr( $post_id ) . '" class="swiper-container sp-logo-carousel' . esc_attr( $preloader_class ) . '" dir="' . esc_attr( $rtl ) . '" data-carousel=\'{ "speed":' . esc_attr( $pagination_speed ) . ',"spaceBetween": ' . esc_attr( $logo_margin ) . ', "autoplay": ' . esc_attr( $auto_play ) . ', "infinite":' . esc_attr( $infinite ) . ', "autoplay_speed": ' . esc_attr( $autoplay_speed ) . ', "stop_onHover": ' . esc_attr( $pause_on_hover ) . ', "pagination": ' . esc_attr( $dots ) . ', "navigation": ' . esc_attr( $nav ) . ', "MobileNav": ' . esc_attr( $nav_mobile ) . ', "MobilePagi": ' . esc_attr( $dots_mobile ) . ', "simulateTouch": ' . esc_attr( $draggable ) . ', "allowTouchMove": ' . esc_attr( $swipe ) . ', "slidesPerView": { "lg_desktop": ' . esc_attr( $items ) . ', "desktop": ' . esc_attr( $items_desktop ) . ', "tablet": ' . esc_attr( $items_desktop_small ) . ', "mobile": ' . esc_attr( $items_mobile ) . ', "mobile_landscape": ' . esc_attr( $items_tablet ) . ' } }\'><div class="swiper-wrapper">';
			while ( $args->have_posts() ) :
				$args->the_post();
				$ids                  = get_the_ID();
				$lcp_thumb            = get_post_thumbnail_id();
				$image_url            = wp_get_attachment_image_src( $lcp_thumb, $image_sizes );
				$the_image_title_attr = the_title_attribute( array( 'echo' => false ) );
				$image_title_attr     = $show_image_title_attr ? $the_image_title_attr : '';
				$image                = has_post_thumbnail() && $show_image ? sprintf( '<img src="%1$s" title="%2$s" alt="%3$s" width="%4$s" height="%5$s">', esc_url( $image_url[0] ), esc_attr( $image_title_attr ), get_the_title(), esc_attr( $image_url[1] ), esc_attr( $image_url[2] ) ) : '';

				$output .= '<div class="swiper-slide"><div class="sp-lc-logo">' . $image . '</div></div>';
			endwhile;
			wp_reset_postdata();
			$output .= '</div>';
			if ( 'true' === $dots || 'true' === $dots_mobile ) {
				$output .= '<div class="sp-lc-pagination swiper-pagination dots"></div>';
			}
			if ( 'true' === $nav || 'true' === $nav_mobile ) {
				$output .= '<div class="sp-lc-button-next"><i class="fa fa-angle-right"></i></div>';
				$output .= '<div class="sp-lc-button-prev"><i class="fa fa-angle-left"></i></div>';
			}
			$output .= '</div>';
			$output .= '</div>';

			echo $output;
		}

		/**
		 * Shortcode render
		 *
		 * @param  mixed $attribute attributes.
		 * @return mixed
		 */
		public function sp_logo_carousel_render( $attribute ) {
			if ( empty( $attribute['id'] ) || ( get_post_status( $attribute['id'] ) === 'trash' ) || ( get_post_status( $attribute['id'] ) === 'draft' ) ) {
				return;
			}
			$post_id = $attribute['id'];

			// All Options of Shortcode.
			$logo_data          = get_post_meta( $post_id, 'sp_lcp_shortcode_options', true );
			$main_section_title = get_the_title( $post_id );
			self::splcp_html_show( $post_id, $logo_data, $main_section_title );
			return ob_get_clean();
		}

	}

	new SPLC_Shortcode_Render();
}
