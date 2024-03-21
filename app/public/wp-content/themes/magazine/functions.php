<?php

if(!defined('ABSPATH')) {
    echo 'Inicie WordPress';

    exit;
}

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'entities', '_index.php']);