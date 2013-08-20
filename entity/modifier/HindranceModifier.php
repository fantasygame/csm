<?php

/**
 * Description of HindranceModifier
 *
 * @author kuba
 */
class HindranceModifier extends Modifier
{

	private $hindrance;

	public function __construct($id, Hindrance $hindrance)
	{
		parent::__construct($id);
		$this->hindrance = $hindrance;
	}

	public function getHindrance()
	{
		return $this->hindrance;
	}

}

?>
