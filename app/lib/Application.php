<?php

class Application
{

	public function __construct()
	{
		$this->checkDependencies();
		$this->autoLoaders();
		$this->loadConfig();
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
		SimpleConfig::getInstance();
	}

}

?>
