<?php
	session_start();
	mb_internal_encoding("UTF-8");

	$matches;
	preg_match('/\/([^?]*)/',$_SERVER['REQUEST_URI'],$matches);
	$action = $matches[1];
	$action = strtolower(urldecode($action));
	
	preg_match('/([^.]*).lnk-to.ru/',$_SERVER['SERVER_NAME'],$matches);
	$actionsub = strtolower($matches[1]);
	
	define('ENGINE_DIR', dirname(__FILE__) . '/pages/engine/');
	define('PAGES_DIR', dirname(__FILE__) . '/pages/pages/');

	require_once(ENGINE_DIR . 'config.php');
	require_once(ENGINE_DIR . 'db.php');
	require_once(ENGINE_DIR . 'template.php');

	$template = new Template;
	$template -> views($action,$actionsub);
?>