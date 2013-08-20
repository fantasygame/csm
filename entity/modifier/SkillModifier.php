<?php

/**
 * Description of SkillModifier
 *
 * @author kuba
 */
class SkillModifier extends NumberModifier
{

	private $dice;
	private $skillId;

	public function __construct($id, $modifier, $skillId, $dice)
	{
		parent::__construct($id, $modifier);
		$this->dice = $dice;
		$this->skillId = $skillId;
	}

	public function getDice()
	{
		return $this->dice;
	}

	public function getSkillId()
	{
		return $this->skillId;
	}

}

?>
