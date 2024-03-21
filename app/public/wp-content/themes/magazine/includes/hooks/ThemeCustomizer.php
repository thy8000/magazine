<?php

if(!defined('ABSPATH')) {
    exit;
}

const SOCIAL_MEDIA_LIST = ['Instagram', 'Facebook', 'Twitter', 'LinkedIn', 'YouTube'];
const CUSTOM_LOGO_SIZE = [
    'width'       => 220,
    'height'      => 186,
];

class ThemeCustomizer
{
    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'custom_logo']);
        add_action('graphql_register_types', [$this, 'custom_logo_graphql']);
    }

    public function custom_logo($wp_customize) {
        add_theme_support( 'custom-logo', [
            'width'  => CUSTOM_LOGO_SIZE['width'],
            'height' => CUSTOM_LOGO_SIZE['height'],
        ]);
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
}

new ThemeCustomizer();