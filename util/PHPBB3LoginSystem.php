<?php

/**
 * Description of PHPBB3LoginSystem
 *
 * @author kuba
 */
class PHPBB3LoginSystem extends LoginSystem
{

	public function login($login = null, $password = null)
	{
		$config = SimpleConfig::getInstance();

		$integrator = new PHPBB3Integrator();
		$user = $integrator->getUser();

		if ($user) {
			$config['logged_user'] = $user;
		}
	}

}

?>
