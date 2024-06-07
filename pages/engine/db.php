<?php
$db = new mysqli($config['host'], $config['user'], $config['pass'], $config['base']);
if($db->connect_errno)
{	
	exit('Ошибка: Не удалось соединиться с сервером базы данных!');
}
else
{	
	$result = $db->query("SET NAMES utf8");
}
?>