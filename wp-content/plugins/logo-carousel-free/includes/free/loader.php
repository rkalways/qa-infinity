<?php

/**
 * The Free Loader Class
 *
 * @package logo-carousel-free
 * @since 3.0
 */
class SPLC_Free_Loader {

	/**
	 * Free Loader constructor
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 80 );
		require_once SP_LC_PATH . 'admin/views/scripts.php';
		require_once SP_LC_PATH . 'public/views/shortcoderender.php';
	}

	/**
	 * Admin Menu
	 *
	 * @return void
	 */
	public function admin_menu() {
		add_submenu_page( 'edit.php?post_type=sp_logo_carousel', __( 'Logo Carousel Pro', 'logo-carousel-free' ), __( 'Premium', 'logo-carousel-free' ), 'manage_options', 'lc_upgrade', array( $this, 'premium_page_callback' ) );
		add_submenu_page( 'edit.php?post_type=sp_logo_carousel', __( 'Logo Carousel Help', 'logo-carousel-free' ), __( 'Help', 'logo-carousel-free' ), 'manage_options', 'lc_help', array( $this, 'help_page_callback' ) );
	}

	/**
	 * Happy users.
	 *
	 * @param boolean $username username.
	 * @param array   $args args.
	 * @return statement
	 */
	public function happy_users( $username = 'shapedplugin', $args = array() ) {
		if ( $username ) {
			$params = array(
				'timeout'   => 10,
				'sslverify' => false,
			);

			$raw = wp_remote_retrieve_body( wp_remote_get( 'http://wptally.com/api/' . $username, $params ) );
			$raw = json_decode( $raw, true );

			if ( array_key_exists( 'error', $raw ) ) {
				$data = array(
					'error' => $raw['error'],
				);
			} else {
				$data = $raw;
			}
		} else {
			$data = array(
				'error' => __( 'No data found!', 'logo-carousel-free' ),
			);
		}

		return $data;
	}

