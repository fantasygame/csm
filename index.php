<?php

require 'class/Attribute.php';

$strength = new Attribute();

$strength->setId(1);
$strength->setName('Siła');
$strength->setDescription('Naklatanoxa zapytaj');

echo 'Ten atrybut to ';
echo $strength->getName();

?>
