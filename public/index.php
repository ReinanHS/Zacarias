<?php

use Bootstrap\Bootstrap;
use Bootstrap\System\ErrorController;

if ( file_exists(dirname(__DIR__) . '/vendor/autoload.php') ) {
  header("Access-Control-Allow-Origin: *");
  
  require "../vendor/autoload.php";
  require "../vendor/larapack/dd/src/helper.php";
  
  $init = new Bootstrap();

}else{
  require_once('../config/System/ErrorController.php');
  ErrorController::render('Para usar o <b>Zacarias</b> é necessário baixar as dependências do projeto com o comando <pre><code>composer install</code></pre>');
}