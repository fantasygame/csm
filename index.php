<?php

require './autoload.php';

$nakl = new Sheet();
$nakl->setAppearance('Koks');
$nakl->setArchetype('Press R to win');

$attributes = array();

$attributes[] = new Attribute(1, 'Siła', 'Opis', 12);
$attributes[] = new Attribute(2, 'Wigor', 'Opis', 12);
$attributes[] = new Attribute(3, 'Zręczność', 'Opis', 4);
$attributes[] = new Attribute(4, 'Duch', 'Opis', 4);
$attributes[] = new Attribute(5, 'Spryt', 'Opis', 4);

$nakl->setAttributes($attributes);

echo '<pre>';
print_r($nakl);
echo '</pre>';

?>
