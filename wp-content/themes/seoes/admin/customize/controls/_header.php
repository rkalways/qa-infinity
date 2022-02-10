<?php
    // Get typography props
    $seoes_typography_control = array();
    if( function_exists('seoes_typography_control') ){
        $seoes_typography_control = seoes_typography_control( 'menu', 'Nunito Sans', 'regular', 'latin', false, '18px', '25px' );
    }

    // Get all exist headers
    $custom_headers = array();
    if( function_exists('rb_hf_init') ){
        $args = array(
            'post_type'         => 'rb-tmpl-header',
            'posts_per_page'    => -1
        );

        $headers = new WP_Query($args);
        foreach ($headers->posts as $header) {
            $custom_headers[$header->ID] = esc_html($header->post_title);
        }
    }

    // Get all exist sticky headers
    $custom_sticky_headers = array();
    if( function_exists('rb_hf_init') ){
        $args = array(
            'post_type'         => 'rb-tmpl-sticky',
            'posts_per_page'    => -1
        );

        $sticky_headers = new WP_Query($args);
        foreach ($sticky_headers->posts as $sticky) {
            $custom_sticky_headers[$sticky->ID] = esc_html($sticky->post_title);
        }
    }

	return array(
		'top_ bar_section' => array(
            'title'     => esc_html_x('Top Bar', 'customizer', 'seoes'),
            'layout'    => array_merge(
                array(
                    'top_bar_wide' => array(
                        'default'   => false,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Apply full-width top bar', 'customizer', 'seoes'),
                    ),
                    'top_bar_number' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Phone Number', 'customizer', 'seoes'),
                        'default'   => "",
                    ),
                    'top_bar_email' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Email', 'customizer', 'seoes'),
                        'default'   => "",
                        'separator' => 'line'
                    ),
                    'icon_custom_sb' => array(
                        'default'   => false,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Add Custom Sidebar Icon', 'customizer', 'seoes')
                    ),
                     'top_bar_woo_cart' => array(
                        'default'   => false,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Show Woo Cart', 'customizer', 'seoes')
                    ),
                    'custom_sidebar' => array(
                        'type'          => 'select',
                        'label'         => esc_html_x('Custom sidebar', 'customizer', 'seoes'),
                        'default'       => 'custom_sidebar',
                        'dependency'    => array(
                            'control'   => 'icon_custom_sb',
                            'operator'  => '==',
                            'value'     => 'true'
                        ),
                        'choices'       => array_merge( 
                            array(
                                'none'  => esc_html_x('None', 'customizer', 'seoes'),
                            ),
                            is_array(get_theme_mod('theme_sidebars')) ? get_theme_mod('theme_sidebars') : array()
                        ),
                    ),
                ),
                array(
                    'search_title' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Search Title', 'customizer', 'seoes'),
                        'default'   => esc_html_x('Search for anything.', 'customizer', 'seoes'),
                    ),
                    'top_bar_bg_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Background', 'customizer', 'seoes'),
                        'default'           => '#262838',
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'live_preview'      => array(
                            'trigger_class'     => '.top-bar-box',
                            'style_to_change'   => 'background-color',
                        )
                    ),
                    'top_bar_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Fonts & Icons Color', 'customizer', 'seoes'),
                        'default'           => 'rgba(255,255,255,.7)',
                        'sanitize_callback' => 'wp_strip_all_tags',
                        'live_preview'      => array(
                            'trigger_class'     => '.top-bar-box .container > * > a, .header_icons > .mini-cart > a',
                            'style_to_change'   => 'color',
                        )
                    ),
                    'top_bar_font_color_hover' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Fonts & Icons Hover', 'customizer', 'seoes'),
                        'default'           => '#fff',
                        'sanitize_callback' => 'wp_strip_all_tags'
                    ),
                    'top_bar_spacings' => array(
                        'type'          => 'multiple_input',
                        'label'         => esc_html_x('Spacings', 'customizer', 'seoes'),
                        'choices'       => array(
                            'top'  => array( 
                                'placeholder' => esc_html_x('Top (px or %)', 'customizer', 'seoes'), 
                                'value' => '10px'
                            ),
                            'bottom' => array( 
                                'placeholder' => esc_html_x('Bottom (px or %)', 'customizer', 'seoes'), 
                                'value' => '10px'
                            ),
                        )
                    ),
                )
            ),
        ),
        'logotype_section' => array(
            'title'     => esc_html_x('Logo', 'customizer', 'seoes'),
            'layout'    => array(
                'logotype' => array(
                    'type'          => 'wp_image',
                    'label'         => esc_html_x('Logo', 'customizer', 'seoes'),
                    'description'   => esc_html_x('To get a retina logo please upload a double-size image and set the image dimentions to fit the actual logo size', 'customizer', 'seoes'),
                ),
                'logo_dimensions' => array(
                    'type'          => 'multiple_input',
                    'label'         => esc_html_x('Dimensions', 'customizer', 'seoes'),
                    'choices'       => array(
                        'width'  => array( 
                            'placeholder' => esc_html_x('Width (px or %)', 'customizer', 'seoes'), 
                            'value' => '179px' 
                        ),
                        'height' => array( 
                            'placeholder' => esc_html_x('Height (px or %)', 'customizer', 'seoes'), 
                            'value' => 0
                        ),
                    )
                ),
                'logo_margins' => array(
                    'type'          => 'multiple_input',
                    'label'         => esc_html_x('Spacings', 'customizer', 'seoes'),
                    'choices'       => array(
                        'top'  => array( 
                            'placeholder' => esc_html_x('Top (px or %)', 'customizer', 'seoes'), 
                        ),
                        'right' => array( 
                            'placeholder' => esc_html_x('Right (px or %)', 'customizer', 'seoes'), 
                        ),
                        'bottom' => array( 
                            'placeholder' => esc_html_x('Bottom (px or %)', 'customizer', 'seoes'), 
                        ),
                        'left' => array( 
                            'placeholder' => esc_html_x('Left (px or %)', 'customizer', 'seoes'), 
                        ),
                    )
                ),
            )
        ),
        'menu_section' => array(
            'title'     => esc_html_x('Menu Appearance', 'customizer', 'seoes'),
            'layout'    => array_merge(
                array(
                    'menu_wide' => array(
                        'default'   => false,
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Apply full-width menu', 'customizer', 'seoes'),
                    )
                ),
                $seoes_typography_control,
                array(
                    'menu_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Font Color', 'customizer', 'seoes'),
                        'default'           => PRIMARY_COLOR,
                        'sanitize_callback' => 'wp_strip_all_tags',
                    ),
                    'menu_accent_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Accent Font Color', 'customizer', 'seoes'),
                        'default'           => SECONDARY_COLOR,
                        'sanitize_callback' => 'wp_strip_all_tags'
                    ),
                    'submenu_font_color' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Submenu Font Color', 'customizer', 'seoes'),
                        'default'           => 'rgba(62,74,89,.6)',
                        'sanitize_callback' => 'wp_strip_all_tags',
                    ),
                    'submenu_font_color_hover' => array(
                        'type'              => 'alpha-color',
                        'label'             => esc_html_x('Submenu Font Hover', 'customizer', 'seoes'),
                        'default'           => PRIMARY_COLOR,
                        'sanitize_callback' => 'wp_strip_all_tags'
                    ),
                    'menu_spacings' => array(
                        'type'          => 'multiple_input',
                        'label'         => esc_html_x('Spacings', 'customizer', 'seoes'),
                        'choices'       => array(
                            'top'  => array( 
                                'placeholder' => esc_html_x('Top (px or %)', 'customizer', 'seoes'), 
                                'value' => '37px'
                            ),
                            'bottom' => array( 
                                'placeholder' => esc_html_x('Bottom (px or %)', 'customizer', 'seoes'), 
                                'value' => '33px'
                            ),
                        )
                    ),
                    'menu_mode' => array(
                        'default'       => 'desktop',
                        'type'          => 'radio',
                        'label'         => esc_html_x('Show desktop menu on:', 'customizer', 'seoes'),
                        'choices'       => array(
                            'desktop'       => esc_html_x('Desktops', 'customizer', 'seoes'),
                            'landscape'     => esc_html_x('Tablets Landscape', 'customizer', 'seoes'),
                            'both'          => esc_html_x('Landscape & Portrait Tablets', 'customizer', 'seoes'),
                        ),
                        'separator'     => 'line'
                    ),
                    'menu_button_title' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Button Title', 'customizer', 'seoes'),
                        'default'   => '',
                    ),
                    'menu_button_url' => array(
                        'type'      => 'text',
                        'label'     => esc_html_x('Button URL', 'customizer', 'seoes'),
                        'default'   => "#",
                        'dependency'    => array(
                            'control'   => 'menu_button_function',
                            'operator'  => '==',
                            'value'     => 'url'
                        ),
                    ),
                    'menu_button_blank' => array(
                        'type'      => 'checkbox',
                        'label'     => esc_html_x('Open in new window', 'customizer', 'seoes'),
                        'default'   => false,
                    ),
                )
            )
        ),
        'title_area' => array(
            'title'     => esc_html_x('Title Area', 'customizer', 'seoes'),
            'layout'    => array(
                'title_area_spacings' => array(
                    'type'          => 'multiple_input',
                    'label'         => esc_html_x('Title Spacing', 'customizer', 'seoes'),
                    'choices'       => array(
                        'top'  => array( 
                            'placeholder' => esc_html_x('Top (px)', 'customizer', 'seoes'), 
                            'value' => '120px' 
                        ),
                        'bottom' => array( 
                            'placeholder' => esc_html_x('Bottom (px)', 'customizer', 'seoes'), 
                            'value' => '110px' 
                        ),
                    )
                ),
                'mobile_title_area_spacings' => array(
                    'type'          => 'multiple_input',
                    'label'         => esc_html_x(' Mobile Title Spacing', 'customizer', 'seoes'),
                    'choices'       => array(
                        'top'  => array( 
                            'placeholder' => esc_html_x('Top (px)', 'customizer', 'seoes'), 
                            'value' => '70px' 
                        ),
                        'bottom' => array( 
                            'placeholder' => esc_html_x('Bottom (px)', 'customizer', 'seoes'), 
                            'value' => '60px' 
                        ),
                    ),
                ),
                'title_archive_font_size' => array(
                    'type'          => 'textfield',
                    'label'         => esc_html_x('Title Font Size on Archive', 'customizer', 'seoes'),
                    'default'       => "70px",
                    'live_preview'      => array(
                        'trigger_class'     => 'body:not(.single) .page_title_container .page_title_customizer_size',
                        'style_to_change'   => 'font-size',
                    )
                ),
                'title_single_font_size' => array(
                    'type'          => 'textfield',
                    'label'         => esc_html_x('Title Font Size on Singles', 'customizer', 'seoes'),
                    'default'       => "50px",
                    'separator'     => 'line',
                    'live_preview'      => array(
                        'trigger_class'     => 'body.single .page_title_container .page_title_customizer_size',
                        'style_to_change'   => 'font-size',
                    )
                ),
                'title_custom_gradient' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Custom Gradient', 'customizer', 'seoes'),
                ),
                'title_background_gradient_1' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Bg Gradient 1', 'customizer', 'seoes'),
                    'default'           => '#1fc5b6',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_custom_gradient',
                        'operator'  => '!=',
                        'value'     => 'true'
                    ),
                ),
                'title_background_gradient_2' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Bg Gradient 1', 'customizer', 'seoes'),
                    'default'           => '#0048bd',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_custom_gradient',
                        'operator'  => '!=',
                        'value'     => 'true'
                    ),
                ),
                'title_custom_gradient_css' => array(
                    'type'          => 'textarea',
                    'label'         => esc_html_x('Please, enter css code of custom gradient', 'customizer', 'seoes'),
                    'dependency'    => array(
                        'control'   => 'title_custom_gradient',
                        'operator'  => '==',
                        'value'     => 'true'
                    ),
                    'default'       => "",
                ),
                'title_area_mask' => array(
                    'default'   => true,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Show Title Area Mask', 'customizer', 'seoes'),
                ),
                'title_share_bg' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Extend Background with Menu', 'customizer', 'seoes'),
                ),
                'title_area_bg' => array(
                    'type'          => 'wp_image',
                    'label'         => esc_html_x('Title Area Background', 'customizer', 'seoes'),
                ),
                'title_area_interactive' => array(
                    'type'          => 'wp_image',
                    'label'         => esc_html_x('Title Interactive Image', 'customizer', 'seoes'),
                ),
                'title_fields_hide' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Hide', 'customizer', 'seoes'),
                    'default'       => 'none',
                    'choices'       => array(
                        'none'          => esc_html_x('None', 'customizer', 'seoes'),
                        'cats'          => esc_html_x( 'Categories', 'customizer', 'seoes' ),
                        'title'         => esc_html_x( 'Title', 'customizer', 'seoes' ),
                        'meta'          => esc_html_x( 'Meta', 'customizer', 'seoes' ),
                        'divider'       => esc_html_x( 'Divider', 'customizer', 'seoes' ),
                        'breadcrumbs'   => esc_html_x( 'Breadcrumbs', 'customizer', 'seoes' )
                    ),
                    'input_attrs'   => array(
                        'multiple'      => true
                    ),
                ),
                'title_categories_bg' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Categories Bg', 'customizer', 'seoes'),
                    'default'           => '#fff',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_fields_hide',
                        'operator'  => '!=',
                        'value'     => 'cats'
                    ),
                    'live_preview'      => array(
                        'trigger_class'     => '.page_title_container .single_post_categories',
                        'style_to_change'   => 'background-color',
                    )
                ),
                'title_categories_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Categories Color', 'customizer', 'seoes'),
                    'default'           => PRIMARY_COLOR,
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_fields_hide',
                        'operator'  => '!=',
                        'value'     => 'cats'
                    ),
                    'live_preview'      => array(
                        'trigger_class'     => '.page_title_container .single_post_categories a',
                        'style_to_change'   => 'color',
                    )
                ),
                'title_title_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Title Color', 'customizer', 'seoes'),
                    'default'           => '#fff',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_fields_hide',
                        'operator'  => '!=',
                        'value'     => 'title'
                    ),
                    'live_preview'      => array(
                        'trigger_class'     => '.page_title_container .page_title',
                        'style_to_change'   => 'color',
                    )
                ),
                'title_meta_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Meta Color', 'customizer', 'seoes'),
                    'default'           => '#fff',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_fields_hide',
                        'operator'  => '!=',
                        'value'     => 'meta'
                    ),
                    'live_preview'      => array(
                        'trigger_class'     => '.page_title_container .single_post_meta a',
                        'style_to_change'   => 'color',
                    )
                ),
                'title_divider_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Divider Color', 'customizer', 'seoes'),
                    'default'           => '#fff',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_fields_hide',
                        'operator'  => '!=',
                        'value'     => 'divider'
                    ),
                    'live_preview'      => array(
                        'trigger_class'     => '.page_title_container .title_divider',
                        'style_to_change'   => 'background-color',
                    )
                ),
                'title_breadcrumbs_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Breadcrumbs Color', 'customizer', 'seoes'),
                    'default'           => 'rgba(255,255,255, .8)',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'    => array(
                        'control'   => 'title_fields_hide',
                        'operator'  => '!=',
                        'value'     => 'breadcrumbs'
                    ),
                    'live_preview'      => array(
                        'trigger_class'     => '.page_title_container .woocommerce-breadcrumb *, .page_title_container .bread-crumbs *',
                        'style_to_change'   => 'color',
                    )
                ),
                'title_mouse_animation' => array(
                    'default'   => true,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Mouse Move Animation', 'customizer', 'seoes'),
                ),
                'title_scroll_animation' => array(
                    'default'   => true,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Scroll Animation', 'customizer', 'seoes'),
                ),
                'disable_title_mobile' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Disable Title Area for Mobile Devices', 'customizer', 'seoes'),
                ),
            )
        ),
        'mobile_menu_section' => array(
            'title'     => esc_html_x('Mobile Menu', 'customizer', 'seoes'),
            'layout'    => array(
                'mobile_top_bar_logotype' => array(
                    'type'          => 'wp_image',
                    'label'         => esc_html_x('Top Bar Logotype', 'customizer', 'seoes'),
                    'description'   => esc_html_x('To get a retina logo please upload a double-size image and set the image dimentions to fit the actual logo size.', 'customizer', 'seoes'),
                ),
                'mobile_top_bar_logo_dimensions' => array(
                    'type'          => 'multiple_input',
                    'label'         => esc_html_x('Top Bar Logo Dimensions', 'customizer', 'seoes'),
                    'choices'       => array(
                        'width'  => array( 
                            'placeholder' => esc_html_x('Width (px or %)', 'customizer', 'seoes'), 
                            'value' => '111px' 
                        ),
                        'height' => array( 
                            'placeholder' => esc_html_x('Height (px or %)', 'customizer', 'seoes'), 
                            'value' => '' 
                        ),
                    ),
                    'separator'     => 'line'
                ),
                'mobile_menu_logotype' => array(
                    'type'          => 'wp_image',
                    'label'         => esc_html_x('Menu Logotype', 'customizer', 'seoes'),
                    'description'   => esc_html_x('To get a retina logo please upload a double-size image and set the image dimentions to fit the actual logo size.', 'customizer', 'seoes'),
                ),
                'mobile_menu_logo_dimensions' => array(
                    'type'          => 'multiple_input',
                    'label'         => esc_html_x('Menu Logo Dimensions', 'customizer', 'seoes'),
                    'choices'       => array(
                        'width'  => array( 
                            'placeholder' => esc_html_x('Width (px or %)', 'customizer', 'seoes'), 
                            'value' => '179px' 
                        ),
                        'height' => array( 
                            'placeholder' => esc_html_x('Height (px or %)', 'customizer', 'seoes'), 
                            'value' => '' 
                        ),
                    ),
                    'separator'     => 'line'
                ),
                'mobile_show_minicart' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Show Mini-Cart', 'customizer', 'seoes'),
                ),
                'mobile_menu_spacings' => array(
                    'type'          => 'multiple_input',
                    'label'         => esc_html_x('Spacings', 'customizer', 'seoes'),
                    'choices'       => array(
                        'top'  => array( 
                            'placeholder' => esc_html_x('Top (px or %)', 'customizer', 'seoes'), 
                            'value' => '13px'
                        ),
                        'bottom' => array( 
                            'placeholder' => esc_html_x('Bottom (px or %)', 'customizer', 'seoes'), 
                            'value' => '13px'
                        ),
                    )
                ),
                'mobile_topbar_bg' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Top Bar Background', 'customizer', 'seoes'),
                    'default'           => "#fff",
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'live_preview'      => array(
                        'trigger_class'     => '.site-header-mobile .top-bar-box',
                        'style_to_change'   => 'background-color',
                    )
                ),
                'mobile_icons_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Icons Color', 'customizer', 'seoes'),
                    'default'           => PRIMARY_COLOR,
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'live_preview'      => array(
                        'trigger_class'     => '.site-header-mobile .menu-trigger span',
                        'style_to_change'   => 'background-color',
                    )
                ),
                'mobile_menu_font_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Menu Font Color', 'customizer', 'seoes'),
                    'default'           => PRIMARY_COLOR,
                    'sanitize_callback' => 'wp_strip_all_tags',
                ),
                'mobile_accent_font_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Submenu Font Color', 'customizer', 'seoes'),
                    'default'           => SECONDARY_COLOR,
                    'sanitize_callback' => 'wp_strip_all_tags',
                ),
            )
        ),
        'sticky_menu_section' => array(
            'title'     => esc_html_x('Sticky Menu', 'customizer', 'seoes'),
            'layout'    => array(
                'sticky_logotype' => array(
                    'type'          => 'wp_image',
                    'label'         => esc_html_x('Sticky Logo', 'customizer', 'seoes'),
                    'description'   => esc_html_x('To get a retina logo please upload a double-size image and set the image dimentions to fit the actual logo size.', 'customizer', 'seoes'),
                ),
                'sticky_logo_dimensions' => array(
                    'type'          => 'multiple_input',
                    'label'         => esc_html_x('Sticky Logo Dimensions', 'customizer', 'seoes'),
                    'choices'       => array(
                        'width'  => array( 
                            'placeholder' => esc_html_x('Width (px or %)', 'customizer', 'seoes'), 
                            'value' => '179px' 
                        ),
                        'height' => array( 
                            'placeholder' => esc_html_x('Height (px or %)', 'customizer', 'seoes'), 
                            'value' => '' 
                        ),
                    )
                ),
                'sticky_spacings' => array(
                    'type'          => 'multiple_input',
                    'label'         => esc_html_x('Spacings', 'customizer', 'seoes'),
                    'choices'       => array(
                        'top'  => array( 
                            'placeholder' => esc_html_x('Top (px or %)', 'customizer', 'seoes'), 
                            'value' => '0'
                        ),
                        'bottom' => array( 
                            'placeholder' => esc_html_x('Bottom (px or %)', 'customizer', 'seoes'), 
                            'value' => '0'
                        ),
                    )
                ),
                'sticky_shadow' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Add Shadow', 'customizer', 'seoes'),
                ),
                'sticky_shadow_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Shadow Color', 'customizer', 'seoes'),
                    'default'           => 'rgba(16,1,148, 0.05)',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'dependency'           => array(
                        'control'   => 'sticky_shadow',
                        'operator'  => '==',
                        'value'     => 'true'
                    ),
                ),
                'sticky_background' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Background Color', 'customizer', 'seoes'),
                    'default'           => '#fff',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'live_preview'      => array(
                        'trigger_class'     => '.site-sticky',
                        'style_to_change'   => 'background-color',
                    )
                ),
                'sticky_font_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Font Color', 'customizer', 'seoes'),
                    'default'           => PRIMARY_COLOR,
                    'sanitize_callback' => 'wp_strip_all_tags',
                ),
                'sticky_accent_font_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Font Accent Color', 'customizer', 'seoes'),
                    'default'           => SECONDARY_COLOR,
                    'sanitize_callback' => 'wp_strip_all_tags'
                ),
                'custom_sticky_header' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Sticky Menu Template', 'customizer', 'seoes'),
                    'default'       => 'default',
                    'choices'       => array(
                        'default'   => esc_html_x('Use Customizer Settings', 'customizer', 'seoes'),
                        'disable'   => esc_html_x('Disable Sticky Menu', 'customizer', 'seoes'),
                    ) + $custom_sticky_headers,
                    'separator'     => 'line-top',
                    'description'   => esc_html_x('All settings above are applied for default sticky template only', 'customizer', 'seoes'),
                )
            )
        ),
        'header_section' => array(
            'title'     => esc_html_x('Custom Header', 'customizer', 'seoes'),
            'layout'    => array(
                'custom_header' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Custom Header Template', 'customizer', 'seoes'),
                    'default'       => 'default',
                    'choices'       => array(
                        'default'   => esc_html_x('Default', 'customizer', 'seoes'),
                    ) + $custom_headers,
                    'description'   => esc_html_x('The following tab settings will be ingnored if custom headers are applied: Top Bar, Logotype, Menu', 'customizer', 'seoes'),
                ),
            )
        )
	)
?>