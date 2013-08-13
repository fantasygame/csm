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
	public function persist(Sheet $sheet)
	{
		$this->db->beginTransaction();

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

		$handle = $this->db->prepare($query);
		$handle->bindParam(':user_id', $sheet->getUser()->getId(), Database::PARAM_INT);
		$handle->bindParam(':name', $sheet->getName(), Database::PARAM_STR);
		$handle->bindParam(':race_id', $sheet->getRace()->getId(), Database::PARAM_INT);
		$handle->bindParam(':appearance', $sheet->getAppearance(), Database::PARAM_STR);
		$handle->bindParam(':archetype', $sheet->getArchetype(), Database::PARAM_STR);
		$handle->bindParam(':description', $sheet->getDescription(), Database::PARAM_STR);
		$handle->bindParam(':exp', $sheet->getExp(), Database::PARAM_STR);
		$handle->execute();

		$this->persistRelations($sheet);

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
		if(count($result) == 0) {
			throw new Exception("Sheet not found ($id)");
		}
		$result = $result[0];

		$sheet->setId($id);
		$sheet->setName($result['name']);
		$sheet->setUser($result['user_id']);
		$sheet->setRace($result['race_id']);
		$sheet->setAppearance($result['appearance']);
		$sheet->setArchetype($result['archetype']);
		$sheet->setDescription($result['description']);
		$sheet->setExp($result['exp']);

		$edges = $this->getEdges($sheet);
		$sheet->setEdges($edges);

		$hindrances = $this->getHindrances($sheet);
		$sheet->setHindrances($hindrances);

		$powers = $this->getPowers($sheet);
		$sheet->setPowers($powers);

		$attributes = $this->getAttributes($sheet);
		$sheet->setAttributes($attributes);

		$skills = $this->getSkills($sheet);
		$sheet->setSkills($skills);

		return $sheet;
	}

	private function getSkills(Sheet $sheet)
	{
		$query = "
		SELECT `skill_id`, `value`
		FROM `sheet_skill`
		WHERE `sheet_id` = :id
		";
		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $sheet->getId(), Database::PARAM_INT);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		$skillRepository = new SkillRepository($this->db);
		$skills = array();
		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$skill = $skillRepository->getById($res['skill_id'], $res['value'], $sheet);
			$skills[] = $skill;
		}
		return $skills;
	}

	private function getAttributes(Sheet $sheet)
	{
		$query = "
		SELECT `attribute_id`, `value`
		FROM `sheet_attribute`
		WHERE `sheet_id` = :id
		";
		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $sheet->getId(), Database::PARAM_INT);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		$attributeRepository = new AttributeRepository($this->db);
		$attributes = array();
		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$attribute = $attributeRepository->getById($res['attribute_id'], $res['value']);
			$attributes[] = $attribute;
		}
		return $attributes;
	}

	private function getEdges(Sheet $sheet)
	{
		$query = "
		SELECT `edge_id`
		FROM `sheet_edge`
		WHERE `sheet_id` = :id
		";

		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $sheet->getId(), Database::PARAM_INT);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);

		$edgeRepository = new EdgeRepository($this->db);
		$edges = array();

		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$edge = $edgeRepository->getById($res['edge_id']);
			$edges[] = $edge;
		}
		return $edges;
	}

	private function getHindrances(Sheet $sheet)
	{
		$query = "
		SELECT `hindrance_id`
		FROM `sheet_hindrance`
		WHERE `sheet_id` = :id
		";

		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $sheet->getId(), Database::PARAM_INT);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);

		$hindranceRepository = new HindranceRepository($this->db);
		$hindrances = array();

		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$hindrance = $hindranceRepository->getById($res['hindrance_id']);
			$hindrances[] = $hindrance;
		}
		return $hindrances;
	}

	private function getPowers(Sheet $sheet)
	{
		$query = "
		SELECT `power_id`
		FROM `sheet_power`
		WHERE `sheet_id` = :id
		";

		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $sheet->getId(), Database::PARAM_INT);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);

		$powerRepository = new PowerRepository($this->db);
		$powers = array();

		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$power = $powerRepository->getById($res['power_id']);
			$powers[] = $power;
		}
		return $powers;
	}

	/**
	 * Persists Sheet relations
	 * @param Sheet $sheet
	 */
	private function persistRelations(Sheet $sheet)
	{
		$this->persistHindrances($sheet);
		$this->persistEdges($sheet);
		$this->persistSkills($sheet);
		$this->persistPowers($sheet);
		$this->persistAttributes($sheet);
	}

	/**
	 * Persists Hindrance relations
	 * @param Sheet $sheet
	 */
	private function persistHindrances(Sheet $sheet)
	{
		$hindrances = $sheet->getHindrances();
		$hindranceRepository = new HindranceRepository($this->db);
		for ($i = 0; $i < count($hindrances); $i++) {
			$hindranceRepository->persistRelation($hindrances[$i], $sheet);
		}
	}

	/**
	 * Persists Edge relations
	 * @param Sheet $sheet
	 */
	private function persistEdges(Sheet $sheet)
	{
		$edges = $sheet->getEdges();
		$edgeRepository = new EdgeRepository($this->db);
		for ($i = 0; $i < count($edges); $i++) {
			$edgeRepository->persistRelation($edges[$i], $sheet);
		}
	}

	/**
	 * Persists Skill relations
	 * @param Sheet $sheet
	 */
	private function persistSkills(Sheet $sheet)
	{
		$skills = $sheet->getSkills();
		$skillRepository = new SkillRepository($this->db);
		for ($i = 0; $i < count($skills); $i++) {
			$skillRepository->persistRelation($skills[$i], $sheet);
		}
	}

	/**
	 * Persists Power relations
	 * @param Sheet $sheet
	 */
	private function persistPowers(Sheet $sheet)
	{
		$powers = $sheet->getPowers();
		$powerRepository = new PowerRepository($this->db);
		for ($i = 0; $i < count($powers); $i++) {
			$powerRepository->persistRelation($powers[$i], $sheet);
		}
	}

	/**
	 * Persists Attribute relations
	 * @param Sheet $sheet
	 */
	private function persistAttributes(Sheet $sheet)
	{
		$attributes = $sheet->getAttributes();
		$attributeRepository = new AttributeRepository($this->db);
		for ($i = 0; $i < count($attributes); $i++) {
			$attributeRepository->persistRelation($attributes[$i], $sheet);
		}
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
