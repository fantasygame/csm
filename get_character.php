<?php

// autoload unloaded Class
require './class/util/AutoloadCsm.php';
require './vendors/sensio/Twig/Autoloader.php';
Twig_Autoloader::register();
AutoloadCsm::register();

// connect to database
$db = new Database('localhost', 'user', 'password', 'mysql', 'csm');

$sheetRepository = new SheetRepository($db);

$id = 1;

$sheet = $sheetRepository->getById($id);

echo '<pre>';
print_r($sheet);
echo '</pre>';

?>
