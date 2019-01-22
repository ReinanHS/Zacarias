<?php
/**
* @author ReinanHS
*/
namespace App\Http\Controllers\Web;
use BootStrap\init\View;
use App\Init;
class ControllerWeb
{
	# Atributos
	# Métados Especias
	public function index($params)
	{
		$title = "Zacarias Framework PHP";
		View::renderTemplate('Web.test', compact('title'));
	}
	# Métados
}
?>