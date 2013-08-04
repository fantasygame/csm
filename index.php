<?php

require './autoload.php';
$db = new Database('localhost', 'root', 'okurwakacper', 'mysql', 'csm');

$sheetRepository = new SheetRepository($db);
$sheet = $sheetRepository->gimmeNaklatanox();

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