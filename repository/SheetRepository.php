<?php

/**
 * Database methods for Sheet
 *
 * @author PHP Summer Workshop
 */
class SheetRepository
{
	/* @var $db Database */

	private $db;

	public function __construct(Database $db)
	{
		$this->db = $db;
	}

	/**
	 * Persists Sheet in database
	 * @param Sheet $sheet
	 */
	public function persist(Sheet $sheet, $update = true)
	{

		if ($update) {
			if (empty($sheet->getId())) {
				throw new Exception('Cant update Sheet with empty id');
			}
			$query = "
			UPDATE `sheet`
			SET
			`user_id` = :user_id,
			`name` = :name,
			`race_id` = :race_id,
			`appearance` = :appearance,
			`archetype` = :archetype,
			`description` = :description,
			`exp` = :exp
			WHERE `id` = :id
			";
		} else {
			$query = "
			INSERT INTO `sheet` (
				`id` ,
				`user_id` ,
				`name` ,
				`race_id` ,
				`appearance` ,
				`archetype` ,
				`description` ,
				`exp`
			)
			VALUES (
				NULL ,
				:user_id ,
				:name ,
				:race_id ,
				:appearance ,
				:archetype ,
				:description ,
				:exp
			);
			";
		}

		$this->db->beginTransaction();

		$handle = $this->db->prepare($query);
		$handle->bindParam(':user_id', $sheet->getUser()->getId(), Database::PARAM_INT);
		$handle->bindParam(':name', $sheet->getName(), Database::PARAM_STR);
		$handle->bindParam(':race_id', $sheet->getRace()->getId(), Database::PARAM_INT);
		$handle->bindParam(':appearance', $sheet->getAppearance(), Database::PARAM_STR);
		$handle->bindParam(':archetype', $sheet->getArchetype(), Database::PARAM_STR);
		$handle->bindParam(':description', $sheet->getDescription(), Database::PARAM_STR);
		$handle->bindParam(':exp', $sheet->getExp(), Database::PARAM_STR);
		if ($update) {
			$handle->bindParam(':id', $sheet->getId(), Database::PARAM_INT);
		}
		$handle->execute();

//		$this->persistRelations($sheet, $update);

		// Commits transaction
		$this->db->commit();
	}

	/**
	 * Creates Sheet from database
	 * @param type $id
	 * @return Sheet
	 */
	public function getById($id)
	{
		$sheet = new Sheet();

		$query = "
		SELECT *
		FROM `sheet`
		WHERE `id` = :id
		";

		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $id, Database::PARAM_INT);
		$handle->execute();

		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		if (count($result) == 0) {
			throw new Exception("Sheet not found ($id)");
		}
		$result = $result[0];

		$sheet->setId($id);
		$sheet->setName($result['name']);
		$sheet->setAppearance($result['appearance']);
		$sheet->setArchetype($result['archetype']);
		$sheet->setDescription($result['description']);
		$sheet->setExp($result['exp']);

		$userRepository = new UserRepository($this->db);
		$sheet->setUser($userRepository->getById($result['user_id']));

		$raceRepository = new RaceRepository($this->db);
		$sheet->setRace($raceRepository->getById($result['race_id']));

		$edgeRepository = new EdgeRepository($this->db);
		$sheet->setEdges($edgeRepository->getForSheet($sheet));

		$hindranceRepository = new HindranceRepository($this->db);
		$sheet->setHindrances($hindranceRepository->getForSheet($sheet));

		$powerRepository = new PowerRepository($this->db);
		$sheet->setPowers($powerRepository->getForSheet($sheet));

		$attributeRepository = new AttributeRepository($this->db);
		$sheet->setAttributes($attributeRepository->getForSheet($sheet));

		$skillRepository = new SkillRepository($this->db);
		$sheet->setSkills($skillRepository->getForSheet($sheet));

