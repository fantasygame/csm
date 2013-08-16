<?php

/**
 * Database methods for Power
 *
 * @author PHP Summer Workshop
 */
class PowerRepository extends Repository
{

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

	/**
	 * Persists Power relations
	 * @param Sheet $sheet
	 */
	public function persistRelations(Sheet $sheet)
	{
		$powers = $sheet->getPowers();
		for ($i = 0; $i < count($powers); $i++) {
			$this->persistRelation($powers[$i], $sheet);
		}
	}

	/**
	 * Persists relation between Attribute and Sheet
	 * @param Power $power
	 * @param Sheet $sheet
	 */
	private function persistRelation(Power $power, Sheet $sheet)
	{
		$query = "
		INSERT INTO `sheet_power` (
			`id` ,
			`sheet_id` ,
			`power_id`			
		)
		VALUES (
			NULL,
			:sheet_id ,
			:power_id
		);
		";
		$handle = $this->db->prepare($query);
		$handle->bindParam(':sheet_id', $sheet->getId(), Database::PARAM_INT);
		$handle->bindParam(':power_id', $power->getId(), Database::PARAM_INT);
		$handle->execute();
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
