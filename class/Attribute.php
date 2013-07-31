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

	public function gejuch($name)
	{
		return "$name jest gejem\n";
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
