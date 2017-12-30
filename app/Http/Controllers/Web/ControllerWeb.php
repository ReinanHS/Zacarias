<?php
/**
* @author ReinanHS
*/
namespace App\Http\Controllers\Web;
use BootStrap\init\View;
class ControllerWeb
{
	# Atributos
	# Métados Especias
	public function index($params)
	{
		$text = "Olá Mundo";
		View::renderTemplate('Web.test', compact('text'));
	}
	# Métados
}
?>