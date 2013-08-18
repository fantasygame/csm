<?php

/**
 * Description of SheetController
 *
 * @author kuba
 */
class SheetController extends Controller
{

	public function showAction($id = null)
	{

		$baseAttributeRepository = new BaseAttributeRepository();
		$attributes = $baseAttributeRepository->getAll();

		$baseSkillRepository = new BaseSkillRepository();
		$skills = $baseSkillRepository->getAll('name');

		$edgeRepository = new EdgeRepository();
		$edges = $edgeRepository->getAll();

		$hindranceRepository = new HindranceRepository();
		$hindrances = $hindranceRepository->getAll();

		$powerRepository = new PowerRepository();
		$powers = $powerRepository->getAll();

		$raceRepository = new RaceRepository();
		$races = $raceRepository->getAll();

		$userRepository = new UserRepository();
		$users = $userRepository->getAll();

		$sheetRepository = new SheetRepository();
		if ($id) {
			$sheet = $sheetRepository->getById($id);
		} else {
			$sheet = null;
		}

		echo $this->getView()->render('form.html.twig', array('attributes' => $attributes, 'skills' => $skills, 'edges' => $edges, 'hindrances' => $hindrances, 'powers' => $powers, 'races' => $races, 'users' => $users, 'sheet' => $sheet));
	}
	

	public function formAction()
	{
		$config = SimpleConfig::getInstance();
		$request = $config->request;

		echo '<pre>';
		print_r($request->getPost());
		echo '</pre>';
		exit();
	}

	public function listAction()
	{

		$sheetRepository = new SheetRepository();
		$sheets = $sheetRepository->getAllSimple();

		echo $this->getView()->render('list.html.twig', array('sheets' => $sheets));
	}

	public function removeAction($id)
	{
		$sheetRepository = new SheetRepository();
		$sheetRepository->remove($id);
	}

}

?>
