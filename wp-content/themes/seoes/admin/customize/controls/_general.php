<?php
    
    // Get typography props
    $seoes_typography_control = array();
    if( function_exists('seoes_typography_control') ){
        $seoes_typography_control = array_merge(
            seoes_typography_control( 'titles', 'Open Sans', array('400','700'), 'latin', '#3e4a59', false, false ),
            seoes_typography_control( 'body', 'Nunito Sans', array('regular', '700', '900'), 'latin', 'rgba(62,74,89,0.8)', '17px', '30px' )
        );
    }

   // Set default sidebars
    $default_sidebars = array(
        'blog_sidebar'          => esc_html_x('Blog', 'customizer', 'seoes'),
        'blog_single_sidebar'   => esc_html_x('Blog Single', 'customizer', 'seoes'),
        'custom_sidebar'        => esc_html_x('Custom Sidebar', 'customizer', 'seoes'),
    );
    
    if( class_exists('WooCommerce') ){
        $default_sidebars['woocommerce'] = esc_html_x('Woocommerce', 'customizer', 'seoes');
        $default_sidebars['woocommerce_single'] = esc_html_x('Woocommerce Singe', 'customizer', 'seoes');
    }

	return array(
		'colors' => array(
            'title'     => esc_html_x('Theme Colors', 'customizer', 'seoes'),
            'layout'    => array(
                'primary_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Theme Color', 'customizer', 'seoes'),
                    'default'           => PRIMARY_COLOR,
                    'sanitize_callback' => 'wp_strip_all_tags'
                ),
                'secondary_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Second Color', 'customizer', 'seoes'),
                    'default'           => SECONDARY_COLOR,
                    'sanitize_callback' => 'wp_strip_all_tags'
                ),
            )
        ),
        'typography' => array(
            'title'     => esc_html_x('Typography', 'customizer', 'seoes'),
            'layout'    => array_merge(
                $seoes_typography_control,
                array(
                    'g_fonts_api' => array(
                        'type'          => 'custom-text',
                        'label'         => esc_html_x('Google Fonts Api Key', 'customizer', 'seoes'),
                        'transport'     => 'postMessage',
                        'function'      => 'seoes_update_fonts',
                        'description'   => esc_html_x('Enter Your Api Key and press Enter', 'customizer', 'seoes'),
                        'input_attrs'   => array(
                            'success'   => esc_html_x('Google Fonts updated. Please refresh the page to see the changes', 'customizer', 'seoes'),
                            'error'     => esc_html_x('Wrong API Key or Resource is unavailable', 'customizer', 'seoes')
                        )
                    )
                )
            )
        ),
        'blog_layout' => array(
            'title'     => esc_html_x('Blog Layout', 'customizer', 'seoes'),
            'layout'    => array(
                'blog_view' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Blog layout', 'customizer', 'seoes'),
                    'default'   => 'large',
                    'choices'   => array(
                        'large'     => esc_html_x('Large', 'customizer', 'seoes'),
                        'grid'      => esc_html_x('Grid', 'customizer', 'seoes'),
                        'masonry'   => esc_html_x('Masonry', 'customizer', 'seoes'),
                    )
                ),
                'blog_columns' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Blog Columns', 'customizer', 'seoes'),
                    'default'   => '2',
                    'choices'   => array(
                        '2' => esc_html_x('2 Columns', 'customizer', 'seoes'),
                        '3' => esc_html_x('3 Columns', 'customizer', 'seoes'),
                        '4' => esc_html_x('4 Columns', 'customizer', 'seoes'),
                    ),
                    'dependency'    => array(
                        'control'   => 'blog_view',
                        'operator'  => '!=',
                        'value'     => 'large'
                    )
                ),
                'blog_chars_count' => array(
                    'type'          => 'number',
                    'label'         => esc_html_x('Crop content', 'customizer', 'seoes'),
                    'default'       => '-1',
                    'description'   => esc_html_x('"-1" to SHOW whole content | empty or "0" to HIDE content', 'customizer', 'seoes'),
                    'input_attrs'   => array(
                        'min'   => '-1'
                    )
                ),
                'blog_read_more' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Read More Button Title', 'customizer', 'seoes'),
                    'default'       => 'Read More',
                ),
                'blog_posts_per_page' => array(
                    'type'          => 'number',
                    'label'         => esc_html_x('Posts Per Page', 'customizer', 'seoes'),
                    'default'       => '-1',
                    'description'   => esc_html_x('"-1" to show all posts', 'customizer', 'seoes'),
                    'input_attrs'   => array(
                        'min'   => '-1'
                    )
                ),
                'blog_sidebar' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Select sidebar', 'customizer', 'seoes'),
                    'default'       => 'blog_sidebar',
                    'choices'       => array_merge( 
                        array(
                            'none'  => esc_html_x('None', 'customizer', 'seoes'),
                        ),
                        is_array(get_theme_mod('theme_sidebars')) ? get_theme_mod('theme_sidebars') : array()
                    ),
                ),
                'blog_sidebar_position' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Sidebar Position', 'customizer', 'seoes'),
                    'default'   => 'right',
                    'choices'   => array(
                        'right' => esc_html_x('Right', 'customizer', 'seoes'),
                        'left'  => esc_html_x('Left', 'customizer', 'seoes'),
                    ),
                    'dependency'    => array(
                        'control'   => 'blog_sidebar',
                        'operator'  => '!=',
                        'value'     => 'none'
                    )
                ),
                'blog_single_sidebar' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Select Single sidebar', 'customizer', 'seoes'),
                    'default'       => 'blog_single_sidebar',
                    'choices'       => array_merge( 
                        array(
                            'none'  => esc_html_x('None', 'customizer', 'seoes'),
                        ),
                        is_array(get_theme_mod('theme_sidebars')) ? get_theme_mod('theme_sidebars') : array()
                    ),
                ),
                'blog_single_sidebar_position' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Sidebar Single Position', 'customizer', 'seoes'),
                    'default'   => 'right',
                    'choices'   => array(
                        'right' => esc_html_x('Right', 'customizer', 'seoes'),
                        'left'  => esc_html_x('Left', 'customizer', 'seoes'),
                    ),
                    'dependency'    => array(
                        'control'   => 'blog_single_sidebar',
                        'operator'  => '!=',
                        'value'     => 'none'
                    )
                ),
                'blog_related' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Show Related', 'customizer', 'seoes'),
                    'separator' => 'line-top'
                ),
                'blog_related_cropp' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Cropped Images', 'customizer', 'seoes'),
                ),
                'blog_related_title' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Title', 'customizer', 'seoes'),
                    'default'       => 'Related Posts',
                    'dependency'    => array(
                        'control'   => 'blog_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'blog_related_columns' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Related Columns', 'customizer', 'seoes'),
                    'default'   => '3',
                    'choices'   => array(
                        '2' => esc_html_x('2 Columns', 'customizer', 'seoes'),
                        '3' => esc_html_x('3 Columns', 'customizer', 'seoes'),
                        '4' => esc_html_x('4 Columns', 'customizer', 'seoes'),
                    ),
                    'dependency'    => array(
                        'control'   => 'blog_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'blog_related_items' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Related Items', 'customizer', 'seoes'),
                    'default'       => '3',
                    'dependency'    => array(
                        'control'   => 'blog_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'blog_related_pick' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Pick From', 'customizer', 'seoes'),
                    'default'       => 'category',
                    'choices'       => array(
                        'category'      => esc_html_x( 'Same Categories', 'customizer', 'seoes' ),
                        'tags'          => esc_html_x( 'Same Tags', 'customizer', 'seoes' ),
                        'random'        => esc_html_x('Random', 'customizer', 'seoes'),
                        'latest'        => esc_html_x( 'Latest', 'customizer', 'seoes' ),
                    ),
                    'dependency'    => array(
                        'control'   => 'blog_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'blog_related_text_length' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Text Lenght', 'customizer', 'seoes'),
                    'default'       => '90',
                    'dependency'    => array(
                        'control'   => 'blog_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'blog_related_hide' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Hide', 'customizer', 'seoes'),
                    'default'       => 'none',
                    'choices'       => array(
                        'none'          => esc_html_x('None', 'customizer', 'seoes'),
                        'title'         => esc_html_x( 'Title', 'customizer', 'seoes' ),
                        'cats'          => esc_html_x( 'Categories', 'customizer', 'seoes' ),
                        'author'        => esc_html_x( 'Author', 'customizer', 'seoes' ),
                        'date'          => esc_html_x( 'Date', 'customizer', 'seoes' ),
                        'comments'      => esc_html_x( 'Comments', 'customizer', 'seoes' ),
                        'featured'      => esc_html_x( 'Featured', 'customizer', 'seoes' ),
                        'read_more'     => esc_html_x( 'Read More', 'customizer', 'seoes' ),
                        'excerpt'       => esc_html_x( 'Excerpt', 'customizer', 'seoes' ),
                    ),
                    'input_attrs'   => array(
                        'multiple'      => true
                    ),
                    'dependency'    => array(
                        'control'       => 'blog_related',
                        'operator'      => '==',
                        'value'         => 'true'
                    )
                )
            )
        ),
        'page_layout' => array(
            'title'     => esc_html_x('Page Layout', 'customizer', 'seoes'),
            'layout'    => array(
                'page_sidebar' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Select sidebar', 'customizer', 'seoes'),
                    'default'       => 'none',
                    'choices'       => array_merge( 
                        array(
                            'none'  => esc_html_x('None', 'customizer', 'seoes'),
                        ),
                        is_array(get_theme_mod('theme_sidebars')) ? get_theme_mod('theme_sidebars') : array() 
                    ),
                ),
                'page_sidebar_position' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Sidebar Position', 'customizer', 'seoes'),
                    'default'   => 'right',
                    'choices'   => array(
                        'right' => esc_html_x('Right', 'customizer', 'seoes'),
                        'left'  => esc_html_x('Left', 'customizer', 'seoes'),
                    ),
                    'dependency'    => array(
                        'control'   => 'page_sidebar',
                        'operator'  => '!=',
                        'value'     => 'none'
                    )
                ),
            )
        ),
        'portfolio_layout' => array(
            'title'     => esc_html_x('Portfolio Layout', 'customizer', 'seoes'),
            'layout'    => array(
                'rb_portfolio_layout' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Layout', 'customizer', 'seoes'),
                    'default'       => 'grid',
                    'choices'       => array(
                        'grid'              => esc_html_x( 'Grid', 'customizer', 'seoes' ),
                        'masonry'           => esc_html_x( 'Masonry', 'customizer', 'seoes' ),
                        'pinterest'         => esc_html_x( 'Pinterest', 'customizer', 'seoes' ),
                        'asymmetric'        => esc_html_x( 'Asymmetric', 'customizer', 'seoes' ),
                        'carousel'          => esc_html_x( 'Carousel', 'customizer', 'seoes' ),
                        'carousel_wide'     => esc_html_x( 'Carousel Wide', 'customizer', 'seoes' ),
                        'motion_category'   => esc_html_x( 'Motion Category', 'customizer', 'seoes' ),
                    )
                ),
                'rb_portfolio_hover' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Hover', 'customizer', 'seoes'),
                    'default'       => 'overlay',
                    'choices'       => array(
                        'overlay'       => esc_html_x( 'Overlay', 'customizer', 'seoes' ),
                        'slide_bottom'  => esc_html_x( 'Slide From Bottom', 'customizer', 'seoes' ),
                        'slide_left'    => esc_html_x( 'Slide From Left', 'customizer', 'seoes' ),
                        'swipe_right'   => esc_html_x( 'Swipe Right', 'customizer', 'seoes' ),
                    )
                ),
                'rb_portfolio_orderby' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Order By', 'customizer', 'seoes'),
                    'default'       => 'date',
                    'choices'       => array(
                        'date'          => esc_html_x( 'Date', 'customizer', 'seoes' ),
                        'menu_order'    => esc_html_x( 'Order ID', 'customizer', 'seoes' ),
                        'title'         => esc_html_x( 'Title', 'customizer', 'seoes' ),
                    )
                ),
                'rb_portfolio_order' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Order', 'customizer', 'seoes'),
                    'default'       => 'DESC',
                    'choices'       => array(
                        'ASC'   => esc_html_x( 'ASC', 'customizer', 'seoes' ),
                        'DESC'  => esc_html_x( 'DESC', 'customizer', 'seoes' ),
                    )
                ),
                'rb_portfolio_columns' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Columns', 'customizer', 'seoes'),
                    'default'       => '4',
                    'choices'       => array(
                        '2' => esc_html_x( '2', 'customizer', 'seoes' ),
                        '3' => esc_html_x( '3', 'customizer', 'seoes' ),
                        '4' => esc_html_x( '4', 'customizer', 'seoes' ),
                        '5' => esc_html_x( '5', 'customizer', 'seoes' ),
                        '6' => esc_html_x( '6', 'customizer', 'seoes' ),
                    )
                ),
                'rb_portfolio_items_pp' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Items per Page', 'customizer', 'seoes'),
                    'default'       => '9',
                ),
                'rb_portfolio_square_img' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Square Images', 'customizer', 'seoes'),
                ),
                'rb_portfolio_no_spacing' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Disable Spacings', 'customizer', 'seoes'),
                ),
                'rb_portfolio_pagination' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Pagination', 'customizer', 'seoes'),
                    'default'       => 'standart',
                    'choices'       => array(
                        'standart'      => esc_html_x( 'Standard', 'customizer', 'seoes' ),
                        'load_more'     => esc_html_x( 'Load More', 'customizer', 'seoes' ),
                    )
                ),
                'rb_portfolio_hide_meta' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Hide', 'customizer', 'seoes'),
                    'default'       => '',
                    'choices'       => array(
                        ''              => esc_html_x( 'None', 'backend', 'seoes' ),
                        'title'         => esc_html_x( 'Title', 'backend', 'seoes' ),
                        'categories'    => esc_html_x( 'Categories', 'backend', 'seoes' ),
                        'tags'          => esc_html_x( 'Tags', 'backend', 'seoes' ),
                    )
                ),
                'rb_portfolio_slug' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Slug', 'customizer', 'seoes'),
                    'default'       => 'Portfolio',
                ),
                'rb_portfolio_single_slug' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Single Slug', 'customizer', 'seoes'),
                    'default'       => 'Portfolio Single',
                ),
                'rb_portfolio_related' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Show Related', 'customizer', 'seoes'),
                    'separator' => 'line-top'
                ),
                'rb_portfolio_related_title' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Title', 'customizer', 'seoes'),
                    'default'       => 'Related Projects',
                    'dependency'    => array(
                        'control'   => 'rb_portfolio_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'rb_portfolio_related_hover' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Related Hover', 'customizer', 'seoes'),
                    'default'       => 'overlay',
                    'choices'       => array(
                        'overlay'       => esc_html_x( 'Overlay', 'customizer', 'seoes' ),
                        'slide_bottom'  => esc_html_x( 'Slide From Bottom', 'customizer', 'seoes' ),
                        'slide_left'    => esc_html_x( 'Slide From Left', 'customizer', 'seoes' ),
                        'swipe_right'   => esc_html_x( 'Swipe Right', 'customizer', 'seoes' ),
                    ),
                    'dependency'    => array(
                        'control'   => 'rb_portfolio_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'rb_portfolio_related_columns' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Related Columns', 'customizer', 'seoes'),
                    'default'   => '4',
                    'choices'   => array(
                        '2' => esc_html_x('2 Columns', 'customizer', 'seoes'),
                        '3' => esc_html_x('3 Columns', 'customizer', 'seoes'),
                        '4' => esc_html_x('4 Columns', 'customizer', 'seoes'),
                    ),
                    'dependency'    => array(
                        'control'   => 'rb_portfolio_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'rb_portfolio_related_items' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Related Items', 'customizer', 'seoes'),
                    'default'       => '4',
                    'dependency'    => array(
                        'control'   => 'rb_portfolio_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
                'rb_portfolio_related_pick' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Pick From', 'customizer', 'seoes'),
                    'default'       => 'category',
                    'choices'       => array(
                        'category'      => esc_html_x( 'Same Categories', 'customizer', 'seoes' ),
                        'tags'          => esc_html_x( 'Same Tags', 'customizer', 'seoes' ),
                        'random'        => esc_html_x( 'Random', 'customizer', 'seoes' ),
                        'latest'        => esc_html_x( 'Latest', 'customizer', 'seoes' ),
                    ),
                    'dependency'    => array(
                        'control'   => 'rb_portfolio_related',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
            ),
        ),
        'staff_layout' => array(
            'title'     => esc_html_x('Our Team Layout', 'customizer', 'seoes'),
            'layout'    => array(
                'rb_staff_style' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Style', 'customizer', 'seoes'),
                    'default'       => 'simple',
                    'description'   => esc_html_x( 'Animated Background mode: best to use square photos and social icons should be present. ', 'customizer', 'seoes' ),
                    'choices'       => array(
                        'simple'        => esc_html_x('Simple', 'customizer', 'seoes'),
                        'advanced'      => esc_html_x('Animated Background', 'customizer', 'seoes'),
                    )
                ),
                'rb_staff_order_by' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Order by', 'customizer', 'seoes'),
                    'default'       => 'date',
                    'choices'       => array(
                        'date'          => esc_html_x('Date', 'customizer', 'seoes'),
                        'menu_order'    => esc_html_x('Order ID', 'customizer', 'seoes'),
                        'title'         => esc_html_x('Title', 'customizer', 'seoes'),
                    )
                ),
                'rb_staff_order' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Order', 'customizer', 'seoes'),
                    'default'       => 'ASC',
                    'choices'       => array(
                        'ASC'   => esc_html_x('ASC', 'customizer', 'seoes'),
                        'DESC'  => esc_html_x('DESC', 'customizer', 'seoes'),
                    )
                ),
                'rb_staff_columns' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Columns', 'customizer', 'seoes'),
                    'default'       => '3',
                    'choices'       => array(
                        '2' => esc_html_x('2', 'customizer', 'seoes'),
                        '3' => esc_html_x('3', 'customizer', 'seoes'),
                        '4' => esc_html_x('4', 'customizer', 'seoes'),
                    )
                ),
                'rb_staff_items_pp' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Items per Page', 'customizer', 'seoes'),
                    'default'       => '9',
                ),
                'rb_staff_hide_meta' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Hide', 'customizer', 'seoes'),
                    'default'       => '',
                    'choices'       => array(
                        ''              => esc_html_x( 'None', 'customizer', 'seoes' ),
                        'photo'         => esc_html_x( 'Photo', 'customizer', 'seoes' ),
                        'name'          => esc_html_x( 'Name', 'customizer', 'seoes' ),
                        'position'      => esc_html_x( 'Position', 'customizer', 'seoes' ),
                        'department'    => esc_html_x( 'Department', 'customizer', 'seoes' ),
                        'experience'    => esc_html_x( 'Experience', 'customizer', 'seoes' ),
                        'email'         => esc_html_x( 'Email', 'customizer', 'seoes' ),
                        'phone'         => esc_html_x( 'Phone Number', 'customizer', 'seoes' ),
                        'socials'       => esc_html_x( 'Socials', 'customizer', 'seoes' ),
                        'biography'     => esc_html_x( 'Biography', 'customizer', 'seoes' ),
                        'info'          => esc_html_x( 'Personal Info', 'customizer', 'seoes' ),
                    ),
                    'input_attrs'   => array(
                        'multiple'      => true
                    )
                ),
                'rb_staff_sidebar' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Select sidebar', 'customizer', 'seoes'),
                    'default'       => 'none',
                    'choices'       => array_merge( 
                        array(
                            'none'  => esc_html_x('None', 'customizer', 'seoes'),
                        ),
                        is_array(get_theme_mod('theme_sidebars')) ? get_theme_mod('theme_sidebars') : array() 
                    ),
                ),
                'rb_staff_sidebar_position' => array(
                    'type'      => 'radio',
                    'label'     => esc_html_x('Sidebar Position', 'customizer', 'seoes'),
                    'default'   => 'right',
                    'choices'   => array(
                        'right' => esc_html_x('Right', 'customizer', 'seoes'),
                        'left'  => esc_html_x('Left', 'customizer', 'seoes'),
                    ),
                    'dependency'    => array(
                        'control'   => 'rb_staff_sidebar',
                        'operator'  => '!=',
                        'value'     => 'none'
                    )
                ),
                'rb_staff_slug' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Slug', 'customizer', 'seoes'),
                    'default'       => 'Our Team',
                ),
                'rb_staff_single_accent_background' => array(
                    'type'          => 'wp_image',
                    'label'         => esc_html_x('Single Accent Background', 'customizer', 'seoes'),
                ),
                'rb_staff_single_slug' => array(
                    'type'          => 'text',
                    'label'         => esc_html_x('Single Slug', 'customizer', 'seoes'),
                    'default'       => 'Our Team Single',
                ),
            )
        ),
        'sidebars' => array(
            'title'     => esc_html_x('Sidebars', 'customizer', 'seoes'),
            'layout'    => array(
                'theme_sidebars' => array(
                    'type'          => 'repeater',
                    'label'         => esc_html_x('Sidebars', 'customizer', 'seoes'),
                    'add_label'     => esc_html_x('Add New', 'customizer', 'seoes'),
                    'save_label'    => esc_html_x('Apply', 'customizer', 'seoes'),
                    'default'       => $default_sidebars,
                ),
            )
        ),
        'social_share' => array(
            'title'     => esc_html_x('Social Share', 'customizer', 'seoes'),
            'layout'    => array(
                'social_share_links' => array(
                    'type'          => 'select',
                    'label'         => esc_html_x('Share to:', 'customizer', 'seoes'),
                    'default'       => 'none',
                    'choices'       => array(
                        'none'          => esc_html_x('None', 'customizer', 'seoes'),
                        'add.this'      => esc_html_x('Add.this', 'customizer', 'seoes'),
                        'blogger'       => esc_html_x('Blogger', 'customizer', 'seoes'),
                        'buffer'        => esc_html_x('Buffer', 'customizer', 'seoes'),
                        'diaspora'      => esc_html_x('Diaspora', 'customizer', 'seoes'),
                        'digg'          => esc_html_x('Digg', 'customizer', 'seoes'),
                        'douban'        => esc_html_x('Douban', 'customizer', 'seoes'),
                        'evernote'      => esc_html_x('Evernote', 'customizer', 'seoes'),
                        'getpocket'     => esc_html_x('Getpocket', 'customizer', 'seoes'),
                        'facebook'      => esc_html_x('Facebook', 'customizer', 'seoes'),
                        'flipboard'     => esc_html_x('Flipboard', 'customizer', 'seoes'),
                        'instapaper'    => esc_html_x('Instapaper', 'customizer', 'seoes'),
                        'line.me'       => esc_html_x('Line.me', 'customizer', 'seoes'),
                        'linkedin'      => esc_html_x('Linkedin', 'customizer', 'seoes'),
                        'livejournal'   => esc_html_x('LiveJournal', 'customizer', 'seoes'),
                        'hacker.news'   => esc_html_x('Hacker.news', 'customizer', 'seoes'),
                        'ok.ru'         => esc_html_x('Ok.ru', 'customizer', 'seoes'),
                        'pinterest'     => esc_html_x('Pinterest', 'customizer', 'seoes'),
                        'qzone'         => esc_html_x('Qzone', 'customizer', 'seoes'),
                        'reddit'        => esc_html_x('Reddit', 'customizer', 'seoes'),
                        'skype'         => esc_html_x('Skype', 'customizer', 'seoes'),
                        'tumblr'        => esc_html_x('Tumblr', 'customizer', 'seoes'),
                        'twitter'       => esc_html_x('Twitter', 'customizer', 'seoes'),
                        'vk'            => esc_html_x('Vk', 'customizer', 'seoes'),
                        'weibo'         => esc_html_x('Weibo', 'customizer', 'seoes'),
                        'xing'          => esc_html_x('Xing', 'customizer', 'seoes'),
                    ),
                    'input_attrs'   => array(
                        'multiple'      => true,
                        'size'          => 20
                    ),
                )
            )
        ),
        'site_layout' => array(
            'title'     => esc_html_x('Site Layout', 'customizer', 'seoes'),
            'layout'    => array(
                'sticky_sidebars' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Sticky Sidebars', 'customizer', 'seoes'),
                ),
                'boxed_layout' => array(
                    'default'   => false,
                    'type'      => 'checkbox',
                    'label'     => esc_html_x('Apply Boxed Layout', 'customizer', 'seoes'),
                ),
                'boxed_bg_color' => array(
                    'type'              => 'alpha-color',
                    'label'             => esc_html_x('Content Background', 'customizer', 'seoes'),
                    'default'           => '#fff',
                    'sanitize_callback' => 'wp_strip_all_tags',
                    'live_preview'      => array(
                        'trigger_class'     => 'body[data-boxed="true"] .site.wrap',
                        'style_to_change'   => 'background-color',
                    ),
                    'dependency'    => array(
                        'control'   => 'boxed_layout',
                        'operator'  => '==',
                        'value'     => 'true'
                    )
                ),
            )
        ),
        'sidebars' => array(
            'title'     => esc_html_x('Sidebars', 'customizer', 'seoes'),
            'layout'    => array(
                'theme_sidebars' => array(
                    'type'          => 'repeater',
                    'label'         => esc_html_x('Sidebars', 'customizer', 'seoes'),
                    'add_label'     => esc_html_x('Add New', 'customizer', 'seoes'),
                    'save_label'    => esc_html_x('Apply', 'customizer', 'seoes'),
                    'default'       => $default_sidebars,
                ),
            )
        ),
        'purchase_code' => array(
            'title'     => esc_html_x('Purchase Code', 'customizer', 'seoes'),
            'layout'    => array(
                'envato_purchase_code_seoes' => array(
                    'type'          => 'text',
                    'setting_type'  => 'option',
                    'label'         => esc_html_x('Please enter your purchase code', 'customizer', 'seoes'),
                    'default'       => '',
                ),
            )
        ),
        'help' => array(
            'title'     => esc_html_x('Help', 'customizer', 'seoes'),
            'layout'    => array(
                'documentation' => array(
                    'type'          => 'link',
                    'label'         => esc_html_x('Documentation', 'customizer', 'seoes'),
                    'default'       => 'https://seoes.rainbow-themes.net/manual',
                    'input_attrs'   => array(
                        'icon'  => 'dashicons-welcome-widgets-menus'
                    )
                ),
                'tutorial' => array(
                    'type'      => 'link',
                    'label'     => esc_html_x('Video Tutorial', 'customizer', 'seoes'),
                    'default'   => 'https://www.youtube.com/channel/UCvT8BgvBtxOSeGFcw-zNlFA',
                    'input_attrs'   => array(
                       'icon'  => 'dashicons-format-video'
                    )
                ),
            )
        )
	);
?>