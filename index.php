<?php

require './app/lib/Application.php';
new Application();

$config = SimpleConfig::getInstance();

$request = new Request();
$router = new Router($config['routing_file']);

try {
	$router->route($request);
} catch (Exception $e) {
	if($config['environment'] == 'production') {
		echo 'Nie ma takiej strony';
	} else {
		echo "<p>{$e->getMessage()}</p>";
		echo "<p>{$e->getFile()}<br/>line {$e->getLine()}</p>";
	}
}
?>
