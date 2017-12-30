<?php
$config = require(dirname(__DIR__).'/configuration.php');
try{
	$db = new PDO('mysql:host='.$config['mysqlHost'].';dbname='.$config['mysqlDatabase'],$config['mysqlUser'], $config['mysqlPass']);
	return $db;
}catch(PDOException $info){
	return $info->getCode();
}
?>