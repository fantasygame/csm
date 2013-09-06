<?php

require './app/lib/Application.php';

try {
	new Application();
} catch (Exception $e) {
	exit($e->getMessage());
}

//// phpbb3 needs junk global variables
//$phpbb3 = new PHPBB3Integrator();
//$userId = $phpbb3->getUserId();
//unset($GLOBALS, $phpbb_root_path, $phpEx, $user, $db, $config, $cache, $template, $auth, $phpbb_hook);
$config = SimpleConfig::getInstance();
//require './entity/User.php';
//
//$vars = get_defined_vars();
//echo '<pre>';
//print_r(get_declared_classes());
//
//print_r($vars);
//echo '</pre>';
//echo '<pre>';
//print_r($userId);
//echo '</pre>';
//exit();
//
//$userId = 1;
////
//$loginSystem = new LoginSystem();
//try {
//	$loginSystem->login($userId);
//} catch (Exception $e) {
//	exit($e->getMessage());
//}

$request = new Request();
$config['request'] = $request;

$router = new Router($config['routing_file']);

try {
	$response = $router->route($request);
	$response->resolve();
} catch (Exception $e) {
	if ($config['environment'] == 'production') {
		header("HTTP/1.0 404 Not Found");
	} else {
		echo "<p>{$e->getMessage()}</p>";
		echo "<p>{$e->getFile()}<br/>line {$e->getLine()}</p>";
		echo '<pre>';
		print_r($e->getTraceAsString());
		echo '</pre>';
		exit();
	}
}
?>
