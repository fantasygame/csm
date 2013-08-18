<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of formread
 *
 * @author Dawid
 */
class SheetForm extends Form
{

	public function read()
	{
		$config = SimpleConfig::getInstance();
		$post = $config->request->getPost();
		$sheet = new Sheet();

		$sheet->setId($post['id']);

		$name = $post['name'];
		$sheet->setName($name);

		$raceRepository = new RaceRepository();
		$race = $raceRepository->getById($post['race']);
		$sheet->setRace($race);

		$appearance = $post['appearance'];
		$sheet->setAppearance($appearance);

		$archetype = $post['archetype'];
		$sheet->setArchetype($archetype);

		$description = $post['description'];
		$sheet->setDescription($description);

		$edges = array();
		$edgeRepository = new EdgeRepository();
		if (isset($post['edges'])) {
			foreach ($post['edges'] as $value) {
				$edges[] = $edgeRepository->getById($value);
			}
		}
		$sheet->setEdges($edges);

		$hindrances = array();
		$hindranceRepository = new HindranceRepository();
		if (isset($post['hindrances'])) {
			foreach ($post['hindrances'] as $value) {
				$hindrances[] = $hindranceRepository->getById($value);
			}
		}
		$sheet->setHindrances($hindrances);


		$powers = array();
		$powerRepository = new PowerRepository();
		if (isset($post['powers'])) {
			foreach ($post['powers'] as $value) {
				$powers[] = $powerRepository->getById($value);
			}
		}
		$sheet->setPowers($powers);

		$attributes = array();
		$attributeRepository = new AttributeRepository();
		if (isset($post['attributes'])) {
			foreach ($post['attributes'] as $key => $value) {
				$attributes[] = $attributeRepository->getById($key, $value);
			}
		}
		$sheet->setAttributes($attributes);

		$skills = array();
		$skillRepository = new SkillRepository();
		if (isset($post['skills'])) {
			foreach ($post['skills'] as $key => $value) {
				if ($value == 0) {
					continue; // skip untrained
				}
				$skills[] = $skillRepository->getById($key, $value, $sheet);
			}
		}
		$sheet->setSkills($skills);

		$userRepository = new UserRepository();
		$user = $userRepository->getById($post['user']);
		$sheet->setUser($user);

		$exp = $post['exp'];
		$sheet->setExp($exp);

		return $sheet;
	}

}

?>