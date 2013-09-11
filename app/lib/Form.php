<?php

/**
 * Description of Form
 *
 * @author kuba
 */
abstract class Form
{

	abstract public function read();

	protected function getPost()
	{
		$config = SimpleConfig::getInstance();
		$request = $config->request;
		return $request->getPost();
	}

	protected function checkField($field, $preventEmpty = true)
	{
		$post = $this->getPost();
		if (!isset($post[$field])) {
			throw new Exception($field . ' not specified');
		}
		if ($preventEmpty) {
			if (empty($post[$field])) {
				throw new Exception($field . ' is empty');
			}
		}
	}

}

?>
