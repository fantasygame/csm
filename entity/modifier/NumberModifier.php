<?php

/**
 * Description of NumberModidier
 *
 * @author kuba
 */
abstract class NumberModifier extends Modifier
{

	private $modifier;

	public function __construct($id, $modifier)
	{
		parent::__construct($id);
		$this->modifier = $modifier;
	}

	public function getModifier()
	{
		return $this->modifier;
	}

}

?>
