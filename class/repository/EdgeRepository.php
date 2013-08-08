<?php

/**
 * Database methods for Edge
 *
 * @author PHP Summer Workshop
 */
class EdgeRepository
{
	/* @var $db Database */

	private $db;

	public function __construct(Database $db)
	{
		$this->db = $db;
	}

	/**
	 * Persists relation between Attribute and Edge
	 * @param Edge $edge
	 * @param Sheet $sheet
	 */
	public function persistRelation(Edge $edge, Sheet $sheet)
	{
		$query = "
		INSERT INTO `sheet_edge` (
			`id` ,
			`sheet_id` ,
			`edge_id`			
		)
		VALUES (
			NULL,
			:sheet_id ,
			:edge_id	
		);
		";

		$handle = $this->db->prepare($query);
		$handle->bindParam(':sheet_id', $sheet->getId(), PDO::PARAM_INT);
		$handle->bindParam(':edge_id', $edge->getId(), PDO::PARAM_INT);
		$handle->execute();
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

}

?>
