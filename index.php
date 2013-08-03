<?php
require './autoload.php';
$mysql = new MySql('localhost', 'root', 'okurwakacper', 'csm');

$sheetRepository = new SheetRepository($mysql);
$sheet = $sheetRepository->gimmeNaklatanox('ROAAAAAAR!');

$sheetRepository->persist($sheet);

?>
