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
	private $parry = 0;
	private $toughness = 0;
	private $charisma = 0;
	private $pace = 6;
	private $powerPoints = 0;
	private $powerSlots = 0;
	private $runDie = 6;
	private $startingAttributePoints = 5;
	private $startingSkillPoints = 15;
	private $bennies = 3;
	private $initiativeCards = 1;
	private $initiativeMinimum = 2;
	private $startingMoney = 500;

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

	public function addAttribute(Attribute $attribute)
	{
		$this->attributes[] = $attribute;
	}

	public function addEdge(Edge $edge)
	{
		$this->edges[] = $edge;
	}

	public function addHindrance(Hindrance $hindrance)
	{
		$this->hindrances[] = $hindrance;
	}

	public function addPower(Power $power)
	{
		$this->powers[] = $power;
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

	public function getEdges($type = '')
	{
		if (empty($type)) {
			return $this->edges;
		} else {
			$edges = array();
			for ($i = 0; $i < count($this->edges); $i++) {
				$edge = $this->edges[$i];
				if ($edge->getType() == $type) {
					$edges[] = $edge;
				}
			}
			return $edges;
		}
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

	public function getParry()
	{
		return $this->parry;
	}

	public function setParry($parry)
	{
		$this->parry = $parry;
	}

	public function getToughness()
	{
		return $this->toughness;
	}

	public function setToughness($toughness)
	{
		$this->toughness = $toughness;
	}

	public function getCharisma()
	{
		return $this->charisma;
	}

	public function setCharisma($charisma)
	{
		$this->charisma = $charisma;
	}

	public function getPace()
	{
		return $this->pace;
	}

	public function setPace($pace)
	{
		$this->pace = $pace;
	}

	public function getPowerPoints()
	{
		return $this->powerPoints;
	}

	public function setPowerPoints($powerPoints)
	{
		$this->powerPoints = $powerPoints;
	}

	public function getPowerSlots()
	{
		return $this->powerSlots;
	}

	public function setPowerSlots($powerSlots)
	{
		$this->powerSlots = $powerSlots;
	}

	public function getRunDie()
	{
		return $this->runDie;
	}

	public function setRunDie($runDie)
	{
		$this->runDie = $runDie;
	}

	public function getStartingAttributePoints()
	{
		return $this->startingAttributePoints;
	}

	public function setStartingAttributePoints($startingAttributePoints)
	{
		$this->startingAttributePoints = $startingAttributePoints;
	}

	public function getStartingSkillPoints()
	{
		return $this->startingSkillPoints;
	}

	public function setStartingSkillPoints($startingSkillPoints)
	{
		$this->startingSkillPoints = $startingSkillPoints;
	}

	public function getBennies()
	{
		return $this->bennies;
	}

	public function setBennies($bennies)
	{
		$this->bennies = $bennies;
	}

	public function getInitiativeCards()
	{
		return $this->initiativeCards;
	}

	public function setInitiativeCards($initiativeCards)
	{
		$this->initiativeCards = $initiativeCards;
	}

	public function getInitiativeMinimum()
	{
		return $this->initiativeMinimum;
	}

	public function setInitiativeMinimum($initiativeMinimum)
	{
		$this->initiativeMinimum = $initiativeMinimum;
	}

	public function getStartingMoney()
	{
		return $this->startingMoney;
	}

	public function setStartingMoney($startingMoney)
	{
		$this->startingMoney = $startingMoney;
	}

}

?>
