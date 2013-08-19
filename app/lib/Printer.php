<?php

/**
 * Description of Printer
 *
 * @author kuba
 */
class Printer
{
	private $content;
	
	public function __construct($content)
	{
		$this->content = $content;
	}
	
	public function go()
	{
		echo $this->content;
		echo '<script type="text/javascript">window.print();</script>';
	}
	
}

?>
