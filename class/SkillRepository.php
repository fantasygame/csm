<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SkillRepository
 *
 * @author kuba
 */
class SkillRepository
{
	private $mysql;

	public function __construct(MySql $mysql)
	{
		$this->mysql = $mysql;
	}

	public function persist(Skill $skill, Sheet $sheet)
	{
		$query = "
		INSERT INTO `sheet_skill` (
			`id` ,
			`sheet_id` ,
			`skill_id`,
			`value`
		)
		VALUES (
			NULL,
			'{$sheet->getId()}',
			'{$skill->getId()}',
			'{$skill->getValue()}'
		);
		";

		$this->mysql->query($query);
	}


}

?>
