<?php

// autoload unloaded Class
require './class/util/AutoloadCsm.php';
require './vendors/sensio/Twig/Autoloader.php';
Twig_Autoloader::register();
AutoloadCsm::register();

$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);

// connect to database
$db = new Database('localhost', 'root', 'okurwakacper', 'mysql', 'csm');

$baseAttributeRepository = new BaseAttributeRepository($db);
$attributes = $baseAttributeRepository->getAll();

$baseSkillRepository = new BaseSkillRepository($db);
$skills = $baseSkillRepository->getAll('name');

$edgeRepository = new EdgeRepository($db);
$edges = $edgeRepository->getAll();

$hindranceRepository = new HindranceRepository($db);
$hindrances = $hindranceRepository->getAll();

$powerRepository = new PowerRepository($db);
$powers = $powerRepository->getAll();

echo $twig->render('form.html.twig', array('attributes' => $attributes, 'skills'=> $skills, 'edges' => $edges, 'hindrances' => $hindrances, 'powers' => $powers));
?>
