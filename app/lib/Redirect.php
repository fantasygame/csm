<?php

/**
 * Description of Redirect
 *
 * @author kuba
 */
class Redirect
{

	public function __construct($path)
	{
		$this->path = $path;
	}

	public function go()
	{
		ob_start();
		header("Location: $this->path");
		ob_end_flush();
	}

}

?>
