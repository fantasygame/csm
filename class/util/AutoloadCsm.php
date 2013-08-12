<?php

class AutoloadCsm
{

	/**
	 * Registers Twig_Autoloader as an SPL autoloader.
	 */
	public static function register()
	{
		ini_set('unserialize_callback_func', 'spl_autoload_call');
		spl_autoload_register(array(new self, 'csmAutoload'));
	}

	/**
	 * Handles autoloading of classes.
	 *
	 * @param string $class A class name.
	 */
	public static function csmAutoload($class_name)
	{
		$directories = array(
			'./class/',
			'./class/entity/',
			'./class/repository/',
			'./class/lib/',
			'./class/util/',
			'./class/forms/'
		);
		foreach ($directories as $directory) {
			if (file_exists($directory . $class_name . '.php')) {
				require_once($directory . $class_name . '.php');
				return;
			}
		}
	}
}

?>
