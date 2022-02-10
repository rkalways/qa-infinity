<?php 
defined( 'ABSPATH' ) or die(); ?>

<!-- #site-header-mobile -->
<div id="site-header-mobile" class="site-header-mobile">
	<div class="header-content">
		<div class="top-bar-box">
			<div class="container">
				<div class="site_logotype">
					<a href="<?php echo esc_url( home_url('') ) ?>">
						<?php seoes_logo('mobile_top_bar_logotype', 'mobile_top_bar_logo_dimensions', 'h3') ?>
					</a>
				</div>
				<div class="header_icons">
					<?php if( class_exists('WooCommerce') && get_theme_mod('mobile_show_minicart') ) :
						$rb_woocommerce = new Seoes_WooExt();

						echo sprintf('%s', $rb_woocommerce->rb_woocommerce_get_mini_cart());
					endif; ?>
					<div class="menu-trigger">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
			</div>
		</div>
		<div class="menu-box container">
			<div class="menu-box-logo">
				<a href="<?php echo esc_url( home_url('') ) ?>">
					<?php seoes_logo('mobile_menu_logotype', 'mobile_menu_logo_dimensions', 'h3') ?>
				</a>
			</div>
			<div class="main-menu-wrapper">
				<nav class="menu-main-container">
					<?php wp_nav_menu( main_menu_args() ) ?>
				</nav>
			</div>
			<div class="menu-box-search">
				<?php get_search_form() ?>
			</div>
			<?php if( class_exists('SitePress') ) : ?>
				<div class='menu-box-wpml'>
					<?php do_action('wpml_add_language_selector'); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php if( !is_front_page() && !is_404() ) : ?>
			<?php
				$title_img = !empty(rb_get_metabox('title_image')) ? rb_get_metabox('title_image') : get_theme_mod('title_area_bg') ;
				$dynamic_img = !empty(rb_get_metabox('title_interactive_image')) ? rb_get_metabox('title_interactive_image') : get_theme_mod('title_area_interactive');

				$dynamic_image = !empty($dynamic_img) ? wp_get_attachment_image_src( $dynamic_img, 'full' )[0] : '';

				$title_extra_classes = get_theme_mod('title_area_mask') ? ' masked' : '';

				$title_extra_styles = 'style="';
				$title_extra_styles .= !empty(get_theme_mod('title_custom_gradient_css')) ? esc_attr(get_theme_mod('title_custom_gradient_css')) : '';
				$title_extra_styles .= !empty($title_img) ? 'background-image: url('.wp_get_attachment_image_src( $title_img, "full" )[0].');' : '';
				$title_extra_styles .= '"';

			?>
			<?php if( empty(rb_get_metabox('slider_shortcode')) && (!get_theme_mod('disable_title_mobile')) ): ?>
				<div class="page_title_container<?php echo sprintf('%s', $title_extra_classes) ?>" <?php echo sprintf('%s', $title_extra_styles) ?>>
					
					<?php if( rb_get_metabox('title_interactive_remove') != 'on' && !empty($dynamic_image) ) : ?>
						<img data-depth="0.80" src="<?php echo esc_url($dynamic_image) ?>" class="page_title_dynamic_image" alt="<?php the_title_attribute() ?>" />
					<?php endif; ?>

					<div class="page_title_wrapper container">
						<?php
							if( is_singular('post') ){
								echo "<div class='single_post_categories title_ff'>";
									the_category(' ');
								echo "</div>";
							}
						?>
						<div class="page_title_customizer_size">
							<h1 class="page_title">
								<?php echo rb_get_page_title() ?>
							</h1>
						</div>
						<?php
							if( is_singular('post') ){
								$comments = get_comments_number();

								echo "<div class='single_post_meta'>";
									// Author
									echo get_the_author_posts_link();
									// Date
									$date = get_day_link((int)get_the_date('Y'), (int)get_the_date('m'), (int)get_the_date('d'));

									echo "<a href='".esc_url($date)."'>".esc_html( get_the_date( get_option( 'date_format' ) ) )."</a>";
									// Comments
									if( $comments != '0' ){
										echo "<span class='coments_count'><a href='#comments'>".get_comments_number()."</a></span>";
									}
								echo "</div>";
							}
						?>
						<span class="title_divider"></span>
						<?php get_template_part( 'tmpl/header-breadcrumbs' ); ?>
					</div>
				</div>
			<?php endif; ?>
		<?php else : ?>
			<?php get_template_part( 'tmpl/header-breadcrumbs' ); ?>
		<?php endif; ?>
	</div>			
</div>
<!-- \#site-header-mobile -->