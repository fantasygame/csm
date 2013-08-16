<?php

/**
 * Description of RaceRepository
 *
 * @author kuba
 */
class RaceRepository extends Repository
{

	/**
	 * Get all the Races
	 * @return array of Race
	 */
	public function getAll()
	{
		$query = "
		SELECT * FROM `race`
		";

		$handle = $this->db->query($query);
		$result = $handle->fetchAll(Database::FETCH_ASSOC);

		$races = array();

		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$race = new Race($res['id'], $res['name']);
			$races[] = $race;
		}

		return $races;
	}

	public function getById($id)
	{
		$query = "
			SELECT *
			FROM `race`
			WHERE `id` = :id
		";

		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $id, Database::PARAM_INT);
		$handle->execute();

		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		if (count($result) == 0) {
			throw new Exception("Race not found ($id)");
		}
		$res = $result[0];

		$race = new Race($res['id'], $res['name']);

		return $race;
	}

}

?>
