<?php 
/**
* @@author ReinanHS <reinangabriel50@gmail.com>
*/
namespace Bootstrap;
class Bootstrap
{
	# Atributos
	# Métodos Especiais
	public function __construct()
	{
		$this->run();
	}
	public function getConfig(string $key = null, string $subKey = null)
	{
		$data = parse_ini_file('config.ini', true);

		if(isset($subKey) && isset($data[$key][$subKey]))
		{
			return $data[$key][$subKey];
		}else if(isset($key) && isset($data[$key]))
		{
			return $data[$key];
		}
		return $data;
	}
	public function getDir()
	{
		return dirname(__DIR__);
	}
	# Métados
	public function run()
	{
		//$teste = new Route();
		//Route::get('api/home/', 'Controller\Api\MainController@home');
		require(dirname(__DIR__).'/src/Routing/web.php');
	}
}
 ?>