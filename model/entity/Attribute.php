<?php

/**
 * Description of SheetAttribute
 *
 * @author kuba
 */
class Attribute extends BaseAttribute
{

	private $value;

	public function __construct($id, $name, $description, $value)
	{
		parent::__construct($id, $name, $description);
		$this->value = $value;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}

}

?>
