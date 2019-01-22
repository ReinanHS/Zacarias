<?php
/**
 *
 * @copyright     Copyright (c) ReinanHS, Inc. (https://reinanhs.github.io/)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.0.1
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Zacarias\Routing\Router\Route;
/**
 * Rota é um termo bem interessante. Não tinha parado para pensar o quão abrangente ele até digitar no Google 
 * “define rota”. Para sites e sistemas feitos para a internet uma rota é um caminho para acessar um recurso 
 * através da composição de uma URL válida.
 *
 * ### Na Prática
 *
 * Vamos configurar nossas rotas
 * Route::get('api/home/', 'Controller\Api\MainController@home');
 */

Route::get('', 'Zacarias\Controller\Api\MainController@home');