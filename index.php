<?php

// autoload unloaded Class
require './autoload.php';
spl_autoload_register('autoload');

// connect to database
$db = new Database('localhost', 'root', 'okurwakacper', 'mysql', 'csm');


$attributeRepository = new AttributeRepository($db);

$attributeRepository->getAll();


exit();
// create repository to manage Sheet in database
$sheetRepository = new SheetRepository($db);

// create sample Sheet
$sheet = $sheetRepository->gimmeNaklatanox();

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