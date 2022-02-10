<?php

function seoes_customizer_controls(){
    class_exists('WooCommerce') ? $woo_panel_layout = require '_woocommerce.php' : $woo_panel_layout = array();
    
    return $customizer_extensions = array(
        'general' => array(
            'title'         => esc_html_x('General', 'customizer', 'seoes'),
            'description'   => esc_html_x('General Theme Options', 'customizer', 'seoes'),
            'priority'      => 5,
            'layout'        => require '_general.php'
        ),
        'header_panel' => array(
            'title'         => esc_html_x('Header', 'customizer', 'seoes'),
            'description'   => esc_html_x('Seoes Header Properties', 'customizer', 'seoes'),
            'priority'      => 6,
            'layout'        => require '_header.php'
        ),
        'footer_panel' => array(
            'title'         => esc_html_x('Footer', 'customizer', 'seoes'),
            'descripton'    => esc_html_x('Seoes Footer Properties', 'customizer', 'seoes'),
            'priority'      => 7,
            'layout'        => require '_footer.php'
        ),
        'woo_panel' => array(
            'title'         => esc_html_x('Shop', 'customizer', 'seoes'),
            'descripton'    => esc_html_x('Seoes WooCommerce Shop Properties', 'customizer', 'seoes'),
            'priority'      => 8,
            'layout'        => $woo_panel_layout
        )
    );
}

?>