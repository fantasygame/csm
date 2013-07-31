<?php

/**
 * Description of Skill
 *
 * @author kuba
 */
class Skill
{

	private $id;
	private $name;
	private $value;

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
