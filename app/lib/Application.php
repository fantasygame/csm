<?php

class Application
{

	public function __construct()
	{
		try {
			$this->checkDependencies();
		} catch (Exception $e) {
			throw new Exception('Missing Character Sheet Manager dependency:<br />' . $e->getMessage());
		}
		$this->autoLoaders();
		$c = $this->loadConfig();
		$database = new Database($c['db_host'], $c['db_user'], $c['db_password'], $c['db_engine'], $c['db_name']);
		$c['db'] = $database;
	}

	private function checkDependencies()
	{
		if (!is_file('vendors/sensio/Twig/Autoloader.php')) {
			throw new Exception('Install <a target="_blank" href="https://github.com/jkubacki/csm/wiki/Twig">Twig</a>');
		}
		if (!is_file('app/config/config.php')) {
			throw new Exception('Copy config.dist.php to config.php and personalize content of config.php');
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
