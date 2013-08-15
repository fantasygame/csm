<?php

/**
 * Description of SheetController
 *
 * @author kuba
 */
class SheetController extends Controller
{

	public function formAction($id = null)
	{
		$config = SimpleConfig::getInstance();
		$db = $config->db;

		$baseAttributeRepository = new BaseAttributeRepository($db);
		$attributes = $baseAttributeRepository->getAll();

		$baseSkillRepository = new BaseSkillRepository($db);
		$skills = $baseSkillRepository->getAll('name');

		$edgeRepository = new EdgeRepository($db);
		$edges = $edgeRepository->getAll();

		$hindranceRepository = new HindranceRepository($db);
		$hindrances = $hindranceRepository->getAll();

		$powerRepository = new PowerRepository($db);
		$powers = $powerRepository->getAll();

		$raceRepository = new RaceRepository($db);
		$races = $raceRepository->getAll();

		$userRepository = new UserRepository($db);
		$users = $userRepository->getAll();

		$sheetRepository = new SheetRepository($db);
		if ($id) {
			$sheet = $sheetRepository->getById($id);
		} else {
			$sheet = null;
		}

		echo $this->getView()->render('form.html.twig', array('attributes' => $attributes, 'skills' => $skills, 'edges' => $edges, 'hindrances' => $hindrances, 'powers' => $powers, 'races' => $races, 'users' => $users, 'sheet' => $sheet));
	}

	public function listAction()
	{
		$config = SimpleConfig::getInstance();
		$db = $config->db;
		
		$sheetRepository = new SheetRepository($db);
		$sheets = $sheetRepository->getAllSimple();
		
		echo $this->getView()->render('list.html.twig', array('sheets' => $sheets));
	}

}

?>
