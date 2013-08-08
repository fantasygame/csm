<?php

/**
 * Description of Skill
 *
 * @author kuba
 */
class Skill extends BaseSkill
{

	private $value;

	public function __construct($id, $name, $value, $attribute)
	{
		parent::__construct($id, $name, $attribute);
		$this->value = $value;
	}

}

?>
