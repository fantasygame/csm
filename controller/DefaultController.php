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
		$content = $this->getView()->render('home.html.twig');
		return new Response($content);
	}

}

?>
