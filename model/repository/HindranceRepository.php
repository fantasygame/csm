<?php

/**
 * Database methods for Hindrance
 *
 * @author PHP Summer Workshop
 */
class HindranceRepository
{
	/* @var $db Database */

	private $db;

	public function __construct(Database $db)
	{
		$this->db = $db;
	}

	/**
	 * Persists Hindrance relations
	 * @param Sheet $sheet
	 */
	public function persistRelations(Sheet $sheet)
	{
		$hindrances = $sheet->getHindrances();
		for ($i = 0; $i < count($hindrances); $i++) {
			$this->persistRelation($hindrances[$i], $sheet);
		}
	}

	/**
	 * Persists relation between Attribute and Hindrance
	 * @param Hindrance $hindrance
	 * @param Sheet $sheet
	 */
	private function persistRelation(Hindrance $hindrance, Sheet $sheet)
	{
		$query = "
		INSERT INTO `sheet_hindrance` (
			`id` ,
			`sheet_id` ,
			`hindrance_id`			
		)
		VALUES (
			NULL,
			:sheet_id ,
			:hindrance_id	
		);
		";

		$handle = $this->db->prepare($query);
		$handle->bindParam(':sheet_id', $sheet->getId(), Database::PARAM_INT);
		$handle->bindParam(':hindrance_id', $hindrance->getId(), Database::PARAM_INT);
		$handle->execute();
	}

	public function getAll()
	{

		$query = "
			SELECT * FROM `hindrance`
			";

		$handle = $this->db->query($query);
		$result = $handle->fetchAll(Database::FETCH_ASSOC);

		$hindrances = array();

		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$hindrance = new Hindrance($res['id'], $res['name'], $res['description']);
			$hindrances[] = $hindrance;
		}
		return $hindrances;
	}

	public function getById($id)
	{
		$query = "
			SELECT *
			FROM `hindrance`
			WHERE `id` = :id
		";

		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $id, Database::PARAM_INT);
		$handle->execute();

		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		if (count($result) == 0) {
			throw new Exception("Hindrance not found ($id)");
		}
		$res = $result[0];

		$hindrance = new Hindrance($res['id'], $res['name'], $res['description']);

		return $hindrance;
	}

	public function getForSheet(Sheet $sheet)
	{
		$query = "
		SELECT `hindrance_id`
		FROM `sheet_hindrance`
		WHERE `sheet_id` = :id
		";

		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $sheet->getId(), Database::PARAM_INT);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);

		$hindrances = array();
		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$hindrance = $this->getById($res['hindrance_id']);
			$hindrances[] = $hindrance;
		}
		return $hindrances;
	}

}

?>
