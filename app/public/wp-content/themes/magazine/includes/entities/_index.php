<?php

if(!defined('ABSPATH')) {
    echo 'Inicie WordPress';

    exit;
}

require implode(DIRECTORY_SEPARATOR, [__DIR__, 'News', '_index.php']);