<?php
namespace Bootstrap\Views;
use Bootstrap\Bootstrap;
class View
{
	# Atributos
	# Métados Especiais
	# Metados
	static public function view($view,  $args = [])
	{
		extract($args, EXTR_SKIP);
		$local = str_replace(".", "/", $view);
		if(is_readable(Bootstrap::getDir().'/src/Views/'.$local.'.phtml'))
		{
			include(Bootstrap::getDir().'src/Views/'.$local.'.phtml');
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
	static public function renderTemplate(string $template, array $args = [])
	{
		static $twig = null;
		if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem(Bootstrap::getDir().'/src/Views/');
            $twig = new \Twig_Environment($loader);
        }
        $template = str_replace(".", "/", $template);
        $template = $template.'.phtml';
        echo $twig->render($template, $args);
	}
}