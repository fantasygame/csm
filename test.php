<?php

// autoload unloaded Class
require './class/util/AutoloadCsm.php';
require './vendors/sensio/Twig/Autoloader.php';
Twig_Autoloader::register();
AutoloadCsm::register();

// configuration (singleton)
SimpleConfig::setFile('./config/config.php');
$config = SimpleConfig::getInstance();

// twig loader
$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);

// connect to database
$db = new Database($config['db_host'], $config['db_user'], $config['db_password'], $config['db_engine'], $config['db_name']);

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

$raceRepository = new RaceRepository($db);
$races = $raceRepository->getAll();

$userRepository = new UserRepository($db);
$users = $userRepository->getAll();

$sheetRepository = new SheetRepository($db);
$sheet = $sheetRepository->getById(1);

//$sheetRepository->persist($sheet);

//$sheet = null;

echo $twig->render('form.html.twig', array('attributes' => $attributes, 'skills'=> $skills, 'edges' => $edges, 'hindrances' => $hindrances, 'powers' => $powers, 'races' => $races, 'users' => $users, 'sheet' => $sheet));
?>
