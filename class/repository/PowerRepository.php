<?php

/**
 * Database methods for Power
 *
 * @author PHP Summer Workshop
 */
class PowerRepository
{
	/* @var $db Database */

	private $db;

	public function __construct(Database $db)
	{
		$this->db = $db;
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
		$handle = $this->db->query($query);
		$handle->bindParam(':id', $id, Database::PARAM_INT);
		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		
		$res = $result[0];
		$power = new Power($res['id'], $res['name'], $res['description']);
		
		return $power;
	}

	/**
	 * Persists relation between Attribute and Sheet
	 * @param Power $power
	 * @param Sheet $sheet
	 */
	public function persistRelation(Power $power, Sheet $sheet)
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
		$handle->bindParam(':sheet_id', $sheet->getId(), PDO::PARAM_INT);
		$handle->bindParam(':power_id', $power->getId(), PDO::PARAM_INT);
		$handle->execute();
	}

}

?>
