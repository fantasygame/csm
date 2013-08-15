<?php

$routes = array(
	'default' => array(
		'controller' => 'DefaultController',
		'defaultAction' => 'index',
		'actions' => array(),
	),
	'user' => array(
		'controller' => 'UserController',
		'actions' => array(
			'hello' => array('name'),
			'bye'
		),
		'defaultAction' => 'hello'
	)
);
?>
