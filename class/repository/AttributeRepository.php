<?php

/**
 * Description of AttributeRepository
 *
 * @author kuba
 */
class AttributeRepository
{
	/* @var $db Database */

	private $db;

	public function __construct(Database $db)
	{
		$this->db = $db;
	}

	public function persistRelation(Attribute $attribute, Sheet $sheet)
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
		$handle->bindParam(':power_id', $attribute->getId(), PDO::PARAM_INT);
		$handle->execute();
	}

}

?>
