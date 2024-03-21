<?php

if(!defined('ABSPATH')) {
    echo 'Inicie WordPress';

    exit;
}

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'includes', 'entities', '_index.php']);
require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'includes', 'hooks', '_index.php']);