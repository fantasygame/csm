<?php
require './autoload.php';
$mysql = new MySql('localhost', 'root', 'okurwakacper', 'csm');

$repository = new SheetRepository($mysql);
$sheet = $repository->gimmeNaklatanox('ROAAAAAAR!');
$repository->persist($sheet);

?>
