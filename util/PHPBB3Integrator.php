<?php

/**
 * Description of PHPBB3Integrator
 *
 * @author kuba
 */
class PHPBB3Integrator
{

	/**
	 * Not funckin' working
	 */
	public function getUser()
	{

		$config = SimpleConfig::getInstance();
		$url = $config['phpbb3']['root_path'] . '/logged.php';
		$context = stream_context_create();
		$info = file_get_contents($url, false, $context);
		$info = explode(';', $info);
		if ($info[1] == 'Anonymous') {
			return false;
		} else {
			return new User($info[0], $info[1]);
		}
	}

	/**
	 * Not funckin' working
	 */
	private function emulateBrowser($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
		//curl_setopt($ch, CURLOPT_PORT,443);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

}
