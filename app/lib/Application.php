<?php

class Application
{

	public function __construct()
	{
		$this->checkDependencies();
		$this->autoLoaders();
		$c = $this->loadConfig();
		$database = new Database($c['db_host'], $c['db_user'], $c['db_password'], $c['db_engine'], $c['db_name']);
		$c['db'] = $database;
	}

	private function checkDependencies()
	{
		if (!in_array('mod_rewrite', apache_get_modules())) {
			throw new Exception('Install mod_rewrite on your server');
		}
	}

	private function autoLoaders()
	{
		require './app/util/AutoloadCsm.php';
		AutoloadCsm::register();

		require './vendors/sensio/Twig/Autoloader.php';
		Twig_Autoloader::register();
	}

	private function loadConfig()
	{
		SimpleConfig::setFile('./app/config/config.php');
		return SimpleConfig::getInstance();
	}

}

?>
