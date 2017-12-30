<?php
namespace BootStrap\init;
use BootStrap\init\Bootstrap;
class View
{
	# Atributos
	# Métados Especiais
	# Metados
	public function view($view,  $args = [])
	{
		extract($args, EXTR_SKIP);
		$local = str_replace(".", "/", $view);
		if(is_readable(dirname(__DIR__).'/../resources/views/'.$local.'.phtml'))
		{
			include(dirname(__DIR__).'/../resources/views/'.$local.'.phtml');
		}
		else
		{
			if ($this->logger) 
			{
            	$this->logger->error('Could not find the view: '. $local);
        	}
        	return false;
		}
	}
	public function renderTemplate($template, $args = [])
	{
		static $twig = null;
		if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem(dirname(__DIR__).'/../resources/views/');
            $twig = new \Twig_Environment($loader);
        }
        $template = str_replace(".", "/", $template);
        $template = $template.'.phtml';
        echo $twig->render($template, $args);
	}
}
?>