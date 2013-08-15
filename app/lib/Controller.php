<?php

/**
 * Description of Controller
 *
 * @author kuba
 */
class Controller
{

	private $view;

	public function __construct()
	{
		$this->view = new View();
	}

	public function getView()
	{
		return $this->view;
	}

}

?>
