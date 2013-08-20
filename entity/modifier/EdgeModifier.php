<?php

/**
 * Description of EdgeModifier
 *
 * @author kuba
 */
class EdgeModifier extends Modifier
{

	private $edge;

	public function __construct($id, Edge $edge)
	{
		parent::__construct($id);
		$this->edge = $edge;
	}

	public function getEdge()
	{
		return $this->edge;
	}

}

?>
