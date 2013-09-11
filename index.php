<?php

require './app/lib/Application.php';

try {
	new Application();
} catch (Exception $e) {
	exit($e->getMessage());
}
session_start();

$loginSystem = new PHPBB3LoginSystem();
$loginSystem->login();

$config = SimpleConfig::getInstance();

$request = new Request();
$config['request'] = $request;

$router = new Router($config['routing_file']);

try {
	$response = $router->route($request);
	$response->resolve();
} catch (Exception $e) {
	$view = new View();
	echo $view->render('error.html.twig', array('exception' => $e, 'environment' => $config['environment']));
}
session_write_close();
?>
