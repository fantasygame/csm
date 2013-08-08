<?php

/**
 * Skill
 *
 * @author PHP Summer Workshop
 */
class BaseSkill
{

	private $id;
	private $name;
	private $attribute;

	public function __construct($id, $name, BaseAttribute $attribute)
	{
		$this->id = $id;
		$this->name = $name;
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

}

?>
