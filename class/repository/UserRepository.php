<?php

/**
 * Description of UserRepository
 *
 * @author kuba
 */
class UserRepository
{
	/* @var $db Database */

	private $db;

	public function __construct(Database $db)
	{
		$this->db = $db;
	}

	/**
	 * Get all the Users
	 * @return array of User
	 */
	public function getAll()
	{
		$query = "
		SELECT * FROM `user`
		";

		$handle = $this->db->query($query);
		$result = $handle->fetchAll(Database::FETCH_ASSOC);

		$users = array();

		for ($i = 0; $i < count($result); $i++) {
			$res = $result[$i];
			$user = new User($res['id'], $res['name']);
			$users[] = $user;
		}

		return $users;
	}

	public function getById($id)
	{
		$query = "
			SELECT *
			FROM `user`
			WHERE `id` = :id
		";

		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $id, Database::PARAM_INT);
		$handle->execute();

		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		if (count($result) == 0) {
			throw new Exception("User not found ($id)");
		}
		$res = $result[0];

		$user = new User($res['id'], $res['name']);

		return $user;
	}

}

?>
