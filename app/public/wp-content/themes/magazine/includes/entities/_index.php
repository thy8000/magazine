<?php

if(!defined('ABSPATH')) {
    echo 'Inicie WordPress';

    exit;
}

require implode(DIRECTORY_SEPARATOR, [__DIR__, 'Categories', '_index.php']);
require implode(DIRECTORY_SEPARATOR, [__DIR__, 'News', '_index.php']);
require implode(DIRECTORY_SEPARATOR, [__DIR__, 'ThemeCustomizer', '_index.php']);
require implode(DIRECTORY_SEPARATOR, [__DIR__, 'ThemeOptions', '_index.php']);
