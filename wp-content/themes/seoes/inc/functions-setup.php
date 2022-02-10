<?php
defined( 'ABSPATH' ) or die();

// Setup the theme navigation
add_action( 'after_setup_theme', 'seoes__navigation' );

// Setup theme supports
add_action( 'after_setup_theme', 'seoes__supports' );

// Setup custom widgets
add_action( 'after_setup_theme', 'rb__widgets' );

// Add action to register the needed scripts and styles
// for the theme
add_action( 'init', 'seoes__register_assets', 5 );

// We need enqueue the scripts and styles before showing
// the content
add_action( 'wp_enqueue_scripts', 'seoes__enqueue_assets', 5 );
add_action( 'wp_enqueue_scripts', 'seoes__enqueue_assets', 5 );

// Enqueue fonts in footer to avoid render-block
add_action( 'get_footer', 'seoes__enqueue_fonts' );
add_action( 'get_footer', 'seoes__typography_styles' );

// Setup sidebars & widgets
add_action( 'widgets_init', 'seoes__widgets_init' );

// Adding SVG support in the media library
add_filter( 'upload_mimes', 'seoes__upload_mimes' );

// Update theme
add_filter('pre_set_site_transient_update_themes', 'rb_check_for_update' );

// Change postcounts
add_filter('wp_list_categories', 'rb_custom_cats_postcount_filter');
add_filter('get_archives_link', 'rb_custom_arch_postcount_filter');


/**
 * Change postcount in categories widget
 * 
 * @return  void
 */
function rb_custom_cats_postcount_filter ($count) {
	$count = str_replace('</a> (', '</a><span class="post_count">', $count);
	$count = str_replace(')', '</span>', $count);
	return $count;
}

/**
 * Change postcount in archives widget
 * 
 * @return  void
 */
function rb_custom_arch_postcount_filter($count) {
   $count = str_replace('</a>&nbsp;(', '</a><span class="post_count">', $count);
   $count = str_replace(')', '</span>', $count);
   return $count;
}

/**
 * Register the theme menu locations
 * 
 * @return  void
 */
function set_custom_posts_per_page( $query ) {
	if( !is_admin() && $query->is_main_query() ){
		if( is_post_type_archive( 'rb_staff' ) ){
			$query->set( 'posts_per_page', get_theme_mod('rb_staff_items_pp') );
		} else if( is_post_type_archive( 'rb_portfolio' ) ){
			$query->set( 'posts_per_page', get_theme_mod('rb_portfolio_items_pp') );
		}
	}
}
add_action( 'pre_get_posts', 'set_custom_posts_per_page' );

/**
 * Register the theme menu locations
 * 
 * @return  void
 * @since   1.0.0
 */
function seoes__navigation() {
	register_nav_menus( array(
		'primary'   => esc_html__( 'Primary Menu', 'seoes' ),
		'sliding'   => esc_html__( 'Sliding Menu', 'seoes' ),
		'top'       => esc_html__( 'Top Menu', 'seoes' )
	) );
}

/**
 * Add custom URL fields to media uploader
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */
function rb_custom_media_field( $form_fields, $post ) {
    $form_fields['rb-custom-url'] = array(
        'label' => 'Custom URL',
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'rb_custom_url', true ),
        'helps' => 'Custom URL for RB-Presentation module',
    );
 
    return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'rb_custom_media_field', 10, 2 );
 
/**
 * Save values of custom URL in media uploader
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */
function rb_custom_media_field_save( $post, $attachment ) {
    if( isset( $attachment['rb-custom-url'] ) )
        update_post_meta( $post['ID'], 'rb_custom_url', $attachment['rb-custom-url'] ); 
    return $post;
}
add_filter( 'attachment_fields_to_save', 'rb_custom_media_field_save', 10, 2 );

/**
 * Register the theme features support
 * 
 * @return  void
 */
function seoes__supports() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'status', 'video', 'audio' ) );
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', 'gallery', 'caption' ) );
	add_theme_support( 'custom-background', array('default-color' => '#fff') );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
}

/**
 * Register the theme custom widgets
 * 
 * @return  void
 */
function rb__widgets() {
	$widgets = array(
		'RB_About',
		'RB_Recent_Posts',
		'RB_Icon_List',
		'RB_Banner'
	);

	if( SEOES__ACTIVE ){
        $rb_essentials = new RB_Essentials();
        $rb_essentials->rb_register_widgets($widgets);
	}
}

/**
 * Register the theme assets
 * 
 * @return  void
 */
