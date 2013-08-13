<?php

/**
 * Sheet
 *
 * @author PHP Summer Workshop
 */
class Sheet
{

	private $id;
	private $user;
	private $name;
	private $race;
	private $appearance;
	private $archetype;
	private $description;
	private $exp;
	private $edges;
	private $hindrances;
	private $skills;
	private $attributes;
	private $powers;
	
		public function getAttribute($id)
	{
		for ($i = 0; $i < count($this->attributes); $i++) {
			if ($this->attributes[$i]->getId() == $id) {
				return $this->attributes[$i];
			}
		}
		return false;
	}

	public function getSkill($id)
	{
		for ($i = 0; $i < count($this->skills); $i++) {
			if ($this->skills[$i]->getId() == $id) {
				return $this->skills[$i];
			}
		}
		return false;
	}

	public function getEdge($id)
	{
		for ($i = 0; $i < count($this->edges); $i++) {
			if ($this->edges[$i]->getId() == $id) {
				return $this->edges[$i];
			}
		}
		return false;
	}

	public function getHindrance($id)
	{
		for ($i = 0; $i < count($this->hindrances); $i++) {
			if ($this->hindrances[$i]->getId() == $id) {
				return $this->hindrances[$i];
			}
		}
		return false;
	}

	public function getPower($id)
	{
		for ($i = 0; $i < count($this->powers); $i++) {
			if ($this->powers[$i]->getId() == $id) {
				return $this->powers[$i];
			}
		}
		return false;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function setUser($user)
	{
		$this->user = $user;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getRace()
	{
		return $this->race;
	}

	public function setRace($race)
	{
		$this->race = $race;
	}

	public function getAppearance()
	{
		return $this->appearance;
	}

	public function setAppearance($appearance)
	{
		$this->appearance = $appearance;
	}

	public function getArchetype()
	{
		return $this->archetype;
	}

	public function setArchetype($archetype)
	{
		$this->archetype = $archetype;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function getExp()
	{
		return $this->exp;
	}

	public function setExp($exp)
	{
		$this->exp = $exp;
	}

	public function getEdges()
	{
		return $this->edges;
	}

	public function setEdges($edges)
	{
		$this->edges = $edges;
	}

	public function getHindrances()
	{
		return $this->hindrances;
	}

	public function setHindrances($hindrances)
	{
		$this->hindrances = $hindrances;
	}

	public function getSkills()
	{
		return $this->skills;
	}

	public function setSkills($skills)
	{
		$this->skills = $skills;
	}

	public function getAttributes()
	{
		return $this->attributes;
	}

	public function setAttributes($attributes)
	{
		$this->attributes = $attributes;
	}

	public function getPowers()
	{
		return $this->powers;
	}

	public function setPowers($powers)
	{
		$this->powers = $powers;
	}

}

?>
