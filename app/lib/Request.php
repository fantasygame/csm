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
	private $post;
	private $cookie;

	public function __construct()
	{
		$this->setUrl();
		$this->post = $_POST;
		$this->cookie = $_COOKIE;
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
		unset($_GET['url']);
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getUrlString()
	{
		return $this->urlString;
	}

	public function getGet()
	{
		return $this->get;
	}

	public function getPost()
	{
		return $this->post;
	}

	public function getCookie()
	{
		return $this->cookie;
	}

}

?>
