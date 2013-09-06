<?php

/**
 * Description of PHPBB3Integrator
 *
 * @author kuba
 */
class PHPBB3Integrator
{

	public function getUserId()
	{
		$conf = SimpleConfig::getInstance();
		$user = null;
		$auth = null;

		define('IN_PHPBB', true);
		define('ROOT_PATH', $conf['phpbb3']['root_path']);

		if (!defined('IN_PHPBB') || !defined('ROOT_PATH')) {
			throw new Exception('PHPBB3 error: IN_PHPBB or ROOT_PATH not defined');
		}
		
		global $phpbb_root_path, $phpEx, $user, $db, $config, $cache, $template, $auth, $phpbb_hook;
		$phpEx = "php";
		$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : ROOT_PATH . '/';
		include($phpbb_root_path . 'common.' . $phpEx);
		$user->session_begin();
		$auth->acl($user->data);
		$user->setup();

		$userId = $user->data['user_id'];
		if ($userId == ANONYMOUS) {
			return 0;
		} else {
			return $userId;
		}
	}

}

?>
