<?php

/**
 * Description of Request
 *
 * @author kuba
 */
class Request
{

	private $url;
	private $urlString;

	public function __construct()
	{
		$this->setUrl();
	}

	private function setUrl()
	{
		if (!isset($_GET['url'])) {
			$this->url = array('default');
			return true;
		} else {
			$url = $_GET['url'];
		}
		$url = rtrim($url, '/');
		$this->urlString = $url;
		$url = explode('/', $url);
		$this->url = $url;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getUrlString()
	{
		return $this->urlString;
	}

}

?>
