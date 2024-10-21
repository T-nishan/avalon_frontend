<?php
/**
 * gerow customizer
 *
 * @package gerow
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Added Panels & Sections
 */
function gerow_customizer_panels_sections( $wp_customize ) {

    //Add panel
    $wp_customize->add_panel( 'gerow_customizer', [
        'priority' => 10,
        'title'    => esc_html__( 'Gerow Customizer', 'gerow' ),
    ] );

    /**
     * Customizer Section
     */
    $wp_customize->add_section( 'gerow_default_setting', [
        'title'       => esc_html__( 'Gerow Default Setting', 'gerow' ),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'gerow_customizer',
    ] );

    $wp_customize->add_section('section_header_logo', [
        'title'       => esc_html__('Header Setting', 'gerow'),
        'description' => '',
        'priority'    => 11,
        'capability'  => 'edit_theme_options',
        'panel'       => 'gerow_customizer',
    ]);

    $wp_customize->add_section( 'header_top_setting', [
        'title'       => esc_html__( 'Header Top Setting', 'gerow' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'gerow_customizer',
    ] );

    $wp_customize->add_section( 'header_info_setting', [
        'title'       => esc_html__( 'Header Info Setting', 'gerow' ),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'gerow_customizer',
    ] );

    $wp_customize->add_section( 'offcanvas_setting', [
        'title'       => esc_html__( 'Offcanvas Setting', 'gerow' ),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'gerow_customizer',
    ] );

    $wp_customize->add_section( 'mobile_menu_setting', [
        'title'       => esc_html__( 'Mobile Menu Setting', 'gerow' ),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'gerow_customizer',
    ] );

    $wp_customize->add_section( 'breadcrumb_setting', [
        'title'       => esc_html__( 'Breadcrumb Setting', 'gerow' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'gerow_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'gerow' ),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'gerow_customizer',
    ] );

    $wp_customize->add_section( 'footer_setting', [
        'title'       => esc_html__( 'Footer Settings', 'gerow' ),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'gerow_customizer',
    ] );

    $wp_customize->add_section( 'color_setting', [
        'title'       => esc_html__( 'Color Setting', 'gerow' ),
        'description' => '',
        'priority'    => 19,
        'capability'  => 'edit_theme_options',
        'panel'       => 'gerow_customizer',
    ] );

    $wp_customize->add_section( '404_page', [
        'title'       => esc_html__( '404 Page', 'gerow' ),
        'description' => '',
        'priority'    => 20,
        'capability'  => 'edit_theme_options',
        'panel'       => 'gerow_customizer',
    ] );

    $wp_customize->add_section( 'typo_setting', [
        'title'       => esc_html__( 'Typography Setting', 'gerow' ),
        'description' => '',
        'priority'    => 21,
        'capability'  => 'edit_theme_options',
        'panel'       => 'gerow_customizer',
    ] );

    $wp_customize->add_section( 'slug_setting', [
        'title'       => esc_html__( 'Slug Settings', 'gerow' ),
        'description' => '',
        'priority'    => 22,
        'capability'  => 'edit_theme_options',
        'panel'       => 'gerow_customizer',
    ] );
}

add_action( 'customize_register', 'gerow_customizer_panels_sections' );


/*
Theme Default Settings
*/
function _gerow_default_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_preloader',
        'label'    => esc_html__( 'Preloader ON/OFF', 'gerow' ),
        'section'  => 'gerow_default_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'gerow' ),
            'off' => esc_html__( 'Disable', 'gerow' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_backtotop',
        'label'    => esc_html__( 'Back to Top ON/OFF', 'gerow' ),
        'section'  => 'gerow_default_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'gerow' ),
            'off' => esc_html__( 'Disable', 'gerow' ),
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_gerow_default_fields' );


/*
Header Settings
 */
function _header_header_fields( $fields ) {

    // Sticky Header
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_show_sticky_header',
        'label'    => esc_html__( 'Show Sticky Header', 'gerow' ),
        'section'  => 'section_header_logo',
        'default'  => 0,
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'gerow' ),
            'off' => esc_html__( 'Disable', 'gerow' ),
        ],
    ];

    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__( 'Select Header Style', 'gerow' ),
        'section'     => 'section_header_logo',
        'placeholder' => esc_html__( 'Select an option...', 'gerow' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'header-style-1' => get_template_directory_uri() . '/inc/img/header/header-1.png',
            'header-style-2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
            'header-style-3' => get_template_directory_uri() . '/inc/img/header/header-3.png',
            'header-style-4' => get_template_directory_uri() . '/inc/img/header/header-4.png',
            'header-style-5' => get_template_directory_uri() . '/inc/img/header/header-5.png',
            'header-style-6' => get_template_directory_uri() . '/inc/img/header/header-6.png',
        ],
        'default'     => 'header-style-1',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__( 'Header Logo', 'gerow' ),
        'description' => esc_html__( 'Upload Your Logo', 'gerow' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'secondary_logo',
        'label'       => esc_html__( 'Header Secondary Logo', 'gerow' ),
        'description' => esc_html__( 'Upload Your Logo', 'gerow' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/secondary_logo.png',
    ];

    $fields[] = [
        'type'        => 'dimension',
        'settings'    => 'logo_size_adjust',
		'label'       => esc_html__( 'Logo Size Height', 'gerow' ),
		'description' => esc_html__( 'Adjust your logo size with px', 'gerow' ),
		'section'     => 'section_header_logo',
		'default'     => '29px',
        'choices'     => [
			'accept_unitless' => true,
		],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_header_fields' );


/*
Header Top Settings
*/
function _header_top_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_show_header_top',
        'label'    => esc_html__('Show Header Top', 'gerow'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'gerow'),
            'off' => esc_html__('Disable', 'gerow'),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_header_location',
        'label'    => esc_html__('Enter Location Text', 'gerow'),
        'section'  => 'header_top_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_header_top',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('256 Avenue, Mark Street, Newyork City', 'gerow'),
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_header_email_text',
        'label'    => esc_html__('Enter Email Address', 'gerow'),
        'section'  => 'header_top_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_header_top',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('gerow@gmail.com', 'gerow'),
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_header_phone_text',
        'label'    => esc_html__('Enter Phone Number', 'gerow'),
        'section'  => 'header_top_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_header_top',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('+123 8989 444', 'gerow'),
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_show_header_social',
        'label'    => esc_html__('Show Header Social', 'gerow'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'gerow'),
            'off' => esc_html__('Disable', 'gerow'),
        ],
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_header_top',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_header_fb',
        'label'    => esc_html__('Enter Facebook url', 'gerow'),
        'section'  => 'header_top_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_header_top',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'gerow_show_header_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('#', 'gerow'),
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_header_twitter',
        'label'    => esc_html__('Enter Twitter url', 'gerow'),
        'section'  => 'header_top_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_header_top',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'gerow_show_header_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('#', 'gerow'),
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_header_instagram',
        'label'    => esc_html__('Enter Instagram url', 'gerow'),
        'section'  => 'header_top_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_header_top',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'gerow_show_header_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('#', 'gerow'),
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_header_pinterest',
        'label'    => esc_html__('Enter Pinterest url', 'gerow'),
        'section'  => 'header_top_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_header_top',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'gerow_show_header_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('#', 'gerow'),
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_show_header_top_button',
        'label'    => esc_html__('Show top Button', 'gerow'),
        'description' => esc_html__('This button show only Header style two & three', 'gerow'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'gerow'),
            'off' => esc_html__('Disable', 'gerow'),
        ],
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_header_top',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_header_top_btn_text',
        'label'    => esc_html__('Header Top Button', 'gerow'),
        'section'  => 'header_top_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_header_top',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'gerow_show_header_top_button',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('Free Consulting', 'gerow'),
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_header_top_btn_url',
        'label'    => esc_html__('Header Top Button URL', 'gerow'),
        'section'  => 'header_top_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_header_top',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'gerow_show_header_top_button',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('#', 'gerow'),
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_top_fields' );


/*
Header Right Settings
*/
function _header_right_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_show_header_search',
        'label'    => esc_html__('Show Header Search', 'gerow'),
        'section'  => 'header_info_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'gerow'),
            'off' => esc_html__('Disable', 'gerow'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_show_header_button',
        'label'    => esc_html__('Show Header Button', 'gerow'),
        'section'  => 'header_info_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'gerow'),
            'off' => esc_html__('Disable', 'gerow'),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_header_btn_text',
        'label'    => esc_html__('Enter Button Text', 'gerow'),
        'section'  => 'header_info_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_header_button',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('Get a Quote', 'gerow'),
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_header_btn_url',
        'label'    => esc_html__('Enter Button URL', 'gerow'),
        'section'  => 'header_info_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_header_button',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('#', 'gerow'),
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_header_phone',
        'label'    => esc_html__('Show Header Phone', 'gerow'),
        'section'  => 'header_info_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'gerow'),
            'off' => esc_html__('Disable', 'gerow'),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_header_phone_title',
        'label'    => esc_html__('Enter Phone Text', 'gerow'),
        'section'  => 'header_info_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_header_phone',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('Hot Line Number', 'gerow'),
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_header_phone_number',
        'label'    => esc_html__('Enter Phone Number', 'gerow'),
        'section'  => 'header_info_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_header_phone',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('+123 8989 444', 'gerow'),
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_right_fields' );


/*
Offcanvas Settings
*/
function _header_offcanvas_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_show_offcanvas',
        'label'    => esc_html__('Show Offcanvas', 'gerow'),
        'section'  => 'offcanvas_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'gerow'),
            'off' => esc_html__('Disable', 'gerow'),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'offcanvas_address_title',
        'label'    => esc_html__('Enter Address Title', 'gerow'),
        'section'  => 'offcanvas_setting',
        'priority' => 10,
        'default'  => esc_html__('Office Address', 'gerow'),
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_offcanvas',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'offcanvas_address_text',
        'label'    => esc_html__('Enter Address Text', 'gerow'),
        'section'  => 'offcanvas_setting',
        'priority' => 10,
        'default'  => esc_html__('123/A, Miranda City Likaoli Prikano, Dope', 'gerow'),
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_offcanvas',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'offcanvas_phone_title',
        'label'    => esc_html__('Enter Phone Title', 'gerow'),
        'section'  => 'offcanvas_setting',
        'priority' => 10,
        'default'  => esc_html__('Phone Number', 'gerow'),
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_offcanvas',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'offcanvas_phone_text',
        'label'    => esc_html__('Enter Phone Text', 'gerow'),
        'section'  => 'offcanvas_setting',
        'priority' => 10,
        'default'  => esc_html__('+0989 7876 9865 9', 'gerow'),
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_offcanvas',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'offcanvas_email_title',
        'label'    => esc_html__('Enter Email Title', 'gerow'),
        'section'  => 'offcanvas_setting',
        'priority' => 10,
        'default'  => esc_html__('Email Address', 'gerow'),
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_offcanvas',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'offcanvas_email_text',
        'label'    => esc_html__('Enter Phone Text', 'gerow'),
        'section'  => 'offcanvas_setting',
        'priority' => 10,
        'default'  => esc_html__('info@example.com', 'gerow'),
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_offcanvas',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_show_offcanvas_social',
        'label'    => esc_html__('Show Offcanvas Social', 'gerow'),
        'section'  => 'offcanvas_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'gerow'),
            'off' => esc_html__('Disable', 'gerow'),
        ],
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_offcanvas',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'offcanvas_fb',
        'label'    => esc_html__('Enter Facebook url', 'gerow'),
        'section'  => 'offcanvas_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_offcanvas',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'gerow_show_offcanvas_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('#', 'gerow'),
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'offcanvas_twitter',
        'label'    => esc_html__('Enter Twitter url', 'gerow'),
        'section'  => 'offcanvas_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_offcanvas',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'gerow_show_offcanvas_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('#', 'gerow'),
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'offcanvas_instagram',
        'label'    => esc_html__('Enter Instagram url', 'gerow'),
        'section'  => 'offcanvas_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_offcanvas',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'gerow_show_offcanvas_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('#', 'gerow'),
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'offcanvas_pinterest',
        'label'    => esc_html__('Enter Pinterest url', 'gerow'),
        'section'  => 'offcanvas_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_offcanvas',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'gerow_show_offcanvas_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__('#', 'gerow'),
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_offcanvas_fields' );


/*
Mobile Menu Settings
*/
function _mobile_menu_fields( $fields ) {

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'mobile_logo',
        'label'       => esc_html__( 'Mobile Menu Logo Dark', 'gerow' ),
        'description' => esc_html__( 'Upload Your Logo.', 'gerow' ),
        'section'     => 'mobile_menu_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_show_mobile_search',
        'label'    => esc_html__( 'Show Mobile Menu Search', 'gerow' ),
        'section'  => 'mobile_menu_setting',
        'default'  => 0,
        'priority' => 12,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'gerow' ),
            'off' => esc_html__( 'Disable', 'gerow' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_show_mobile_social',
        'label'    => esc_html__( 'Show Mobile Menu Social', 'gerow' ),
        'section'  => 'mobile_menu_setting',
        'default'  => 0,
        'priority' => 12,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'gerow' ),
            'off' => esc_html__( 'Disable', 'gerow' ),
        ],
    ];

    // Mobile section social
    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_mobile_fb_url',
        'label'    => esc_html__( 'Facebook URL', 'gerow' ),
        'section'  => 'mobile_menu_setting',
        'default'  => esc_html__( '#', 'gerow' ),
        'priority' => 12,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_mobile_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_mobile_twitter_url',
        'label'    => esc_html__( 'Twitter URL', 'gerow' ),
        'section'  => 'mobile_menu_setting',
        'default'  => esc_html__( '#', 'gerow' ),
        'priority' => 12,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_mobile_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_mobile_instagram_url',
        'label'    => esc_html__( 'Instagram URL', 'gerow' ),
        'section'  => 'mobile_menu_setting',
        'default'  => esc_html__( '#', 'gerow' ),
        'priority' => 12,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_mobile_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_mobile_linkedin_url',
        'label'    => esc_html__( 'Linkedin URL', 'gerow' ),
        'section'  => 'mobile_menu_setting',
        'default'  => esc_html__( '#', 'gerow' ),
        'priority' => 12,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_mobile_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_mobile_telegram_url',
        'label'    => esc_html__( 'Telegram URL', 'gerow' ),
        'section'  => 'mobile_menu_setting',
        'default'  => esc_html__( '#', 'gerow' ),
        'priority' => 12,
        'active_callback'  => [
            [
                'setting'  => 'gerow_show_mobile_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_mobile_menu_fields' );


/*
_header_page_title_fields
 */
function _header_page_title_fields( $fields ) {

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__('Breadcrumb Background Image', 'gerow'),
        'description' => esc_html__('Upload Image', 'gerow'),
        'section'     => 'breadcrumb_setting',
        'default'     => get_template_directory_uri() . '/assets/img/bg/breadcrumb_bg.jpg',
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_hide_default',
        'label'    => esc_html__( 'Breadcrumb Hide by Default', 'gerow' ),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'gerow' ),
            'off' => esc_html__( 'Disable', 'gerow' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_info_switch',
        'label'    => esc_html__( 'Breadcrumb Nav Hide', 'gerow' ),
        'section'  => 'breadcrumb_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'gerow' ),
            'off' => esc_html__( 'Disable', 'gerow' ),
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_page_title_fields' );

/*
Header Social
 */
function _header_blog_fields( $fields ) {
// Blog Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_blog_btn_switch',
        'label'    => esc_html__( 'Blog Button ON/OFF', 'gerow' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'gerow' ),
            'off' => esc_html__( 'Disable', 'gerow' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_blog_cat',
        'label'    => esc_html__( 'Blog Category Meta ON/OFF', 'gerow' ),
        'section'  => 'blog_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'gerow' ),
            'off' => esc_html__( 'Disable', 'gerow' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_blog_author',
        'label'    => esc_html__( 'Blog Author Meta ON/OFF', 'gerow' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'gerow' ),
            'off' => esc_html__( 'Disable', 'gerow' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_blog_date',
        'label'    => esc_html__( 'Blog Date Meta ON/OFF', 'gerow' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'gerow' ),
            'off' => esc_html__( 'Disable', 'gerow' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_blog_comments',
        'label'    => esc_html__( 'Blog Comments Meta ON/OFF', 'gerow' ),
        'section'  => 'blog_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'gerow' ),
            'off' => esc_html__( 'Disable', 'gerow' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'gerow_show_blog_share',
        'label'    => esc_html__( 'Show Blog Share', 'gerow' ),
        'section'  => 'blog_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'gerow' ),
            'off' => esc_html__( 'Disable', 'gerow' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_blog_btn',
        'label'    => esc_html__( 'Blog Button text', 'gerow' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Read More', 'gerow' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__( 'Blog Title', 'gerow' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog', 'gerow' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__( 'Blog Details Title', 'gerow' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog Details', 'gerow' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_blog_fields' );

/*
Footer
 */
function _header_footer_fields( $fields ) {
    // Footer Setting
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__( 'Choose Footer Style', 'gerow' ),
        'section'     => 'footer_setting',
        'default'     => '5',
        'placeholder' => esc_html__( 'Select an option...', 'gerow' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'footer-style-1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
        ],
        'default'     => 'footer-style-1',
    ];

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'footer_widget_number',
        'label'       => esc_html__( 'Widget Number', 'gerow' ),
        'section'     => 'footer_setting',
        'default'     => '4',
        'placeholder' => esc_html__( 'Select an option...', 'gerow' ),
        'priority'    => 11,
        'multiple'    => 1,
        'choices'     => [
            '4' => esc_html__( 'Widget Number 4', 'gerow' ),
            '3' => esc_html__( 'Widget Number 3', 'gerow' ),
            '2' => esc_html__( 'Widget Number 2', 'gerow' ),
        ],
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'gerow_footer_bg_color',
        'label'       => __( 'Footer BG Color', 'gerow' ),
        'description' => esc_html__( 'This is a Footer bg color control.', 'gerow' ),
        'section'     => 'footer_setting',
        'default'     => '#051433',
        'priority'    => 12,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_copyright',
        'label'    => esc_html__( 'CopyRight', 'gerow' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( 'Copyright © Gerow 2023. All Rights Reserved', 'gerow' ),
        'priority' => 15,
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_footer_fields' );

// color
function gerow_color_fields( $fields ) {

    // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'gerow_color_option',
        'label'       => __( 'Primary Color', 'gerow' ),
        'description' => esc_html__('This is a Primary color control.', 'gerow' ),
        'section'     => 'color_setting',
        'default'     => '#0055FF',
        'priority'    => 10,
    ];

    // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'gerow_color_option2',
        'label'       => __('Secondary Color', 'gerow' ),
        'description' => esc_html__('This is a Secondary color control.', 'gerow' ),
        'section'     => 'color_setting',
        'default'     => '#00194C',
        'priority'    => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', 'gerow_color_fields' );

// 404
function gerow_404_fields( $fields ) {

    // 404 settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_error_text',
        'label'    => esc_html__('404 Text', 'gerow'),
        'section'  => '404_page',
        'default'  => esc_html__('404', 'gerow'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'gerow_error_title',
        'label'    => esc_html__( 'Not Found Title', 'gerow' ),
        'section'  => '404_page',
        'default'  => esc_html__('Sorry, the page you are looking for could not be found', 'gerow' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_error_link_text',
        'label'    => esc_html__( '404 Link Text', 'gerow' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Back To Home', 'gerow' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', 'gerow_404_fields' );


/**
 * Added Fields
 */
function gerow_typo_fields( $fields ) {
    // typography settings
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_body_setting',
        'label'       => esc_html__( 'Body Font', 'gerow' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h_setting',
        'label'       => esc_html__( 'Heading h1 Fonts', 'gerow' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h1',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h2_setting',
        'label'       => esc_html__( 'Heading h2 Fonts', 'gerow' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h2',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h3_setting',
        'label'       => esc_html__( 'Heading h3 Fonts', 'gerow' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h3',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h4_setting',
        'label'       => esc_html__( 'Heading h4 Fonts', 'gerow' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h4',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h5_setting',
        'label'       => esc_html__( 'Heading h5 Fonts', 'gerow' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h5',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h6_setting',
        'label'       => esc_html__( 'Heading h6 Fonts', 'gerow' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h6',
            ],
        ],
    ];
    return $fields;
}

add_filter( 'kirki/fields', 'gerow_typo_fields' );


/**
 * Added Fields
 */
function gerow_slug_setting( $fields ) {
    // slug settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_ev_slug',
        'label'    => esc_html__( 'Event Slug', 'gerow' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'ourevent', 'gerow' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'gerow_port_slug',
        'label'    => esc_html__( 'Portfolio Slug', 'gerow' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'ourportfolio', 'gerow' ),
        'priority' => 10,
    ];

    return $fields;
}

add_filter( 'kirki/fields', 'gerow_slug_setting' );


/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function GEROW_THEME_OPTION( $name ) {
    $value = '';
    if ( class_exists( 'gerow' ) ) {
        $value = Kirki::get_option( gerow_get_theme(), $name );
    }

    return apply_filters('GEROW_THEME_OPTION', $value, $name );
}

/**
 * Get config ID
 *
 * @return string
 */
function gerow_get_theme() {
    return 'gerow';
}