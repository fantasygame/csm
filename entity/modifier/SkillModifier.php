<?php

/**
 * Description of SkillModifier
 *
 * @author kuba
 */
class SkillModifier extends NumberModifier
{

	private $dice;

	public function __construct($id, $modifier, $dice)
	{
		parent::__construct($id, $modifier);
		$this->dice = $dice;
	}

	public function getDice()
	{
		return $this->dice;
	}

}

?>
