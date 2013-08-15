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
		echo $this->getView()->render('home.html.twig');
	}

}

?>
