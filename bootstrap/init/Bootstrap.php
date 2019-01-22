<?php 
/**
* @@author ReinanHS <reinangabriel50@gmail.com>
*/
use Psr\Log\LoggerInterface;
use BootStrap\init\Route;
use BootStrap\init\View;
namespace BootStrap\init;
abstract class BootStrap
{
	# Atributos
	protected $dataBase;
	protected $logger;
	protected $config;
	# Métodos Especiais
	public function __construct(LoggerInterface $logger = null)
	{
		$this->token();
		$this->logger = $logger;
		$this->run();
		$this->setConfig();
	}
	protected function getDateBase()
	{
		return require(dirname(__DIR__).'/../database/configDB.php');
	}
	protected function setDataBase($db)
	{
		$this->dataBase = $db;
	}
	protected function getConfig()
	{
		return $this->config;
	}
	protected function setConfig()
	{
		$this->config = parse_ini_file(dirname(__DIR__).'/../config.ini', true);
	}
	protected function getUrl()
	{
		$url = filter_input(INPUT_SERVER, 'REQUEST_URI');
		# Isso que é só para o uso no localhost
		$url = substr($url, 18);
		return ($url);
	}
	# Métados
	protected function run()
	{
		$route = new Route();
		$erroNofile = false;
		$url = $this->getUrl();
        $url = substr($url, 1);
        $url = explode('/', $url);
        $url[0] = '/'.$url[0];
		foreach ($route->getRoutes() as $route) 
		{
			if($this->getUrl() == $route['route'])
			{
				$class = $route['namespace'];
				$action = $route['action'];
				$controller = new $class();
				$controller->$action(false);

				$erroNofile = true;
				break;
			}
			elseif ($url[0] == $route['route']) {

				$params = $this->getUrl();
        		$params = substr($params, strlen($route['route'])+1);
        		$params = explode('/', $params);

				$class = $route['namespace'];
				$action = $route['action'];
				$controller = new $class();
				$controller->$action($params);

				$erroNofile = true;
				break;
			}
		}
		if(!$erroNofile)
		{
			View::renderTemplate('404');
		}
	}
	protected function token()
	{
		session_start();
		$_SESSION['_token'] = (!isset($_SESSION['_token'])) ? hash('sha512', rand(100, 1000)) : $_SESSION['_token'];
	}
}
 ?>