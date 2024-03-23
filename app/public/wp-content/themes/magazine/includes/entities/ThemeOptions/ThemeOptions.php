<?php

if(!defined('ABSPATH')) {
    exit;
}

const PARENT_PAGE_FIELD = 'theme-options';

const HEADER_SUBPAGE_FIELDS = [
    [
        'key' => 'field_65fe105c97b09',
        'label' => 'Lista de Categorias',
        'name' => 'categoriesList',
        'aria-label' => '',
        'type' => 'taxonomy',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'taxonomy' => 'category',
        'add_term' => 1,
        'save_terms' => 0,
        'load_terms' => 0,
        'return_format' => 'object',
        'field_type' => 'multi_select',
        'allow_null' => 1,
        'bidirectional' => 0,
        'multiple' => 0,
        'bidirectional_target' => [],
    ]
];

class ThemeOptions
{
    public function __construct() 
    {
        add_action('acf/init', [$this, 'register_page']);
        add_action('acf/init', [$this, 'register_sub_pages']);

        add_action('acf/include_fields', [$this, 'register_header_subpage_fields']);
        add_action('graphql_register_types', [$this, 'register_header_subpage_fields_graphql']);
    }

    public function register_page() 
    {
        if(!function_exists('acf_add_options_page')) {
            return;
        }

        acf_add_options_page([
            'page_title' => esc_html__('Opções do Tema', 'magazine'),
            'menu_slug' => PARENT_PAGE_FIELD,
            'position' => 2,
            'redirect' => true,
        ]);
    }

    public function register_sub_pages() 
    {
        if(!function_exists('acf_add_options_page')) {
            return;
        }

        acf_add_options_page([
            'page_title' => esc_html__('Cabeçalho', 'magazine'),
            'menu_slug' => 'header',
            'parent_slug' => PARENT_PAGE_FIELD,
            'position' => 1,
            'redirect' => false,
        ]);
    }

    public function register_header_subpage_fields() 
    {
        if(!function_exists('acf_add_local_field_group')) {
            return;
        }

        $header_subpage_field_group = [
            'key' => 'group_65fe1003a0974',
            'title' => esc_html__('Opções do Tema - Cabeçalho', 'magazine'),
            'fields' => [
                [
                    'key' => 'field_65fe100397b08',
                    'label' => esc_html__('Categorias', 'magazine'),
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'placement' => 'top',
                    'endpoint' => 0,
                ],
                ...HEADER_SUBPAGE_FIELDS,
            ],
            'location' => [
                [
                    [
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'header',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        ];

        acf_add_local_field_group($header_subpage_field_group);        
    }

    public function register_header_subpage_fields_graphql() 
    {
        $header_subpage_field_group = [];

        foreach(HEADER_SUBPAGE_FIELDS as $header_fields) {
            $header_subpage_field_group[$header_fields['name']]['type'] = 'String'; 
        }

        register_graphql_object_type('ThemeOptionsHeader', [
            'description' => __('Logo personalizado do Customizer', 'magazine'),
            'fields' => [
                ...$header_subpage_field_group,
            ],
        ]);

        register_graphql_field( 'RootQuery', 'themeOptionsHeader', [
            'type' => 'ThemeOptionsHeader',
            'resolve' => function () {
                $header_subpage_fields = [];

                foreach(HEADER_SUBPAGE_FIELDS as $header_field) {
                    $header_subpage_fields[$header_field['name']] = json_encode(get_field($header_field['name'], 'option'));
                }

                return $header_subpage_fields;
            },
        ]);
    }
}

new ThemeOptions();