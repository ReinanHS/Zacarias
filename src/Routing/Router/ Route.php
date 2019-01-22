<?php
/**
 *
 * @copyright     Copyright (c) ReinanHS, Inc. (https://reinanhs.github.io/)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.0.1
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Zacarias\Routing\Router;
class Route
{
	// Atributos
	// Métodos Especiais
	public function __construct()
	{
			
	}
	// Métodos
	public function get(string $url, string $controller)
	{
		$url_server = explode('/', $_SERVER['REQUEST_URI']);
		array_splice($url_server, 0, 1);

		$url = explode('/', $url);

		$dn = $url;

		$parat = [];

		foreach ($url as $key => $value) {
			if(strpos($value, '}') > 0 && !empty($url_server[$key])){
				$name = str_replace('{','',$value);
				$name = str_replace('}','',$name);

				$dn[$key] = $url_server[$key];
				$parat[$name] = $url_server[$key];
			} 
		}

		if($url_server == $dn){
			$meth = explode('@', $controller);
			if(isset($meth[1])){
				$class = $meth[0]; 
				$method = $meth[1];
				$instance = new $class();
				return $instance->$method();
			}else{
				$class = $meth[0]; 
				$instance = new $class();


				return call_user_func_array(array($instance, "index"), $parat);

				//return $instance->index($parat);
			}
		}
		
	}
	public function post(string $url, string $controller)
	{
		$url_server = explode('/', $_SERVER['REQUEST_URI']);
		array_splice($url_server, 0, 1);

		$url = explode('/', $url);

		$dn = $url;

		$parat = [];

		foreach ($url as $key => $value) {
			if(strpos($value, '}') > 0 && !empty($url_server[$key])){
				$name = str_replace('{','',$value);
				$name = str_replace('}','',$name);

				$dn[$key] = $url_server[$key];
				$parat[$name] = $url_server[$key];
			} 
		}

		if($url_server == $dn && isset($_POST) && !empty($_POST)){
			$meth = explode('@', $controller);
			if(isset($meth[1])){
				$class = $meth[0]; 
				$method = $meth[1];
				$instance = new $class();
				return $instance->$method();
			}else{
				$class = $meth[0]; 
				$instance = new $class();


				return call_user_func_array(array($instance, "index"), $parat);

				//return $instance->index($parat);
			}
		}
		
	}
}