	/**
	 * Premium Page Callback
	 *
	 * @return void
	 */
	public function premium_page_callback() {
		wp_enqueue_style( 'sp-lc-admin-premium', SP_LC_URL . 'admin/assets/css/premium-page.min.css', array(), SP_LC_VERSION );
		wp_enqueue_style( 'sp-lc-admin-premium-modal', SP_LC_URL . 'admin/assets/css/modal-video.min.css', array(), SP_LC_VERSION );
		wp_enqueue_script( 'sp-lc-admin-premium', SP_LC_URL . 'admin/assets/js/jquery-modal-video.min.js', array( 'jquery' ), SP_LC_VERSION, true );
		?>
	<div class="sp-logo-carousel__premium-page">
		<!-- Banner section start -->
		<section class="sp-lc__banner">
			<div class="sp-lc__container">
				<div class="row">
					<div class="sp-lc__col-xl-6">
						<div class="sp-lc__banner-content">
							<h2 class="sp-lc__font-30 main-color sp-lc__font-weight-500"><?php echo esc_html__( 'Upgrade To Logo Carousel Pro', 'logo-carousel-free' ); ?></h2>
							<h4 class="sp-lc__mt-10 sp-lc__font-18 sp-lc__font-weight-500"><?php echo esc_html__( 'Multi-Use Responsive Logo Showcase Plugin for WordPress', 'logo-carousel-free' ); ?></h4>
							<p class="sp-lc__mt-25 text-color-2 line-height-20 sp-lc__font-weight-400"><?php echo esc_html__( 'Display a list of clients, sponsors, partners, affiliates, supporters, suppliers, brands logos on your WordPress website.', 'logo-carousel-free' ); ?></p>
							<p class="sp-lc__mt-20 text-color-2 sp-lc__line-height-20 sp-lc__font-weight-400"><?php echo esc_html__( 'Create a Carousel, Grid, Isotope Filter, List, and Inline view of logo images with Title, Description, Read more, Tooltips, Links (Internal or External) and Popup, etc.', 'logo-carousel-free' ); ?></p>
						</div>
						<div class="sp-lc__banner-button sp-lc__mt-40">
							<a class="sp-lc__btn sp-lc__btn-sky" href="https://shapedplugin.com/plugin/logo-carousel-pro/?ref=1" target="_blank">Upgrade To Pro Now</a>
							<a class="sp-lc__btn sp-lc__btn-border ml-16 sp-lc__mt-15" href="https://demo.shapedplugin.com/logo-carousel/" target="_blank">Live Demo</a>
						</div>
					</div>
					<div class="sp-lc__col-xl-6">
						<div class="sp-lc__banner-img">
							<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/lc-vector.svg'; ?>" alt="">
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Banner section End -->

		<!-- Count section Start -->
		<section class="sp-lc__count">
			<div class="sp-lc__container">
				<div class="sp-lc__count-area">
					<div class="count-item">
						<h3 class="sp-lc__font-24">
						<?php
						$plugin_data  = $this->happy_users();
						$plugin_names = array_values( $plugin_data['plugins'] );

						$active_installations = array_column( $plugin_names, 'installs', 'url' );
						echo esc_attr( $active_installations['http://wordpress.org/plugins/logo-carousel-free'] ) . '+';
						?>
						</h3>
						<span class="sp-lc__font-weight-400">Active Installations</span>
					</div>
					<div class="count-item">
						<h3 class="sp-lc__font-24">
						<?php
						$active_installations = array_column( $plugin_names, 'downloads', 'url' );
						echo esc_attr( $active_installations['http://wordpress.org/plugins/logo-carousel-free'] );
						?>
						</h3>
						<span class="sp-lc__font-weight-400">all time downloads</span>
					</div>
					<div class="count-item">
						<h3 class="sp-lc__font-24">
						<?php
						$active_installations = array_column( $plugin_names, 'rating', 'url' );
						echo esc_attr( $active_installations['http://wordpress.org/plugins/logo-carousel-free'] ) . '/5';
						?>
						</h3>
						<span class="sp-lc__font-weight-400">user reviews</span>
					</div>
				</div>
			</div>
		</section>
		<!-- Count section End -->

		<!-- Video Section Start -->
		<section class="sp-lc__video">
			<div class="sp-lc__container">
				<div class="section-title text-center">
					<h2 class="sp-lc__font-28">Professional looking Logo Showcase for WordPress</h2>
					<h4 class="sp-lc__font-16 sp-lc__mt-10 sp-lc__font-weight-400">Learn why Logo Carousel Pro is the best Logo Showcase plugin.</h4>
				</div>
				<div class="video-area text-center">
					<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/lc-vector-2.svg'; ?>" alt="">
					<div class="video-button">
						<a class="js-video-button" href="#" data-channel="youtube" data-video-url="//www.youtube.com/embed/LpeZBT8Y-9Y">
							<span><i class="fa fa-play"></i></span>
						</a>
					</div>

				</div>
			</div>
		</section>
		<!-- Video Section End -->

		<!-- Features Section Start -->
		<section class="sp-lc__feature">
			<div class="sp-lc__container">
				<div class="section-title text-center">
					<h2 class="sp-lc__font-28">Key Pro Features</h2>
					<h4 class="sp-lc__font-16 sp-lc__mt-10 sp-lc__font-weight-400">Upgrading to Logo Carousel Pro will get you the following amazing benefits.</h4>
				</div>
				<div class="feature-wrapper">
					<div class="feature-area">
						<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/layouts.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">5 Logo Layout Presets</h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">You can display a set of logo images in 5 different beautiful layouts presets: Carousel, Grid, List, Isotope Filter, and Inline. All the layout presets are highly customizable with numerous features.</p>
							</div>
						</div>

						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="
								<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/design-without-writing-CSS.svg'; ?>
								" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">Design without Writing CSS (Typography)</h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">Set font family, size, weight, text-transform, alignment, etc. to match your brand. No coding skills are needed! The Pro version supports 950+ Google fonts and typography options.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
					<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="
								<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/drag-and-drop.svg'; ?>
								" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">Drag & Drop Logo ordering</h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">Drag & Drop Logo ordering is one of the amazing features of Logo Carousel Pro. You can order your logos easily by the drag & drop feature and also order by date, title, random, etc.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/link.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">Internal & External Logo links</h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">You can set URLs to them, they can have links that can open on the same page or a new page. If you don’t add any URL for the particular logo, the logo will not be linked up.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
					<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/group-and-specific.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">Display Group-wise or Specific Logo </h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">Manage your logos by grouping them into separate categories based on your demand. Create the unlimited category for logos and display logos from particular or selected categories.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/filter.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">Isotope Filtering by Categories</h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">Group your logo images by categories and display only a selected category or all of them! This way you can even have a list for clients, other lists for sponsors, and so on!</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
					<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/live-filter.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">Live Category Filter!</h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">In the Grid layouts, you can also include a live category filter, so your visitors can select which logos to see. Opacity will be on the logo and change the opacity you need.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/carousel-controls.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">25+ Carousel Controls</h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">Carousel Controls e.g. 6 Navigation arrows & 9 positions, pagination dots, autoplay & speed, pause on hover, looping, Touch Swipe, scroll, key navigation, mouse draggable, mouse wheel, etc.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
					<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/carousel-mode.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">Carousel Mode, Horizontal, and Vertical</h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">Logo Carousel Pro has three(3) carousel modes: Standard, Ticker (smooth looping, with no pause), and Center. The plugin has both Horizontal and Vertical carousel directions.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/multiple-row.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">Multiple Logo Rows </h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">You can add and slide the unlimited number of rows at a time in the carousel layout with the premium version. We normally set a single row by default. Set the number of rows based on your choice.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
						<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/popup.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">Popup View for Logo Detail</h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">Display logo details like Logo, Title, Description, etc. in a Popup view. Make your logo showcase a visually appealing popup full view and customize the popup content easily.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/modern-effects.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">Logo Effects and Re-sizing</h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">We have set different logo image hover effects like, Grayscale, Zoom In, Zoom out, Blur, Opacity, etc. that are both edgy and appealing. You can resize your logo images to your desired dimension.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
						<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/advanced-settings.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">Advanced Plugin Settings</h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">The plugin is completely customizable and also added a custom CSS field option to override styles. You can also enqueue or dequeue scripts/CSS to avoid conflicts and loading issues.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/translation-ready.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">Multisite, Multilingual, RTL, Accessibility Ready</h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">The plugin is Multisite, Multilingual, RTL, and Accessibility ready. For Arabic, Hebrew, Persian, etc. languages, you can select the right-to-left option for slider direction, without writing any CSS.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
						<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/page-builders.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">Page Builders & Countless Theme Compatibility</h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">The plugin works smoothly with the popular themes and page builders plugins, e,g: Gutenberg, WPBakery, Elementor/Pro, Divi builder, BeaverBuilder, Fusion Builder, SiteOrgin, Themify Builder, etc.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/support.svg'; ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-lc__font-18 sp-lc__font-weight-600">Top-notch Support and Frequently Updates</h3>
								<p class="sp-lc__font-15 sp-lc__mt-15 sp-lc__line-height-24">Our dedicated top-notch support team is always ready to offer you world-class support and help when needed. Our engineering team is continuously working to improve the plugin and release new versions!</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Features Section End -->

		<!-- Buy Section Start -->
		<section class="sp-lc__buy">
			<div class="sp-lc__container">
				<div class="row">
					<div class="sp-lc__col-xl-12">
						<div class="buy-content text-center">
						<div class="buy_img">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/premium/happy-user.svg'; ?>" alt="">
							</div>
							<h2 class="sp-lc__font-28">
							Join
							<?php
							$install = 0;
							foreach ( $plugin_names as &$plugin_name ) {
								$install += $plugin_name['installs'];
							}
							echo esc_attr( $install + '15000' ) . '+';
							?>
							Happy Users in 160+ Countries
							</h2>
							<p class="sp-lc__font-16 sp-lc__mt-25 sp-lc__line-height-22">98% of customers are happy with <b>ShapedPlugin's</b> products and support. <br>
								So it’s a great time to join them.</p>
							<a class="sp-lc__btn sp-lc__btn-buy sp-lc__mt-40" href="https://shapedplugin.com/plugin/logo-carousel-pro/?ref=1" target="_blank">Get Started for $29 Today!</a>
							<span>14 Days Money-back Guarantee! No Question Asked.</span>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Buy Section End -->

		<!-- Testimonial section start -->
		<div class="testimonial-wrapper">
		<section class="sp-lc__premium testimonial">
		<div class="row">
				<div class="col-lg-6">
					<div class="testimonial-area">
						<div class="testimonial-content">
							<p>Thank you for your help with with plugin, installed for a client and had a few issues. Unlike other plugins in the WP world, support was quick to respond and easy to access. And on top of that the plugin works great! Pro version – needed a way to display some logos in a ticker style with no pauses in two rows...</p>
						</div>
						<div class="testimonial-info">
							<div class="img">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/Mark-Kolodziej-min.png'; ?>" alt="">
							</div>
							<div class="info">
								<h3>Mark Kolodziej</h3>
								<p>Freelance Developer</p>
								<div class="star">
								<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="testimonial-area">
						<div class="testimonial-content">
							<p>This is an excellent logo carousel WordPress plugin! The plugin is simple, intuitive, easy to use, polished and continues to improve. I am also impressed with the code quality! Top notch support too. I raised a support ticket and within days a new version of the plugin was released with a fix. Well done.</p>
						</div>
						<div class="testimonial-info">
							<div class="img">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/Daniel-Powney-min.png'; ?>" alt="">
							</div>
							<div class="info">
								<h3>Daniel Powney</h3>
								<p>Sr. Solution Architect, Salesforce</p>
								<div class="star">
								<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		</div>
		<!-- Testimonial section end -->
	</div>
	<!-- End premium page -->
		<?php
	}

