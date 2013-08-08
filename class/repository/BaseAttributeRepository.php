<?php

/**
 * Description of BaseAttributeRepository
 *
 * @author kuba
 */
class BaseAttributeRepository
{

	private $db;

	public function __construct(Database $db)
	{
		$this->db = $db;
	}

	public function getAll()
	{
		$query = "
		SELECT * FROM `attribute`
		";
		$handle = $this->db->query($query);
		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		$attributes = array();
		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$attribute = new BaseAttribute($res['id'], $res['name'], $res['description']);
			$attributes[] = $attribute;
		}
		return $attributes;
	}

	public function getById($id)
	{
		$query = "
		SELECT * FROM `attribute`
		WHERE `id` = :id
		";
		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $id, Database::PARAM_INT);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		$result = $result[0];
		$attribute = new BaseAttribute($result['id'], $result['name'], $result['description']);
		return $attribute;
	}

}

?>
