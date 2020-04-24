<?php 

define('ROOT', dirname(__FILE__));
require_once ROOT."/config/config.php";




$controller = 'MainController';
$method = 'index';

if(isset($_REQUEST['save']))
{
	$controller = "MainController";
	$method = "newTask";
}
if(isset($_REQUEST['delete']))
{
	$controller = 'MainController';
	$method = 'deleteTask';
}
if(isset($_REQUEST['edit']))
{
	$controller = 'MainController';
	$method = 'editTask';
}
if(isset($_REQUEST['update']))
{
	$controller = 'MainController';
	$method = 'updateTask';
}

$path = 'app/Controllers/'.$controller.'.php';

if(file_exists($path))
{
	require_once"$path";

	if(class_exists($controller) && method_exists($controller, $method))
	{
		$c_obj = new $controller();
		$c_obj->$method();
	}
	else
	{
		die('Page not found ERROR-404');
	}
}
else
{	
	die('Page not found ERROR-404');
}