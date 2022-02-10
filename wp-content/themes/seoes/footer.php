<?php
defined( 'ABSPATH' ) or die();
?>	

						</div>
						<!-- /.main-content-inner-wrap -->
					</div>
					<!-- /.main-content-inner -->
				<?php 
					if( class_exists('WooCommerce') && (is_shop() || is_product()) ){
						echo '</div>';
					} else {
						echo '</main>';
					}
				?>
				<!-- /.main-content -->		
			</div>
			<!-- /.site-content -->

			<?php
				if( has_action('rb_custom_footer') && !empty( get_post_meta(get_the_id(), 'rbhf_mb_post', true)['footer'] ) ){
					do_action('rb_custom_footer');
				} else {
					if( function_exists('rb_hf_init') && get_theme_mod('custom_footer') != 'default' ){
						$custom_footer = get_post_field( 'post_content', get_theme_mod('custom_footer') );
						if( !empty($custom_footer) ){
							$vc_custom_css = get_post_meta( get_theme_mod('custom_footer'), '_wpb_shortcodes_custom_css', true );
							rb__vc_styles($vc_custom_css);

							echo "<div class='rb_footer_template".( get_theme_mod('sticky_footer') ? ' sticky_footer' : '' )."'>";
								echo "<div class='container'>";
									echo do_shortcode($custom_footer);
								echo "</div>";
							echo "</div>";
						}
					} else {
						get_template_part( 'tmpl/footer' );
					}
				}
			?>

			<div class="ajax_preloader body_loader">
				<div class="dots-wrapper">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>

			<div class="button-up"></div>
		</div>
		<!-- /.site-wrapper -->

		<div id="frame">
			<span class="frame_top"></span>
			<span class="frame_right"></span>
			<span class="frame_bottom"></span>
			<span class="frame_left"></span>
		</div>
		
		<?php wp_footer() ?>
	</body>
</html>