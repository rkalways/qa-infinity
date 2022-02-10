<?php
    return array(
        'woo_general' => array(
            'title'     => esc_html_x('General', 'customizer', 'seoes'),
            'layout'    => array(
                'woo_cart' => array(
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Show Cart', 'customizer', 'seoes'),
                    'default'   => true
                ),
                'woocommerce_mini_cart' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Mini Cart View', 'customizer', 'seoes'),
                    'default'   => 'sidebar-view',
                    'choices'   => array(
                        'popup-view' => esc_html_x('Popup', 'customizer', 'seoes'),
                        'sidebar-view'  => esc_html_x('Sidebar', 'customizer', 'seoes'),
                    ),
                    'dependency'    => array(
                        'control'   => 'woo_cart',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'woo_archive_cols' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Shop Columns', 'customizer', 'seoes'),
                    'default'   => '3',
                    'choices'   => array(
                        '2' => esc_html_x('2 Columns', 'customizer', 'seoes'),
                        '3' => esc_html_x('3 Columns', 'customizer', 'seoes'),
                        '4' => esc_html_x('4 Columns', 'customizer', 'seoes'),
                    )
                ),
                'woo_archive_count' => array(
                    'type'          => 'number',
                    'label'         => esc_html_x('Show Products per Page', 'customizer', 'seoes'),
                    'default'       => '9',
                    'input_attrs'   => array(
                        'min'   => '2'
                    )
                ),
                'woo_tag_lifetime' => array(
                    'type'          => 'number',
                    'label'         => esc_html_x('Lifetime of the "New" badge', 'customizer', 'seoes'),
                    'description'   => esc_html_x('In days', 'customizer', 'seoes'),
                    'default'       => '14'
                ),
                'woo_pagination' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Pagination Type', 'customizer', 'seoes'),
                    'default'   => 'default',
                    'choices'   => array(
                        'default'   => esc_html_x('Default', 'customizer', 'seoes'),
                        'click'     => esc_html_x('Load More on Click', 'customizer', 'seoes'),
                        'scroll'    => esc_html_x('Load More on Scroll', 'customizer', 'seoes'),
                    )
                ),
                'woo_slug' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Slug', 'customizer', 'seoes'),
                    'default'       => 'Shop',
                ),
            )
        ),
        'woo_sidebar' => array(
            'title'     => esc_html_x('Sidebar', 'customizer', 'seoes'),
            'layout'    => array(
                'woocommerce_sidebar' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Shop Sidebar', 'customizer', 'seoes'),
                    'default'       => 'woocommerce',
                    'choices'       => array_merge( 
                        array(
                            'none'  => esc_html_x('None', 'customizer', 'seoes'),
                        ),
                        is_array(get_theme_mod('theme_sidebars')) ? get_theme_mod('theme_sidebars') : array()
                    ),
                ),
                'woocommerce_sidebar_position' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Shop Sidebar Position', 'customizer', 'seoes'),
                    'default'   => 'left',
                    'choices'   => array(
                        'right' => esc_html_x('Right', 'customizer', 'seoes'),
                        'left'  => esc_html_x('Left', 'customizer', 'seoes'),
                    ),
                    'dependency'    => array(
                        'control'   => 'woocommerce_sidebar',
                        'operator'  => '!=',
                        'value'     => 'none'
                    )
                ),
                'woocommerce_single_sidebar' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Product Details Sidebar', 'customizer', 'seoes'),
                    'default'       => 'woocommerce_single',
                    'choices'       => array_merge( 
                        array(
                            'none'  => esc_html_x('None', 'customizer', 'seoes'),
                        ),
                        is_array(get_theme_mod('theme_sidebars')) ? get_theme_mod('theme_sidebars') : array()
                    ),
                ),
                'woocommerce_single_sidebar_position' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Product Details Sidebar Position', 'customizer', 'seoes'),
                    'default'   => 'right',
                    'choices'   => array(
                        'right' => esc_html_x('Right', 'customizer', 'seoes'),
                        'left'  => esc_html_x('Left', 'customizer', 'seoes'),
                    ),
                    'dependency'    => array(
                        'control'   => 'woocommerce_single_sidebar',
                        'operator'  => '!=',
                        'value'     => 'none'
                    )
                ),
            )
        ),
        'woo_single' => array(
            'title'     => esc_html_x('Product Details', 'customizer', 'seoes'),
            'layout'    => array(
                'woo_gallery_thumbnails_count' => array(
                    'type'          => 'number',
                    'label'         => esc_html_x('Quantity of visible gallery thumbnails', 'customizer', 'seoes'),
                    'default'       => '3',
                    'input_attrs'   => array(
                        'min'   => '2'
                    )
                ),
                'woo_related_cols' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Related Columns', 'customizer', 'seoes'),
                    'default'   => '3',
                    'choices'   => array(
                        '2' => esc_html_x('2 Columns', 'customizer', 'seoes'),
                        '3' => esc_html_x('3 Columns', 'customizer', 'seoes'),
                        '4' => esc_html_x('4 Columns', 'customizer', 'seoes'),
                    )
                ),
                'woo_related_count' => array(
                    'type'          => 'number',
                    'label'         => esc_html_x('Related Products per Page', 'customizer', 'seoes'),
                    'default'       => '6'
                ),
                'related_products_carousel' => array(
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Enable related carousel', 'customizer', 'seoes'),
                    'default'   => true
                ),
                'related_products_slides_to_scroll' => array(
                    'type'          => 'number',
                    'label'         => esc_html_x('Slides to scroll', 'customizer', 'seoes'),
                    'default'       => '1',
                    'dependency'    => array(
                        'control'   => 'related_products_carousel',
                        'operator'  => '==',
                        'value'     => 'true'
                    ),
                ),
                'related_products_autoplay_speed' => array(
                    'type'          => 'number',
                    'label'         => esc_html_x('Autoplay speed', 'customizer', 'seoes'),
                    'description'   => esc_html_x('Delay in seconds. Enter "0" to disable autoplay', 'customizer', 'seoes'),
                    'default'       => '3',
                    'input_attrs'   => array(
                        'min'   => '0'
                    ),
                    'dependency'    => array(
                        'control'   => 'related_products_carousel',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
            )
        ),
    );
?>