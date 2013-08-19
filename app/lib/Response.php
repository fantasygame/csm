<?php

/**
 * Description of Response
 *
 * @author kuba
 */
class Response
{

	private $content;

	public function __construct($content)
	{
		$this->content = $content;
	}

	public function resolve()
	{
		if (is_string($this->content)) {
			echo $this->content;
		} else if (get_class($this->content) == 'Redirect') {
			$this->content->go();
		} else if (get_class($this->content) == 'Printer') {
			$this->content->go();
		} else {
			throw new Exception('Unknown response type');
		}
	}

}

?>
