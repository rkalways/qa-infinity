<?php
defined( 'ABSPATH' ) or die();

require_once SEOES__PATH . 'admin/customize/inc/customize-helper-functions.php';
require_once SEOES__PATH . 'admin/customize/controls/customizer-controls.php';

function seoes_set_defaults(){
    // Child theme set customizer properties
    if( is_child_theme() && get_option('seoes_child_theme_activated') != '1' ){
        update_option('seoes_child_theme_activated', '1');

        $theme_slug = get_option( 'template' );
        $mods       = get_option( "theme_mods_".$theme_slug );

        update_option( "theme_mods_".$theme_slug."-child", $mods );
    }

    if( get_option('seoes_theme_activated') != '1' ){ //Сomment this condition, if you need to remove default customizer properties
        update_option('seoes_theme_activated', '1');

        $settings_default_props = seoes_get_defaults(seoes_customizer_controls());

        foreach( $settings_default_props as $setting_id => $default_value ){
            if( !get_theme_mod($setting_id) ){
                set_theme_mod($setting_id, $default_value);
            }
            
            // remove_theme_mod($setting_id); //Uncomment this line, if you need to remove default customizer properties
        }
    }
}
add_action( 'after_setup_theme', 'seoes_set_defaults' );


function seoes_register_customizer( $wp_customize ){

    require_once SEOES__PATH . 'admin/customize/class-rb-customizer.php';
    
    seoes_read_options( $wp_customize, seoes_customizer_controls() );
}
add_action( 'customize_register', 'seoes_register_customizer', 10, 2 );


function my_enqueue_customizer_stylesheet() {
    wp_enqueue_style( 'customizer-styles', SEOES__URI . 'admin/css/customizer.css', '', SEOES__VERSION );
    wp_enqueue_style( 'customizer-styles', SEOES__URI . 'admin/css/widgets.css', '', SEOES__VERSION );
}
add_action( 'customize_controls_print_styles', 'my_enqueue_customizer_stylesheet' );


function seoes_customizer_css(){
    if( !empty($GLOBALS['data_to_send']) ){
        $live_preview_styles = json_decode($GLOBALS['data_to_send']['ajax_data']);
        $out = $control = $elem = $style = '';

        if( !empty($live_preview_styles) ){
            $out .= "<style type='text/css'>";

            foreach( $live_preview_styles as $key => $value ){
                foreach ($value as $k => $v) {
                    switch($k) {
                        case 'control':
                            $control = $v;
                            break;
                        case 'trigger_class':
                            $elem = $v;
                            break;
                        case 'style_to_change':
                            $style = $v;
                            break;
                        default:
                            break;
                    }
                }

                $out .= $elem."{";
                    $out .= $style.": ".get_theme_mod($control).";";
                $out .= "}";
            }

            $out .= "</style>";
        }

        echo sprintf('%s', $out);
    }
}
add_action( 'wp_head', 'seoes_customizer_css');


function seoes_customizer_control_toggle(){
    wp_enqueue_script( 
        'contextual_controls', 
        get_template_directory_uri() . '/admin/customize/inc/rb_customizer_context.js?v=' . rand(), 
        array( 'customize-controls' ), 
        '',
        false
    );

    wp_localize_script( 'contextual_controls', 'ajax_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    ));
}
add_action( 'customize_controls_enqueue_scripts', 'seoes_customizer_control_toggle' );


function seoes_customizer_preview(){
    wp_enqueue_script(
        'live-preview',
        get_template_directory_uri() . '/admin/customize/inc/rb_customizer.js',
        array( 'jquery', 'customize-preview' ),
        '',
        true
    );

    wp_localize_script( 'live-preview', 'preview_controls', $GLOBALS['data_to_send'] );
}
add_action( 'customize_preview_init', 'seoes_customizer_preview' );

require_once SEOES__PATH . 'admin/customize/inc/customizer-ajax-functions.php';

?>