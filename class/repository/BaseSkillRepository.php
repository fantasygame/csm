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

	public function getAll()
	{
		$query = "
		SELECT * FROM `skill`
		";
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

}

?>
