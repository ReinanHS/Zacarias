<?php
/**
 *
 * @copyright     Copyright (c) ReinanHS, Inc. (https://reinanhs.github.io/)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.0.1
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Bootstrap\Bootstrap;
namespace Zacarias\Database;
class Database
{
	// Atributos
	private $host;
	private $dbname;
	private $user;
	private $senha;
	// Métodos Especiais
	public function __construct()
	{
		// return null
	}
	// Métodos
	public function getDB()
	{
		$dsn = 'mysql:host='.Bootstrap::getConfig(['database']['host']);
		$dsn .= ';dbname='.Bootstrap::getConfig(['database']['dbname']);
		$dsn .= ';charset=utf8';

		$user = Bootstrap::getConfig(['database']['user']);
		$password = Bootstrap::getConfig(['database']['senha']);

		try {
		    $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		    return $dbh;
		} catch (PDOException $e) {
		    echo 'Connection failed: ' . $e->getMessage(); exit();
		}
	}
	public function getUserById(int $id)
	{
		$con = $this->getDB()->prepare('SELECT `id`, `user`, `avatar` FROM `users` WHERE `id` = :id');
		$con->bindValue(':id', $id, PDO::PARAM_INT);
		$con->execute();

		if($con->rowCount() > 0){
			return $con->fetch(PDO::FETCH_ASSOC);
		}

		return false;
	}
	public function getUserByUser($username)
	{
		$con = $this->getDB()->prepare('SELECT `id` FROM `users` WHERE `user` = :user');
		$con->bindValue(':user', $username, PDO::PARAM_STR);
		$con->execute();

		if($con->rowCount() > 0){
			return true;
		}

		return false;
	}
	public function getUserAuth($username, $password)
	{
		$con = $this->getDB()->prepare('SELECT `id`, `user`, `avatar` FROM `users` WHERE `user` = :user AND `password` = :password');
		$con->bindValue(':user', $username, PDO::PARAM_STR);
		$con->bindValue(':password', md5(md5($password)), PDO::PARAM_STR);
		$con->execute();

		if($con->rowCount() > 0){
			return $con->fetch(PDO::FETCH_ASSOC);
		}

		return false;
	}
	public function createUser(array $data)
	{
		$avatar = 'https://api.adorable.io/avatars/126/'.$data['username'].'.png';

		try {

			$con = $this->getDB()->prepare('INSERT INTO `users` (`id`, `user`, `password`, `avatar`) VALUES (NULL, :user, :password, :avatar)');
			$con->bindValue(':user', $data['username'], PDO::PARAM_STR);
			$con->bindValue(':password', md5(md5($data['password'])), PDO::PARAM_STR);
			$con->bindValue(':avatar', $avatar, PDO::PARAM_STR);
			$con->execute();

			$con = $this->getDB()->prepare('SELECT `id`, `user`, `avatar` FROM `users` WHERE `user` = :user');
			$con->bindValue(':user', $data['username'], PDO::PARAM_STR);
			$con->execute();

			return $con->fetch(PDO::FETCH_ASSOC);
			
		} catch (Exception $e) {
			return false;
		}
	}
}