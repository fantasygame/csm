<?php

/**
 * Description of LoginSystem
 *
 * @author kuba
 */
class LoginSystem
{

	public function logged()
	{
		if (isset($_SESSION['user_id']) && isset($_SESSION['logged_in'])) {
			if ($_SESSION['logged_in']) {
				$userRepository = new UserRepository();
				$loggedUser = $userRepository->getById($_SESSION['user_id']);
				$config = SimpleConfig::getInstance();
				$config['logged_user'] = $loggedUser;
				return true;
			}
		}
		return false;
	}

	public function login($login, $password)
	{
		require_once './vendors/openwall/phpass-0.3/PasswordHash.php';
		$userRepository = new UserRepository();
		$hash = $userRepository->getPassword($login);
		$hasher = new PasswordHash(8, false);
		if ($hasher->CheckPassword($password, $hash)) {
			$loggedUser = $userRepository->getByLogin($login);
			$config = SimpleConfig::getInstance();
			$config['logged_user'] = $loggedUser;
			$_SESSION['user_id'] = $loggedUser->getId();
			$_SESSION['logged_in'] = true;
		}
	}

	public function changePassword($user, $password, $newPassword)
	{
		require_once './vendors/openwall/phpass-0.3/PasswordHash.php';
		$userRepository = new UserRepository();
		$hash = $userRepository->getPassword($user->getLogin());
		$hasher = new PasswordHash(8, false);
		if ($hasher->CheckPassword($password, $hash)) {
			$newPassword = $this->hash($newPassword);
			$userRepository->updatePassword($user, $newPassword);
		} else {
			throw new Exception('Password incorrect');
		}
	}

	public function logout()
	{
		unset($_SESSION['logged_in']);
		unset($_SESSION['user_id']);
	}

	public function register(User $user, $password)
	{
		$password = $this->hash($password);
		$userRepository = new UserRepository();
		$userRepository->add($user, $password);
	}

	private function hash($password)
	{
		require_once './vendors/openwall/phpass-0.3/PasswordHash.php';
		$hasher = new PasswordHash(8, false);
		$password = $hasher->HashPassword($password);
		return $password;
	}

}

?>
