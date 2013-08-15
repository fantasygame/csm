<?php

/**
 * Attribute
 *
 * @author PHP Summer Workshop
 */
class BaseAttribute
{

	private $id;
	private $name;
	private $description;
	
	public function __construct($id, $name, $description)
	{
		$this->id = $id;
		$this->description = $description;
		$this->name = $name;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}
	
}

?>
