<?php

/**
 * Database methods for Skill
 *
 * @author PHP Summer Workshop
 */
class SkillRepository
{
	/* @var $db Database */

	private $db;

	public function __construct(Database $db)
	{
		$this->db = $db;
	}

	public function persistRelation(Skill $skill, Sheet $sheet)
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
			:sheet_id ,
			:skill_id,
			:value
		);
		";

		$handle = $this->db->prepare($query);
		$handle->bindParam(':sheet_id', $sheet->getId(), PDO::PARAM_INT);
		$handle->bindParam(':skill_id', $skill->getId(), PDO::PARAM_INT);
		$handle->bindParam(':value', $skill->getValue(), PDO::PARAM_INT);
		$handle->execute();
	}

	public function getById($id)
	{
		
	}

}

?>
