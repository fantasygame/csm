<?php

/**
 * Description of DefaultController
 *
 * @author kuba
 */
class DefaultController extends Controller
{

	public function indexAction()
	{
		echo $this->view->render('home.html.twig');
	}

}

?>
