<?php

/**
 * Race
 *
 * @author PHP Summer Workshop
 */
class Race
{

	private $id;
	private $name;
	private $modifiers;

	public function __construct($id, $name)
	{
		$this->id = $id;
		$this->name = $name;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getModifiers()
	{
		return $this->modifiers;
	}

	public function setModifiers($modifiers)
	{
		$this->modifiers = $modifiers;
	}

}

?>
