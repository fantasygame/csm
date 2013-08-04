<?php

/**
 * Description of Manager
 *
 * @author kuba
 */
class SheetRepository
{
	/* @var $db Database */

	private $db;

	public function __construct(Database $db)
	{
		$this->db = $db;
	}

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
		$handle->bindParam(':user_id', $sheet->getUser()->getId(), PDO::PARAM_INT);
		$handle->bindParam(':name', $sheet->getName(), PDO::PARAM_STR);
		$handle->bindParam(':race_id', $sheet->getRace()->getId(), PDO::PARAM_INT);
		$handle->bindParam(':appearance', $sheet->getAppearance(), PDO::PARAM_STR);
		$handle->bindParam(':archetype', $sheet->getArchetype(), PDO::PARAM_STR);
		$handle->bindParam(':description', $sheet->getDescription(), PDO::PARAM_STR);
		$handle->bindParam(':exp', $sheet->getExp(), PDO::PARAM_STR);

		$handle->execute();
		$this->persistRelations($sheet);
		$this->db->commit();
	}

	public function create($id)
	{
		$sheet = new Sheet();
		return $sheet;
	}

	private function persistRelations(Sheet $sheet)
	{
		$this->persistHindrances($sheet);
		$this->persistEdges($sheet);
		$this->persistSkills($sheet);
		$this->persistPowers($sheet);
		$this->persistAttributes($sheet);
	}

	private function persistHindrances(Sheet $sheet)
	{
		$hindrances = $sheet->getHindrances();
		$hindranceRepository = new HindranceRepository($this->db);
		for ($i = 0; $i < count($hindrances); $i++) {
			$hindranceRepository->persistRelation($hindrances[$i], $sheet);
		}
	}

	private function persistEdges(Sheet $sheet)
	{
		$edges = $sheet->getEdges();
		$edgeRepository = new EdgeRepository($this->db);
		for ($i = 0; $i < count($edges); $i++) {
			$edgeRepository->persistRelation($edges[$i], $sheet);
		}
	}

	private function persistSkills(Sheet $sheet)
	{
		$skills = $sheet->getSkills();
		$skillRepository = new SkillRepository($this->db);
		for ($i = 0; $i < count($skills); $i++) {
			$skillRepository->persistRelation($skills[$i], $sheet);
		}
	}

	private function persistPowers(Sheet $sheet)
	{
		$powers = $sheet->getPowers();
		$powerRepository = new PowerRepository($this->db);
		for ($i = 0; $i < count($powers); $i++) {
			$powerRepository->persistRelation($powers[$i], $sheet);
		}
	}
	
	private function persistAttributes(Sheet $sheet)
	{
		$attributes = $sheet->getAttributes();
		$attributeRepository = new AttributeRepository($this->db);
		for ($i = 0; $i < count($attributes); $i++) {
			$attributeRepository->persistRelation($attributes[$i], $sheet);
		}
	}

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

		$skills[] = new Skill(1, 'Wspinaczka', 6, $strength);
		$skills[] = new Skill(2, 'Taplanie się w blotku jak swinka', 6, $agility);
		$skills[] = new Skill(3, 'Napierdalanka', 12, $agility);

		$nakl->setSkills($skills);

		$race = new Race(1, 'człowiek');

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
