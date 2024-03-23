<?php

if(!defined('ABSPATH')) {
    exit;
}

const SOCIAL_MEDIA_LIST = ['Instagram', 'Facebook', 'Twitter', 'LinkedIn', 'YouTube'];

const CUSTOM_LOGO_SIZE = [
    'width'       => 220,
    'height'      => 186,
];

const CUSTOM_COLORS = [
    'pageColor' => [
        'label' => 'Página', 
        'priority' => 1,
    ],
    'headerColor' => [
        'label' => 'Header', 
        'priority' => 2,
    ],
];

class ThemeCustomizer
{
    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'custom_logo']);
        add_action('graphql_register_types', [$this, 'custom_logo_graphql']);

        add_action('customize_register',     [$this, 'custom_colors']);
        add_action('graphql_register_types', [$this, 'custom_colors_graphql']);

        add_action('customize_register',     [$this, 'custom_social_shares']);
        add_action('graphql_register_types',     [$this, 'custom_social_shares_graphql']);
    }

    public function custom_logo($wp_customize) {
        add_theme_support( 'custom-logo');
    }

    public function custom_logo_graphql() {
        register_graphql_object_type('CustomLogo', [
            'description' => __('Logo personalizado do Customizer', 'magazine'),
            'fields' => [
                'url'         => ['type' => 'String'],
                'description' => ['type' => 'String'],
                'width'       => ['type' => 'Int'],
                'height'      => ['type' => 'Int'],
            ],
        ]);

        register_graphql_field( 'RootQuery', 'custom_logo', [
            'type' => 'CustomLogo',
            'resolve' => function () {
                if(empty(get_theme_mod('custom_logo'))){
                    return [];
                }

                return [
                    'url'         => wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0],
                    'description' => get_bloginfo('name'),
                    'width'       => CUSTOM_LOGO_SIZE['width'],
                    'height'      => CUSTOM_LOGO_SIZE['height'],
                ];
            },
        ]);
    }

    public function custom_colors($wp_customize) {
        $wp_customize->add_section('custom_colors', [
            'title' => esc_html__('Cores', 'magazine'),
        ]);

        foreach(CUSTOM_COLORS as $color_slug => $color) {
            $wp_customize->add_setting($color_slug, [
                'default' => '#FFFFFF',
            ]);

            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $color_slug, [
                'label'    => esc_html__($color['label'], 'magazine'),
                'section'  => 'custom_colors',
                'settings' => $color_slug,
                'priority' => $color['priority'],
            ]));
        }
    }

    public function custom_colors_graphql() {
        $custom_colors_object_fields = [];

        foreach(CUSTOM_COLORS as $key => $color) {
            $custom_colors_object_fields[$key] = ['type' => 'String'];
        }

        register_graphql_object_type('CustomColors', [
            'description' => __('Cores personalizadas do Customizer', 'magazine'),
            'fields' => [
                ...$custom_colors_object_fields
            ],
        ]);

        register_graphql_field( 'RootQuery', 'CustomColors', [
            'type' => 'CustomColors',
            'resolve' => function () {

                $custom_color_fields = [];

                foreach(CUSTOM_COLORS as $key => $color) {
                    $custom_color_fields[$key] = get_theme_mod($key) ? get_theme_mod($key) : '#FFFFFF';
                }

                return $custom_color_fields;
            },
        ]);
    }

    public function custom_social_shares($wp_customize) {
        $wp_customize->add_section('custom_social_shares', [
            'title'    => esc_html__('Redes Sociais', 'magazine'),
        ]);

        foreach(SOCIAL_MEDIA_LIST as $social_media) {
            $slug = sanitize_title($social_media);

            $wp_customize->add_setting("custom_social_share_{$slug}", [
                'default'   => '',
                'transport' => 'refresh',
            ]);

            $wp_customize->add_control("custom_social_share_{$slug}", [
                'label'    => sprintf(esc_html__('Link %s', 'magazine'), $social_media),
                'section'  => 'custom_social_shares',
                'settings' => "custom_social_share_{$slug}",
            ]);
        }
    }

    public function custom_social_shares_graphql() {
        register_graphql_object_type('CustomSocialShares', [
            'description' => __('Redes sociais personalizadas do Customizer', 'magazine'),
            'fields' => [
                'data' => ['type' => 'String'],
            ],
        ]);

        register_graphql_field( 'RootQuery', 'CustomSocialShares', [
            'type' => 'CustomSocialShares',
            'resolve' => function () {
                $social_share_field = [];
                
                foreach(SOCIAL_MEDIA_LIST as $social) {
                    $slug = sanitize_title($social);

                    $social_share_field[$slug] = [
                        'slug' => $slug,
                        'url'  => get_theme_mod("custom_social_share_{$slug}") ? get_theme_mod("custom_social_share_{$slug}") : '',
                    ];
                }

                return [
                    "data" => json_encode($social_share_field)
                ];
/*
                $social_share_fields = [];

                foreach(SOCIAL_MEDIA_LIST as $social) {
                    $slug = sanitize_title($social);

                    $social_object = [
                        'slug' => $slug,
                        'url'  => get_theme_mod("custom_social_share_{$slug}") ? get_theme_mod("custom_social_share_{$slug}") : '',
                    ];

                    $social_share_fields[$slug] = json_encode($social_object);
                }

                return $social_share_fields;
                */
            },
        ]);
    }
}

new ThemeCustomizer();