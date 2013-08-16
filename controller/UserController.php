<?php

/**
 * Description of UserController
 *
 * @author kuba
 */
class UserController extends Controller
{

	public function helloAction($name = '')
	{
		echo "Hello $name";
	}

	public function byeAction()
	{
		echo 'Bye';
	}

}

?>
