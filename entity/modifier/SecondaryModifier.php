<?php

/**
 * Description of SecondaryModifier
 *
 * @author kuba
 */
class SecondaryModifier extends NumberModifier
{

	private $secondary;

	public function __construct($id, $modifier, $secondary)
	{
		parent::__construct($id, $modifier);
		$this->secondary = $secondary;
	}

	public function getSecondary()
	{
		return $this->secondary;
	}

}

?>