function seoes__register_assets() {
	// Theme's styles
	wp_register_style( 'theme', get_template_directory_uri() . '/assets/css/main.css', array(), SEOES__VERSION, 'all' );

	// Theme's icons
	wp_register_style( 'rbicons', get_template_directory_uri() . '/assets/fonts/rbicons/style.css', array(), SEOES__VERSION, 'all' );

	// Theme's scripts
	wp_register_script( 'slick-slider', get_template_directory_uri() . '/assets/js/slick-slider.min.js', array( 'jquery' ), '1.8.1', true );
	wp_register_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
	wp_register_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array( 'jquery' ), '1.6.2', true );
	wp_register_script( 'counterup', get_template_directory_uri() . '/assets/js/counterup.min.js', array( 'jquery' ), '1.0.0', true );
	wp_register_script( 'particles', get_template_directory_uri() . '/assets/js/particles.min.js', array( 'jquery' ), '2.0.0', true );
	wp_register_script( 'sticky-sidebar', get_template_directory_uri() . '/assets/js/jquery.sticky-sidebar.min.js', array( 'jquery' ), '3.3.1', true );
	wp_register_script( 'tilt', get_template_directory_uri() . '/assets/js/tilt.jquery.js', array( 'jquery' ), '1.0.0', true );
	wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.min.js', array( 'jquery' ), '3.0.6', true );

	wp_register_script( 'rb-theme', get_template_directory_uri() . '/assets/js/theme.js', array( 'slick-slider', 'magnific-popup', 'waypoints', 'counterup', 'particles', 'sticky-sidebar', 'tilt' ), SEOES__VERSION, true );
}

function seoes__enqueue_assets() {
	// The dynamic styles
	if ( locate_template( 'dynamic-styles.php' ) ) {
		// Load the script that generate the dynamic
		// stylesheets
		get_template_part( 'dynamic-styles' );
	}

	// Enqueue the main styles
	wp_enqueue_style( 'theme' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	// Enqueue the inline stylesheet
	wp_add_inline_style( 'theme', seoes__styles() );
	wp_add_inline_style( 'theme', seoes__scheme_styles() );

	// Enqueue the main script
	wp_enqueue_script( 'rb-theme' );

	// Enqueue the wp included masonry script
	wp_enqueue_script( 'masonry' );

	// Comment script
	if( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
		wp_enqueue_script( 'comment-reply' );
	}
}

function seoes__enqueue_fonts() {
	// Enqueue flaticons
    $rbfi = get_option('rbfi');
    if( !empty($rbfi) && isset($rbfi['css']) ){
        wp_enqueue_style( 'rbfi-css', $rbfi['css'], array(), SEOES__VERSION, 'all' );
    } else {
        wp_enqueue_style( 'flaticons', get_template_directory_uri() . '/assets/fonts/flaticons/style.css', array(), SEOES__VERSION, 'all' );
    };

	// Enqueue custom icons
	wp_enqueue_style( 'rbicons' );

	// Font Awesome
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome.min.css', array(), '4.7.0', 'all' );
}

function seoes__widgets_init() {
	$sidebars = get_theme_mod('theme_sidebars');
	$sidebars = isset($sidebars) ? $sidebars :
	array(
		'blog_sidebar' 	    	=> 'Blog ',
		'blog_single_sidebar' 	=> 'Blog Single',
        'custom_sidebar'		=> 'Custom Sidebar',
	);

	if( !empty($sidebars) && function_exists('register_sidebars') ){
		foreach( $sidebars as $key => $value ){
			if( !empty($value) ){
				register_sidebar( array(
					'name' => $value,
					'id' => strtolower(preg_replace("/[^a-z0-9\-]+/i", "_", esc_attr($key) )),
					'before_widget' => '<div class="rb-widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<div class="widget-title h5">',
					'after_title' => '</div>',
				));
			}
		}
	}
}

/**
 * Register custom mime types for the theme
 * 
 * @param   array  $mimes  List of mime types
 * @return  array
 */
function seoes__upload_mimes( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	$mimes['ico'] = 'image/x-icon';
	$mimes['dat'] = 'application/octet-stream';
	$mimes['txt'] = 'text/plain';

	return $mimes;
}

/**
 * Theme and plugin updates
 * 
 * @return  bool
 */
function rb_check_for_update( $transient ){
	if( empty($transient->checked) ){ return $transient; }

	$theme_pc = trim(get_option('envato_purchase_code_seoes'));
	if (empty($theme_pc)) {
		add_action( 'admin_notices', 'rb_an_purchase_code' );
	}

	$result = wp_remote_get('http://up.rainbow-themes.net/products-updater.php?pc=' . $theme_pc . '&tname=' . 'seoes');
	if (!is_wp_error( $result ) ) {
		if (200 == $result['response']['code'] && 0 != strlen($result['body']) ) {
			
			$resp = json_decode($result['body'], true);
			$h = isset( $resp['h'] ) ? (float) $resp['h'] : 0;
			$theme = wp_get_theme(get_template());
			if (isset($resp['new_version']) && version_compare( $theme->get('Version'), $resp['new_version'], '<' ) ) {
				$transient->response['seoes'] = $resp;
			}

			// request and save plugins info
			$opt_res = wp_remote_get('http://up.rainbow-themes.net/plugins/update.php', array( 'timeout' => 1));
			if ( is_array( $opt_res ) && ! is_wp_error( $opt_res ) ) {
				update_option('rb_plugin_ver', array('data' => $opt_res['body'], 'lasttime' => date('U')));
			}
			// end of request and save plugins info
		}
		else{
			unset($transient->response['seoes']);
		}
	}
	return $transient;
}

// A purchase code notice
function rb_an_purchase_code() {
	$rb_theme = wp_get_theme();
	echo "<div class='update-nag'>" . $rb_theme->get('Name') . esc_html__(' theme notice: Please insert your Item Purchase Code in Theme Options to get the latest theme updates!', 'seoes') .'</div>';
}
# /Theme and plugin updates