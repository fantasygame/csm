<?php

/**
 * Edge
 *
 * @author PHP Summer Workshop
 */
class Edge
{

	private $id;
	private $name;
	private $description;
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

	public function getDescription()
	{
		return $this->description;
	}

	public function getModifiers()
	{
		return $this->modifiers;
	}

	public function setModifiers($modifiers)
	{
		$this->modifiers = $modifiers;
	}

	public function getModifier($id)
	{
		for ($i = 0; $i < count($this->modifiers); $i++) {
			if ($this->modifiers[$i]->getid() == $id) {
				return $this->modifiers[$i];
			}
		}
		return false;
	}

}

?>
