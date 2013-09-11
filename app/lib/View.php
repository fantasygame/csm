<?php

/**
 * Description of View
 *
 * @author kuba
 */
class View
{

	private $engine;

	public function __construct()
	{
		$config = SimpleConfig::getInstance();
		$loader = new Twig_Loader_Filesystem($config['view_dir']);
		$this->engine = new Twig_Environment($loader);
	}

	public function render($template, $variables = array())
	{
		return $this->engine->render($template, $variables);
	}

}

?>
