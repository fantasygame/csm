<?php

/**
 * Description of LoginSystem
 *
 * @author kuba
 */
class LoginSystem
{

	public function login($id)
	{
		$userRepository = new UserRepository();
		$loggedUser = $userRepository->getById($id);
		$config = SimpleConfig::getInstance();
		$config['logged_user'] = $loggedUser;
	}

}

?>
