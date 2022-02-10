<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'seoes__welcome_page' ) ) {
	class seoes__welcome_page {
		
		/**
		 * Singleton class
		 */
		private static $instance;
		
		/**
		 * Get the instance of seoes__welcome_page
		 *
		 * @return self
		 */
		public static function getInstance() {
			if ( ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		/**
		 * Cloning disabled
		 */
		private function __clone() {
		}
		
		/**
		 * Serialization disabled
		 */
		private function __sleep() {
		}
		
		/**
		 * De-serialization disabled
		 */
		private function __wakeup() {
		}
		
		/**
		 * Constructor
		 */
		private function __construct() {
			
			// Theme activation hook
			add_action( 'after_switch_theme', array( $this, 'initActivationHook' ) );
			
			// Welcome page redirect on theme activation
			add_action( 'admin_init', array( $this, 'welcomePageRedirect' ) );
			
			// Add welcome page into theme options
			add_action( 'admin_menu', array( $this, 'addWelcomePage' ), 12 );
			
			//Enqueue theme welcome page scripts
			add_action( 'admin_init', array( $this, 'enqueueStyles' ) );
		}
		
		/**
		 * Init hooks on theme activation
		 */
		function initActivationHook() {
			
			if ( ! is_network_admin() ) {
				set_transient( '_seoes_welcome_page_redirect', 1, 30 );
			}
		}
		
		/**
		 * Redirect to welcome page on theme activation
		 */
		function welcomePageRedirect() {
			
			// If no activation redirect, bail
			if ( ! get_transient( '_seoes_welcome_page_redirect' ) ) {
				return;
			}
			
			// Delete the redirect transient
			delete_transient( '_seoes_welcome_page_redirect' );
			
			// If activating from network, or bulk, bail
			if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
				return;
			}
			
			// Redirect to welcome page
			wp_safe_redirect( add_query_arg( array( 'page' => 'seoes_welcome_page' ), esc_url( admin_url( 'themes.php' ) ) ) );
			exit;
		}
		
		/**
		 * Add welcome page
		 */
		function addWelcomePage() {
			
			add_theme_page(
				esc_html__( 'About', 'seoes' ),
				esc_html__( 'About', 'seoes' ),
				current_user_can( 'edit_theme_options' ),
				'seoes_welcome_page',
				array( $this, 'welcomePageContent' )
			);
			
			remove_submenu_page( 'themes.php', 'seoes_welcome_page' );
		}
		
		/**
		 * Print welcome page content
		 */
		function welcomePageContent() {
			$rb_theme              = wp_get_theme();
			$rb_theme_name         = esc_html( $rb_theme->get( 'Name' ) );
			$rb_theme_description  = esc_html( $rb_theme->get( 'Description' ) );
			$rb_theme_version      = $rb_theme->get( 'Version' );
			$rb_theme_screenshot   = file_exists( SEOES__PATH . '/screenshot.png' ) ? SEOES__URI . '/screenshot.png' : SEOES__URI . '/screenshot.jpg';
			?>
			<div class="wrap about-wrap rb-welcome-page">
				<div class="rb-welcome-page-content">
					<h1 class="rb-welcome-page-title">
						<?php echo sprintf( esc_html__( 'Welcome to %s', 'seoes' ), $rb_theme_name ); ?>
						<small><?php echo esc_html( 'Version: ' . $rb_theme_version ) ?></small>
					</h1>
					<div class="about-text rb-welcome-page-text">
						<?php echo sprintf( esc_html__( 'Thank you for choosing %s - %s! We truly appreciate and really hope that you\'ll enjoy it!', 'seoes' ),
							$rb_theme_name,
							$rb_theme_description,
							$rb_theme_name
						); ?>
						<img src="<?php echo esc_url( $rb_theme_screenshot ); ?>" alt="<?php esc_attr_e( 'Theme Screenshot', 'seoes' ); ?>" />
						
						<h4><?php esc_html_e( 'Useful Links:', 'seoes' ); ?></h4>
						<ul class="rb-welcome-page-links">
							<li>
								<a href="<?php echo ('mailto: support@rainbow-themes.net'); ?>"><?php esc_html_e( 'Support', 'seoes' ); ?></a>
							</li>
							<li>
								<a href="<?php echo esc_url('http://seoes.rainbow-themes.net/doc/'); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'seoes' ); ?></a>
							</li>
							<li>
								<a href="<?php echo add_query_arg( array( 'page' => 'install-required-plugins&plugin_status=install' ), esc_url( admin_url( 'themes.php' ) ) ); ?>"><?php esc_html_e( 'Install Required Plugins', 'seoes' ); ?></a>
							</li>
							<li>
								<a href="<?php echo esc_url('https://themeforest.net/user/rb-themes/portfolio/'); ?>" target="_blank"><?php esc_html_e( 'Browse All Themes', 'seoes' ); ?></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<?php
		}
		
		/**
		 * Enqueue theme welcome page scripts
		 */
		function enqueueStyles() {
			wp_enqueue_style( 'rb-welcome-page-style', get_template_directory_uri() . '/admin/css/admin.css', array(), SEOES__VERSION, 'all' );
		}
	}
}

seoes__welcome_page::getInstance();