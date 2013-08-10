<?php

// autoload unloaded Class
require './class/util/AutoloadCsm.php';
require './vendors/sensio/Twig/Autoloader.php';
Twig_Autoloader::register();
AutoloadCsm::register();

$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);

// connect to database
$db = new Database('localhost', 'user', 'password', 'mysql', 'csm');

// create repository to manage Sheet in database
$sheetRepository = new SheetRepository($db);

// create sample Sheet
$sheet = $sheetRepository->gimmeNaklatanox();

echo $twig->render('character.html.twig', array('sheet' => $sheet));

// persist Sheet in database (catching errors)
// persist method uses transaction http://en.wikipedia.org/wiki/Database_transaction
try {
	$sheetRepository->persist($sheet);
} catch (Exception $e) {
	echo '<pre>';
	echo $e->getMessage();
	echo '</pre>';
	echo '<pre>';
	print_r($e->getTrace());
	echo '</pre>';
}



?>