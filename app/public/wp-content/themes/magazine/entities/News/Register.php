<?php

if(!defined('ABSPATH')) {
    exit;
}

class News_Register
{
    public function __construct() {
        add_action('init', [$this, 'default_name']);
    }

    public function default_name() {
        global $wp_post_types;

        $labels = &$wp_post_types['post']->labels;
        $labels->name = esc_html__('Notícias', 'showcase');
        $labels->singular_name = esc_html__('Notícia', 'showcase');
        $labels->add_new = esc_html__('Adicionar Notícia', 'showcase');
        $labels->add_new_item = esc_html__('Adicionar Nova Notícia', 'showcase');
        $labels->edit_item = esc_html__('Editar Notícia', 'showcase');
        $labels->new_item = esc_html__('Notícia', 'showcase');
        $labels->view_item = esc_html__('Ver Notícia', 'showcase');
        $labels->search_items = esc_html__('Buscar Notícias', 'showcase');
        $labels->not_found = esc_html__('Nenhuma Notícia Encontrada', 'showcase');
        $labels->not_found_in_trash = esc_html__('Nenhuma Notícia Encontrada na Lixeira', 'showcase');
        $labels->all_items = esc_html__('Todas as Notícias', 'showcase');
        $labels->menu_name = esc_html__('Notícias', 'showcase');

      $wp_post_types['post']->menu_icon = 'dashicons-format-aside';
    }
}

new News_Register();