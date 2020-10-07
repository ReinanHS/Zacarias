<?php

namespace Zacarias\Controller;

use Bootstrap\Views\View;
use Zacarias\Controller\Controller;

class HomeController extends Controller{
	public function home(){
		View::renderTemplate('Template.Home.HomePage', [
			'title' => "Zacarias Framework PHP",
		]);
	}
}