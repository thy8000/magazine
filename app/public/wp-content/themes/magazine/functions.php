<?php

if(!defined('ABSPATH')) {
    echo 'Inicie WordPress';

    exit;
}

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'includes', 'entities', '_index.php']);

function debug()
{
   $args     = func_get_args();
   $file_idx = 0;

   if (isset($args[1]) && 'DEBUG_ARRAY_IN_SECOND_LEVEL' === $args[1]) {
      $args     = $args[0];
      $file_idx = 1;
   }

   $files = debug_backtrace();
   $log   = "\n[DEBUG] {$files[$file_idx]['file']}:{$files[$file_idx]['line']}";

   foreach ($args as $key => $arg) {
      $log .= "\n[ ";

      if ($key < 10) {
         $log .= '0';
      }
      $log .= "{$key} ] ";

      $log .= var_export($arg, 1);
   }

   error_log($log);

   return $args[0];
}