		return $sheet;
	}

	public function getAllSimple()
	{
		$query = "
		SELECT *
		FROM `sheet`
		";
		$handle = $this->db->query($query);
		$result = $handle->fetchAll();
		$sheets = array();
		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$sheet = new Sheet();
			$sheet->setId($res['id']);
			$sheet->setName($res['name']);
			$sheet->setAppearance($res['appearance']);
			$sheet->setArchetype($res['archetype']);
			$sheet->setDescription($res['description']);
			$sheet->setExp($res['exp']);

			$userRepository = new UserRepository($this->db);
			$sheet->setUser($userRepository->getById($res['user_id']));

			$raceRepository = new RaceRepository($this->db);
			$sheet->setRace($raceRepository->getById($res['race_id']));
			$sheets[] = $sheet;
		}
		return $sheets;
	}

	public function remove($id)
	{
		//TODO
		echo "Sheet $id removed";
	}

	/**
	 * Persists Sheet relations
	 * @param Sheet $sheet
	 */
	private function persistRelations(Sheet $sheet, $update = true)
	{
		$hindranceRepository = new HindranceRepository($this->db);
		$hindranceRepository->persistRelations($sheet, $update);

		$edgeRepository = new EdgeRepository($this->db);
		$edgeRepository->persistRelations($sheet, $update);

		$skillRepository = new SkillRepository($this->db);
		$skillRepository->persistRelations($sheet, $update);

		$powerRepository = new PowerRepository($this->db);
		$powerRepository->persistRelations($sheet, $update);

		$attributeRepository = new AttributeRepository($this->db);
		$attributeRepository->persistRelations($sheet, $update);
	}

	/**
	 * Creates sample Sheet object (Naklatanox)
	 * @param Sheet $sheet
	 * @return Sheet
	 */
	public function gimmeNaklatanox()
	{
		$nakl = new Sheet();
		$nakl->setAppearance('Koks');
		$nakl->setArchetype('Press R to win');
		$nakl->setExp(60);

		$attributes = array();

		$strength = new Attribute(1, 'Siła', 'Opis', 12);
		$vigor = new Attribute(2, 'Wigor', 'Opis', 12);
		$agility = new Attribute(3, 'Zręczność', 'Opis', 4);
		$spirit = new Attribute(4, 'Duch', 'Opis', 4);
		$smarts = new Attribute(5, 'Spryt', 'Opis', 4);
		$attributes[] = $strength;
		$attributes[] = $vigor;
		$attributes[] = $agility;
		$attributes[] = $spirit;
		$attributes[] = $smarts;
		$nakl->setAttributes($attributes);

		$edges = array();
		$edges[] = new Edge(1, 'Odporny', 'No kurwa odporny');
		$edges[] = new Edge(2, 'Berserker', 'No kurwa');
		$edges[] = new Edge(3, 'Dzikie prącie', 'Bulbasaur, atak dzikim prąciem!');

		$nakl->setEdges($edges);

		$hindrances = array();
		$hindrances[] = new Hindrance(1, 'Chojrak', 'No kurwa chojrak');
		$hindrances[] = new Hindrance(2, 'Grubas', 'No kurwa grubas');
		$hindrances[] = new Hindrance(3, 'Tepy chuj', 'Ale panie kapitanie...');

		$nakl->setHindrances($hindrances);

		$skills[] = new Skill(1, 'Wspinaczka', 10, $strength);
		$skills[] = new Skill(2, 'Taplanie się w blotku jak swinka', 6, $agility);
		$skills[] = new Skill(3, 'Napierdalanka', 12, $agility);

		$nakl->setSkills($skills);

		$race = new Race(2, 'krasnolud');

		$powers = array();
		$powers[] = new Power(1, 'koń', 'z ogonkiem');
		$powers[] = new Power(2, 'pies', 'z uszami');
		$powers[] = new Power(3, 'rozpierdalacz', 'z broniom');

		$nakl->setPowers($powers);

		$nakl->setRace($race);
		$nakl->setId(1);
		$nakl->setName('Naklatanox');
		$nakl->setUser(new User(1, 'Adam'));
		$nakl->setDescription('No kurwa Naklatanox!!!');

		return $nakl;
	}

}

?>
