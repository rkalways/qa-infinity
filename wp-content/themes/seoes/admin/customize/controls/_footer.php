<?php
    // Get all exist footers
    $custom_footers = array();
    if( function_exists('rb_hf_init') ){
        $args = array(
            'post_type'         => 'rb-tmpl-footer',
            'posts_per_page'    => -1
        );

        $footers = new WP_Query($args);
        foreach ($footers->posts as $footer) {
            $custom_footers[$footer->ID] = esc_html($footer->post_title);
        }
    }

	return array(
        'footer_section' => array(
            'title'     => esc_html_x('Footer Appearance', 'customizer', 'seoes'),
            'layout'    => array(
                'sticky_footer' => array(
                    'type'          => 'checkbox',
                    'label'         => esc_html_x('Sticky Footer', 'customizer', 'seoes'),
                    'default'       => false,
                ),
                'copyright_background' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Background Color', 'customizer', 'seoes'),
                    'default'           => "#fff",
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'live_preview'      => array(
                        'trigger_class'     => '.site-footer',
                        'style_to_change'   => 'background-color',
                    )
                ),
                'footer_logotype' => array(
                    'type'          => 'wp_image',
                    'label'         => esc_html_x('Logo', 'customizer', 'seoes'),
                    'description'   => esc_html_x('To get a retina logo please upload a double-size image and set the image dimentions to fit the actual logo size', 'customizer', 'seoes'),
                ),
                'footer_logo_dimensions' => array(
                    'type'          => 'multiple_input',
                    'label'         => esc_html_x('Dimensions', 'customizer', 'seoes'),
                    'choices'       => array(
                        'width'  => array( 
                            'placeholder' => esc_html_x('Width', 'customizer', 'seoes'), 
                            'value' => 64 
                        ),
                        'height' => array( 
                            'placeholder' => esc_html_x('Height', 'customizer', 'seoes'), 
                            'value' => 0
                        ),
                    )
                ),
                'footer_logo_margins' => array(
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
                'copyright_text' => array(
                    'type'      => 'text',
                    'label'     => esc_html_x('Copyrights Notice', 'customizer', 'seoes'),
                    'default'   => "Coyrights © 2019 — All rights reserved.",
                    'separator' => "line"
                ),
                'custom_footer' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Custom Footer Template', 'customizer', 'seoes'),
                    'default'       => 'default',
                    'choices'       => array(
                        'default'   => esc_html_x('Default', 'customizer', 'seoes'),
                    ) + $custom_footers,
                    'description'   => esc_html_x('All settings above are applied for default footer template only', 'customizer', 'seoes')
                ),
            )
        ),
	)
?>