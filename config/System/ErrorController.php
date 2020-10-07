<?php
namespace Bootstrap\System;

class ErrorController{
  public static function render(String $message, int $status = 500){
    http_response_code($status);
    include_once(dirname(__DIR__) . '/Views/pages/error.phtml');

    exit();
  }
}