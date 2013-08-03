<?php

/**
 * Description of Manager
 *
 * @author kuba
 */
class SheetRepository
{
	/* @var $mysql MySql */

	private $mysql;

	public function __construct(MySql $mysql)
	{
		$this->mysql = $mysql;
	}

	public function persist(Sheet $sheet)
	{
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
			NULL,
			'{$sheet->getUser()->getId()}',
			'{$sheet->getName()}',
			'{$sheet->getRace()->getId()}',
			'{$sheet->getAppearance()}',
			'{$sheet->getArchetype()}',
			'{$sheet->getDescription()}',
			'{$sheet->getExp()}'
		);
		";

		$this->mysql->query($query);

		$hindranceRepository = new HindranceRepository($this->mysql);

		$hindrances = $sheet->getHindrances();

		for ($i = 0; $i < count($hindrances); $i++) {
			$hindranceRepository->persist($hindrances[$i], $sheet);
		}
		$edgeRepository = new EdgeRepository($this->mysql);

		$edges = $sheet->getEdges();

		for ($i = 0; $i < count($edges); $i++) {
			$edgeRepository->persist($edges[$i], $sheet);
		}
		
		$skills = $sheet->getSkills();
		$skillRepository = new SkillRepository($this->mysql);
		
		for ($i = 0; $i < count($skills); $i++) {
			$skillRepository->persist($skills[$i], $sheet);
		}
		$powers = $sheet->getPowers() ;
		$powerRepository = new PowerRepository($this->mysql);
		for ($i = 0; $i < count($powers); $i++) {
			$powerRepository->persist($powers[$i], $sheet);
		
		}
	}

	public function create($id)
	{
		$sheet = new Sheet();
		return $sheet;
	}

	public function gimmeNaklatanox($roar)
	{
		echo "<p>$roar</p>";
		$nakl = new Sheet();
		$nakl->setAppearance('Koks');
		$nakl->setArchetype('Press R to win');

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
