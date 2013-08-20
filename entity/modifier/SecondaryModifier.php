<?php

/**
 * Description of SecondaryModifier
 *
 * @author kuba
 */
class SecondaryModifier extends NumberModifier
{

	private $secondary;
	private $dice;

	public function __construct($id, $modifier, $secondary, $dice = false)
	{
		parent::__construct($id, $modifier);
		$this->secondary = $secondary;
		$this->dice = $dice;
	}

	public function getSecondary()
	{
		return $this->secondary;
	}

	public function getDice()
	{
		return $this->dice;
	}

}

?>
