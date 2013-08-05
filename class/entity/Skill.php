<?php

/**
 * Skill
 *
 * @author PHP Summer Workshop
 */
class Skill
{

	private $id;
	private $name;
	private $value;
	private $attribute;

	public function __construct($id, $name, $value, $attribute)
	{
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
		$this->attribute = $attribute;
	}

	public function getAttribute()
	{
		return $this->attribute;
	}

	public function setAttribute($attribute)
	{
		$this->attribute = $attribute;
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
