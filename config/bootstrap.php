<?php 
/**
* @@author ReinanHS <reinangabriel50@gmail.com>
*/
namespace Bootstrap;

use CoffeeCode\Router\Router;

class Bootstrap
{
	# Atributos
	# Métodos Especiais
	public function __construct()
	{
		$this->run();
	}
	
	public function getConfig(){
		$data = parse_ini_file('config.ini', true);
		return $data;
	}

	public function getDir(): String{
		return dirname(__DIR__);
	}

	# Métados
	public function run(): void{
		// $router = new Router("https://www.youdomain.com");
		
		exit();
	}
}
 ?>