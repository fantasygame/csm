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

		$content = $this->getView()->render('form.html.twig', array('attributes' => $attributes, 'skills' => $skills, 'edges' => $edges, 'hindrances' => $hindrances, 'powers' => $powers, 'races' => $races, 'users' => $users, 'sheet' => $sheet));
		return new Response($content);
	}

	public function formAction()
	{

		$form = new SheetForm();
		$sheet = $form->read();

		$sheetRepository = new SheetRepository();
		if ($sheet->getId()) {
			$sheetRepository->update($sheet);
		} else {
			$sheetRepository->insert($sheet);
		}
		return new Response(new Redirect('/csm/sheet/list/'));
	}

	public function printAction($id)
	{
		$sheetRepository = new SheetRepository();
		$sheet = $sheetRepository->getById($id);
		$skillRepository = new BaseSkillRepository;
		$baseSkills = $skillRepository->getAll('name');

		$skills = $sheet->getSkills();

		for ($i = 0; $i < count($baseSkills); $i++) {
			$baseSkill = $baseSkills[$i];
			for ($j = 0; $j < count($skills); $j++) {
				$skill = $skills[$j];
				if ($baseSkill->getId() == $skill->getId()) {
					$baseSkills[$i] = $skill;
				}
			}
		}

		$sheet->setSkills($baseSkills);
		
		$content = $this->getView()->render('print.html.twig', array('sheet' => $sheet));
		return new Response($content);
	}

	public function listAction()
	{

		$sheetRepository = new SheetRepository();
		$sheets = $sheetRepository->getAllSimple();

		$content = $this->getView()->render('list.html.twig', array('sheets' => $sheets));
		return new Response($content);
	}

	public function removeAction($id)
	{
		$sheetRepository = new SheetRepository();
		$sheetRepository->remove($id);
		return new Response(new Redirect('/csm/sheet/list'));
	}

	public function simpleAction($id)
	{
		$rep = new SheetRepository();
		$sheet = $rep->getById($id);
		$content = $this->getView()->render('simple.html.twig', array("sheet" => $sheet));
		return new Response($content);
	}

}

?>
