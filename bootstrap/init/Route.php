<?php
namespace BootStrap\init;
class Route
{
    # Atributos
    public $routes = [];
    public $params = [];
    # Métados Especiais
    public function __construct()
    {
        $this->setRoutes();
    }
    public function getRoutes()
    {
        return $this->routes;
    }
    public function setRoutes()
    {
        require(dirname(__DIR__).'/../routes/web.php');
    }
    public function getUrl()
    {
        $url = filter_input(INPUT_SERVER, 'REQUEST_URI');
        # Isso que é só para o uso no localhost
        $url = substr($url, 18);
        return ($url);
    }
    # Métados
    public function get($name, $route = "/", $controller, $namespace = "App\Http\Controllers")
    {
        $route = substr($route, 0 , strpos($route, "/@"));
        $action =  substr($controller, strpos($controller, "@"));
        $controlle = substr($controller, 0 , strpos($controller, "@"));

        $action = ($action == "") ? $action = 'index' : $action;
        $action = ($action == $controller) ? $action = 'index' : $action;
        $controlle = ($controlle == "") ? $controlle = $controller : $controlle;
        $route = ($route == "") ? $route = '/' : $route;

        $this->routes[$name] = ['route' => $route, 'controller' => $controlle, 'action' => $action, 'namespace' => $namespace];
    }
}
?>