<?php

/**
 * Description of Attribute
 *
 * @author kuba
 */
class Attribute
{

	private $id;
	private $name;
	private $description;
	private $value;
	
	public function __construct($id, $name, $description, $value)
	{
		$this->id = $id;
		$this->description = $description;
		$this->name = $name;
		$this->value = $value;
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
	
	public function getValue()
	{
		return $this->value;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}

}

?>
