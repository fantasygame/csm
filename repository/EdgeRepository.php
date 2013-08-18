<?php

/**
 * Database methods for Edge
 *
 * @author PHP Summer Workshop
 */
class EdgeRepository extends Repository
{

	protected function persistRelations(Sheet $sheet, $update = true)
	{
		parent::relations($sheet, $update, 'getEdges', 'getForSheet');
	}

	/**
	 * Get all the Edges !!!
	 * @return array of Edges
	 */
	public function getAll()
	{
		$query = "
		SELECT * FROM `edge`
		";

		$handle = $this->db->query($query);
		$result = $handle->fetchAll(Database::FETCH_ASSOC);

		$edges = array();

		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$edge = new Edge($res['id'], $res['name'], $res['description']);
			$edges[] = $edge;
		}

		return $edges;
	}

	public function getById($id)
	{
		$query = "
			SELECT *
			FROM `edge`
			WHERE `id` = :id
		";

		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $id, Database::PARAM_INT);
		$handle->execute();

		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		if (count($result) == 0) {
			throw new Exception("Edge not found ($id)");
		}
		$res = $result[0];

		$edge = new Edge($res['id'], $res['name'], $res['description']);

		return $edge;
	}

	public function getForSheet(Sheet $sheet)
	{
		$query = "
		SELECT `edge_id`
		FROM `sheet_edge`
		WHERE `sheet_id` = :id
		";

		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $sheet->getId(), Database::PARAM_INT);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);

		$edges = array();
		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$edge = $this->getById($res['edge_id']);
			$edges[] = $edge;
		}
		return $edges;
	}

}

?>
