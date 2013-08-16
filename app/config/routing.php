<?php

$routes = array(
	'default' => array(
		'controller' => 'DefaultController',
		'defaultAction' => 'index',
		'actions' => array(),
	),
	'sheet' => array(
		'controller' => 'SheetController',
		'actions' => array(
			'form' => array(),
			'show' => array('id'),
			'list' => array(),
			'remove' => array('id'),
		),
		'defaultAction' => 'list'
	),
	'user' => array(
		'controller' => 'UserController',
		'actions' => array(
			'hello' => array('name'),
			'bye'
		),
		'defaultAction' => 'hello'
	),
);
?>