	/**
	 * Help Page Callback
	 */
	public function help_page_callback() {
		wp_enqueue_style( 'sp-lc-admin-help', SP_LC_URL . 'admin/assets/css/help-page.min.css', array(), SP_LC_VERSION );
		$add_shortcode_link = admin_url( 'post-new.php?post_type=sp_logo_carousel' );
		?>

		<div class="sp-logo-carousel-help-page">
				<!-- Header section start -->
				<section class="sp-lc-help header">
					<div class="header-area">
						<div class="container">
							<div class="header-logo">
								<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/lc-logo.svg'; ?>" alt="">
								<span><?php echo esc_html( SP_LC_VERSION ); ?></span>
							</div>
							<div class="header-content">
								<p>Thank you for installing Logo Carousel plugin! This video will help you get started with the plugin.</p>
							</div>
						</div>
					</div>
					<div class="video-area">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/videoseries?list=PLoUb-7uG-5jN7hMCpV5dtKLqAMsk_NmZc" frameborder="0" allowfullscreen=""></iframe>
					</div>
					<div class="content-area">
						<div class="container">
							<div class="content-button">
								<a href="<?php echo esc_url( $add_shortcode_link ); ?>">Start Adding Logos</a>
								<a href="https://docs.shapedplugin.com/docs/logo-carousel/introduction/" target="_blank">Read Documentation</a>
							</div>
						</div>
					</div>
				</section>
				<!-- Header section end -->

				<!-- Upgrade section start -->
				<section class="sp-lc-help upgrade">
					<div class="upgrade-area">
					<div class="upgrade-img">
					<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/lc-icon1.svg'; ?>" alt="">
					</div>
						<h2>Upgrade To Unleash the Power of Logo Carousel</h2>
						<p>Professional looking Logo Carousel, Grid, Isotope Filter, List, Inline layouts. Add title, description, links and tooltips to the logos and Get the most out of Logo Carousel by upgrading to unlock all of its powerful features like:</p>
					</div>
					<div class="upgrade-info">
						<div class="container">
							<div class="row">
								<div class="col-lg-6">
									<ul class="upgrade-list">
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Display a list of clients, sponsors, partners, affiliates, supporters, suppliers, brands logo images on your WordPress site.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">
										5 Logo Layout Presets (Carousel, Grid, Isotope Filter, List, and Inline view)</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">200+ Advanced Styling and Layout Customization Options.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Drag & Drop Custom logo ordering.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Display Group (Category) and Specific Logo.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Logo Internal & External Logo links.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Category-wise Logo Filtering (Isotope Layout).</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt=""> Live Category Filter (Opacity).</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Logo Effects on Hover. (Grayscale, zoom in & out, blur, opacity, etc.)</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Multiple Rows in the Carousel.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Carousel Mode. (Standard, Ticker, Center).</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Supports both Vertical and Horizontal directions.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Set Logo Title Positions (Top, bottom, middle, on hover, etc.)</li>
									</ul>
								</div>
								<div class="col-lg-6">
									<ul class="upgrade-list">
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">25+ Logo Carousel Controls.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Logo Display with Tooltips, Title, Description, and CTA button(Read more).</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Tooltips Settings. (Show/hide, Position, Width, Effects, Background, etc.)</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Popup View for Logo Detail.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Logo Background, Hover, Border, Radius, BoxShadow Highlight, etc.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Set Logo margin between logos and inner padding.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Select logo vertical alignment type (Top, middle & bottom).</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">840+ Google Fonts (Advanced Typography).</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Advanced Plugin Settings.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Multisite, Multilingual, RTL, Accessibility ready.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Page Builders & Countless Theme Compatibility.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt="">Top-notch Support and Frequently Updates.</li>
										<li><img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/checkmark.svg'; ?>" alt=""><span>Not Happy? 100% No Questions Asked <a href="//shapedplugin.com/refund-policy/" target="_blank">Refund Policy!</a></span></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="upgrade-pro">
							<div class="pro-content">
								<div class="pro-icon">
									<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/lc-icon.svg'; ?>" alt="">
								</div>
								<div class="pro-text">
									<h2>Upgrade To Logo Carousel Pro</h2>
									<p>Start creating beautiful logo showcases in minutes!</p>
								</div>
							</div>
							<div class="pro-btn">
								<a href="https://shapedplugin.com/plugin/logo-carousel-pro/?ref=1" target="_blank">Upgrade To Pro Now</a>
							</div>
						</div>
					</div>
				</section>
				<!-- Upgrade section end -->

				<!-- Testimonial section start -->
				<section class="sp-lc-help testimonial">
					<div class="row">
						<div class="col-lg-6">
							<div class="testimonial-area">
								<div class="testimonial-content">
									<p>Thank you for your help with with plugin, installed for a client and had a few issues. Unlike other plugins in the WP world, support was quick to respond and easy to access. And on top of that the plugin works great! Pro version – needed a way to display some logos in a ticker style with no pauses in two rows...</p>
								</div>
								<div class="testimonial-info">
									<div class="img">
										<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/Mark-Kolodziej-min.png'; ?>" alt="">
									</div>
									<div class="info">
										<h3>Mark Kolodziej</h3>
										<p>Freelance Developer</p>
										<div class="star">
										<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="testimonial-area">
								<div class="testimonial-content">
									<p>This is an excellent logo carousel WordPress plugin! The plugin is simple, intuitive, easy to use, polished and continues to improve. I am also impressed with the code quality! Top notch support too. I raised a support ticket and within days a new version of the plugin was released with a fix. Well done.</p>
								</div>
								<div class="testimonial-info">
									<div class="img">
										<img src="<?php echo esc_url( SP_LC_URL ) . 'admin/assets/css/images/Daniel-Powney-min.png'; ?>" alt="">
									</div>
									<div class="info">
										<h3>Daniel Powney</h3>
										<p>Sr. Solution Architect, Salesforce</p>
										<div class="star">
										<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- Testimonial section end -->

		</div>
		<?php
	}

}

new SPLC_Free_Loader();
