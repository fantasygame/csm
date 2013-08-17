<?php
ini_set('error_reporting', 'E_ALL & ~E_DEPRECATED & ~E_STRICT');

require './app/lib/Application.php';

try {
	new Application();
} catch (Exception $e) {
	exit($e->getMessage());
}

$config = SimpleConfig::getInstance();

$request = new Request();
$config['request'] = $request;

$router = new Router($config['routing_file']);

try {
	$router->route($request);
} catch (Exception $e) {
	if ($config['environment'] == 'production') {
		header("HTTP/1.0 404 Not Found");
	} else {
		echo "<p>{$e->getMessage()}</p>";
		echo "<p>{$e->getFile()}<br/>line {$e->getLine()}</p>";
	}
}
?>