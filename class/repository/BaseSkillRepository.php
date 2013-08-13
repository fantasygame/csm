<?php

/**
 * Description of BaseSkillRepository
 *
 * @author kuba
 */
class BaseSkillRepository
{

	private $db;

	public function __construct(Database $db)
	{
		$this->db = $db;
	}

	public function getAll($orderBy = false)
	{
		$query = "
		SELECT * FROM `skill`
		";
		if ($orderBy) {
			$query = "$query ORDER BY `$orderBy`";
		}
		$handle = $this->db->query($query);
		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		$skills = array();
		$baseAttributeRepository = new BaseAttributeRepository($this->db);
		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$attribute = $baseAttributeRepository->getById($res['attribute_id']);
			$skill = new BaseSkill($res['id'], $res['name'], $attribute);
			$skills[] = $skill;
		}
		return $skills;
	}

	public function getById($id)
	{
		$query = "
		SELECT * FROM `skill`
		WHERE `id` = :id
		";
		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $id);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		$res = $result[0];
		$baseAttributeRepository = new BaseAttributeRepository($this->db);
		$skill = new BaseSkill($res['id'], $res['name'], $baseAttributeRepository->getById($res['attribute_id']));

		return $skill;
	}

}

?>
