<?php

/**
 * Database methods for Power
 *
 * @author PHP Summer Workshop
 */
class PowerRepository extends Repository
{

	protected function persistRelations(Sheet $sheet, $update = true)
	{
		parent::relations($sheet, $update, 'getPowers', 'getForSheet');
	}

	public function getAll()
	{
		$query = "
		SELECT * FROM `power`
		";

		$handle = $this->db->query($query);
		$result = $handle->fetchAll(Database::FETCH_ASSOC);

		$powers = array();

		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$power = new Power($res['id'], $res['name'], $res['description']);
			$powers[] = $power;
		}

		return $powers;
	}

	public function getById($id)
	{
		$query = "
		SELECT * FROM `power`
		WHERE `id` = :id
		";
		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $id, Database::PARAM_INT);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		if (count($result) == 0) {
			throw new Exception("Power not found ($id)");
		}
		$res = $result[0];
		$power = new Power($res['id'], $res['name'], $res['description']);

		return $power;
	}

	public function getForSheet(Sheet $sheet)
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

		$powers = array();
		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$power = $this->getById($res['power_id']);
			$powers[] = $power;
		}
		return $powers;
	}

}

?>
