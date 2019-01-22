<?php
/**
 *
 * @copyright     Copyright (c) ReinanHS, Inc. (https://reinanhs.github.io/)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.0.1
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Zacarias\Controller\Api;
use Bootstrap\Views\View;
class MainController
{
	// Atributos
	public function __construct()
	{
		# code...
	}
	// Métodos Especiais
	// Métodos
	public function home()
	{
		$title = "Zacarias Framework PHP";
		View::renderTemplate('Template.Home.HomePage', compact('title'));
	}
}