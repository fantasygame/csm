<?php

/**
 * Database methods for Skill
 *
 * @author PHP Summer Workshop
 */
class SkillRepository extends Repository
{

	protected function persistRelations(Sheet $sheet, $update = true)
	{
		parent::persistRelations($sheet, $update, 'getSkills', 'getForSheet', array('value'));
	}

	public function getById($id, $value, Sheet $sheet)
	{
		$query = "
		SELECT * FROM `skill`
		WHERE `id` = :id
		";
		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $id);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		if (count($result) == 0) {
			throw new Exception("Skill not found ($id)");
		}
		$res = $result[0];

		$skill = new Skill($res['id'], $res['name'], $value, $sheet->getAttribute($res['attribute_id']));
		return $skill;
	}

	public function getForSheet(Sheet $sheet)
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

		$skills = array();
		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$skill = $this->getById($res['skill_id'], $res['value'], $sheet);
			$skills[] = $skill;
		}
		return $skills;
	}

}

?>
