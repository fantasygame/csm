<?php

/**
 * Database methods for Attribute
 *
 * @author PHP Summer Workshop
 */
class AttributeRepository extends Repository
{

	/**
	 * Persists Attribute relations
	 * @param Sheet $sheet
	 */
	public function persistRelations(Sheet $sheet)
	{
		$attributes = $sheet->getAttributes();
		for ($i = 0; $i < count($attributes); $i++) {
			$this->persistRelation($attributes[$i], $sheet);
		}
	}

	/**
	 * Persists relation between Attribute and Sheet
	 * @param Attribute $attribute
	 * @param Sheet $sheet
	 */
	private function persistRelation(Attribute $attribute, Sheet $sheet)
	{
		$query = "
		INSERT INTO `sheet_attribute` (
			`id` ,
			`sheet_id` ,
			`attribute_id`,
			`value`
		)
		VALUES (
			NULL,
			:sheet_id ,
			:attribute_id,
			:value
		);
		";
		$handle = $this->db->prepare($query);
		$handle->bindParam(':sheet_id', $sheet->getId(), Database::PARAM_INT);
		$handle->bindParam(':attribute_id', $attribute->getId(), Database::PARAM_INT);
		$handle->bindParam(':value', $attribute->getValue(), Database::PARAM_INT);
		$handle->execute();
	}

	public function getById($id, $value)
	{
		$baseAttributeRepository = new BaseAttributeRepository($this->db);
		$base = $baseAttributeRepository->getById($id);
		$attribute = new Attribute($base->getId(), $base->getName(), $base->getDescription(), $value);
		return $attribute;
	}

	public function getForSheet(Sheet $sheet)
	{
		$query = "
		SELECT `attribute_id`, `value`
		FROM `sheet_attribute`
		WHERE `sheet_id` = :id
		";
		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $sheet->getId(), Database::PARAM_INT);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		$attributes = array();
		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$attribute = $this->getById($res['attribute_id'], $res['value']);
			$attributes[] = $attribute;
		}
		return $attributes;
	}

}

?>
