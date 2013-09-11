<?php

/**
 * Description of Controller
 *
 * @author kuba
 */
class Controller
{

	private $view;

	public function __construct()
	{
		$this->view = new View();
	}

	protected function secureAdmin()
	{
		$this->secure(true);
	}

	protected function secure($admin = false)
	{
		$loginSystem = new LoginSystem();
		if (!$loginSystem->logged()) {
			header('Location: /workspace/login');
			exit();
		}
		if ($admin) {
			if (!$this->getUser()->getAdmin()) {
				header('Location: /workspace/');
				exit();
			}
		}
	}

	public function render($template, $variables = array())
	{
		$variables['loggedUser'] = $this->getUser();
		return $this->getView()->render($template, $variables);
	}

	public function getView()
	{
		return $this->view;
	}

	public function getUser()
	{
		$config = SimpleConfig::getInstance();
		if (isset($config['logged_user'])) {
			return $config['logged_user'];
		} else {
			return null;
		}
	}

}

?>
