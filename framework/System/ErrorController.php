<?php

namespace Bootstrap\System;

class ErrorController
{
  public static function render(String $class, String $message, String $file, int $line)
  {
    $type = 'render';

    http_response_code(500);
    include_once(DOCROOT . '/config/System/views/error.phtml');

    exit();
  }

  public static function abort(String $message, int $status = 500)
  {
    $type = 'abort';

    http_response_code($status);
    include_once(DOCROOT . '/config/System/views/error.phtml');

    exit();
  }
}
