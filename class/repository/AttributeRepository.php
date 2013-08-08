<?php

/**
 * Database methods for Attribute
 *
 * @author PHP Summer Workshop
 */
class AttributeRepository
{
	/* @var $db Database */

	private $db;

	public function __construct(Database $db)
	{
		$this->db = $db;
	}

	/**
	 * Persists relation between Attribute and Sheet
	 * @param Attribute $attribute
	 * @param Sheet $sheet
	 */
	public function persistRelation(Attribute $attribute, Sheet $sheet)
	{
		$query = "
		INSERT INTO `sheet_attribute` (
			`id` ,
			`sheet_id` ,
			`attribute_id`			
		)
		VALUES (
			NULL,
			:sheet_id ,
			:attribute_id
		);
		";
		$handle = $this->db->prepare($query);
		$handle->bindParam(':sheet_id', $sheet->getId(), PDO::PARAM_INT);
		$handle->bindParam(':attribute_id', $attribute->getId(), PDO::PARAM_INT);
		$handle->execute();
	}

}

?>
