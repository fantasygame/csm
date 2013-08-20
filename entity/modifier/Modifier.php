<?php

/**
 * Description of Modifier
 *
 * @author kuba
 */
abstract class Modifier
{

	private $id;

	public function __construct($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

}

?>
