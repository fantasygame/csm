<?php

/**
 * Description of Skill
 *
 * @author kuba
 */
class Skill extends BaseSkill
{

	private $value;
	private $baseValue;
	private $add = 0;
	private $diceModifier = 0;
	private $modifier = 0;

	public function __construct($id, $name, $value, $attribute)
	{
		parent::__construct($id, $name, $attribute);
		$this->value = $value;
		$this->baseValue = $value;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}

	public function getAdd()
	{
		return $this->add;
	}

	public function setAdd($add)
	{
		$this->add = $add;
	}

	public function getDiceModifier()
	{
		return $this->diceModifier;
	}

	public function setDiceModifier($diceModifier)
	{
		$this->diceModifier = $diceModifier;
	}

	public function getModifier()
	{
		return $this->modifier;
	}

	public function setModifier($modifier)
	{
		$this->modifier = $modifier;
	}

}

?>
