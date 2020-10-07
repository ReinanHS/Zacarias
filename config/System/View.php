<?php

namespace Bootstrap\System;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View{
  public static function render(String $view, array $args = []){
    $loader = new FilesystemLoader(DOCROOT . '/src/Views');
    $twig = new Environment($loader);

    $view = str_replace(".", "/", $view);
    $view = $view.'.phtml';
    
    echo $twig->render($view, $args);
    
    exit();
  }
}