<?php

require './autoload.php';

$nakl = new Sheet();
$nakl->setAppearance('Koks');
$nakl->setArchetype('Press R to win');

$attributes = array();

$strength = new Attribute(1, 'Siła', 'Opis', 12);
$vigor = new Attribute(2, 'Wigor', 'Opis', 12);
$agility = new Attribute(3, 'Zręczność', 'Opis', 4);
$spirit = new Attribute(4, 'Duch', 'Opis', 4);
$smarts = new Attribute(5, 'Spryt', 'Opis', 4);
$attributes[] = $strength;
$attributes[] = $vigor;
$attributes[] = $agility;
$attributes[] = $spirit;
$attributes[] = $smarts;
$nakl->setAttributes($attributes);

$edges[] = new Edge(1, 'Odporny', 'No kurwa odporny' );
$edges[] = new Edge(2, 'Berserker', 'No kurwa' );
$edges[] = new Edge(3, 'Dzikie prącie', 'Bulbasaur, atak dzikim prąciem!' );


$nakl->setEdges($edges);

$hindrances[] = new Hindrance(1, 'Chojrak', 'No kurwa chojrak');
$hindrances[] = new Hindrance(2, 'Grubas', 'No kurwa grubas');
$hindrances[] = new Hindrance(3, 'Tepy chuj', 'Ale panie kapitanie...');


$nakl->setHindrances($hindrances);

$skills[] = new Skill(1,'Wspinaczka' , 6, $strength);
$skills[] = new Skill(2,'Taplanie się w blotku jak swinka' , 6, $agility);
$skills[] = new Skill(3,'Napierdalanka' , 12, $agility);

$nakl->setSkills($skills);

$race[] = new Race(1,'człowiek');
		
$nakl ->setRace($race);
$nakl->setId(1);
$nakl->setName('Naklatanox');
$nakl->setUser(new User(1, 'Adam'));
$nakl->setDescription('No kurwa Naklatanox!!!');


echo '<pre>';
print_r($nakl);
echo '</pre>';
?>
