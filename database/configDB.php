<?php
$config = parse_ini_file(dirname(__DIR__).'/config.ini', true);
try{
	$db = new PDO('mysql:host='.$config['DB_HOST'].';dbname='.$config['DB_DATABASE']+';charset=utf8',$config['DB_USERNAME'], $config['DB_PASSWORD']);
	return $db;
}catch(PDOException $info){
	return $info->getCode();
}
?>