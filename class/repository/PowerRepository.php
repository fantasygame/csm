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
