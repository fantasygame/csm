<?php

/**
 * Description of Repository
 *
 * @author kuba
 */
class Repository
{
	/* @var $db Database */

	protected $db;

	public function __construct()
	{
		$config = SimpleConfig::getInstance();
		$this->db = $config->db;
	}

}

?>
