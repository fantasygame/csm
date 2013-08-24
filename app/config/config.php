<?php

// copy this file to config.php (gitignored) and set your data

$config = array();

// application directories
$config['controller_dir'] = 'controller';
$config['model_dir'] = 'model';
$config['view_dir'] = 'view';
$config['vendor_dir'] = 'vendors';

// database configuration
$config['db_host'] = '193.17.184.187';
$config['db_user'] = 'phpsw';
$config['db_password'] = 'phpsummer1';
$config['db_engine'] = 'mysql';
$config['db_name'] = 'csm';

// environment
$config['environment'] = 'development'; // development/production

// routing
$config['routing_file'] = './app/config/routing.php';

return $config;

?>