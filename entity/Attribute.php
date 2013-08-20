<?php

/**
 * Description of SheetAttribute
 *
 * @author kuba
 */
class Attribute extends BaseAttribute
{

	private $value;
	private $baseValue;
	private $diceModifier = 0;
	private $modifier = 0;
	private $starting = 4;

	public function __construct($id, $name, $description, $value)
	{
		parent::__construct($id, $name, $description);
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

	public function getBaseValue()
	{
		return $this->baseValue;
	}

	public function setBaseValue($baseValue)
	{
		$this->baseValue = $baseValue;
	}

	public function getStarting()
	{
		return $this->starting;
	}

	public function setStarting($starting)
	{
		$this->starting = $starting;
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
