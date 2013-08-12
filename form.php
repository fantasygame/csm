<?php

require './class/util/AutoloadCsm.php';
require './vendors/sensio/Twig/Autoloader.php';
Twig_Autoloader::register();
AutoloadCsm::register();

$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);

// connect to database
$db = new Database('localhost', 'psw0', 'okurwakacper', 'mysql', 'csm');

$form = new formread();
$sheet = $form->getForm();

$rep = new SheetRepository($db);
$rep->persist($sheet);


echo '<pre>';
print_r($sheet);
echo '</pre>';
exit();
?>
