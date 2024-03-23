<?php

if(!defined('ABSPATH')) {
    exit;
}

class CategoryUtils 
{
    public static function get_categories() {
        $categories_list = get_categories();

        if(empty($categories_list)) {
            return [];
        }

        $_categories_list = [];

        foreach($categories_list as $key => $category) {
            $_categories_list[$category->term_id] = $category->name; 
        }

        return $_categories_list;
    }
}