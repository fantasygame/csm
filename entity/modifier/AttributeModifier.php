<?php

/**
 * Description of AttributeModifier
 *
 * @author kuba
 */
class AttributeModifier extends NumberModifier
{

	private $dice;
	private $starting;
	private $attributeId;

	public function __construct($id, $modifier, $attributeId, $dice, $starting)
	{
		parent::__construct($id, $modifier);
		$this->attributeId = $attributeId;
		$this->dice = $dice;
		$this->starting = $starting;
	}

	public function getDice()
	{
		return $this->dice;
	}

	public function getStarting()
	{
		return $this->starting;
	}

	public function getAttributeId()
	{
		return $this->attributeId;
	}

}

?>
