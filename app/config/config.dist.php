<?php

// copy this file to config.php (gitignored) and set your data

$config = array();

// PHPBB3
$config['phpbb3']['root_path'] = 'path';

// application directories
$config['controller_dir'] = 'controller';
$config['model_dir'] = 'model';
$config['view_dir'] = 'view';
$config['vendor_dir'] = 'vendors';

// database configuration
$config['db_host'] = 'localhost';
$config['db_user'] = 'user';
$config['db_password'] = 'password';
$config['db_engine'] = 'mysql';
$config['db_name'] = 'csm';

// smtp configuration
$config['smtp_secure'] = 'ssl';
$config['smtp_port'] = '465';
$config['smtp_host'] = 'localhost';
$config['smtp_password'] = 'password';

// environment
$config['environment'] = 'development'; // development/production

// routing
$config['routing_file'] = './app/config/routing.php';

return $config;

?>