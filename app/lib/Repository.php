<?php

/**
 * Description of Repository
 *
 * @author kuba
 */
abstract class Repository
{
	/* @var $db Database */

	protected $db;

	public function __construct()
	{
		$config = SimpleConfig::getInstance();
		$this->db = $config->db;
	}

	protected function relations($mainObject, $update, $methodNameMain, $methodName, $fields = array())
	{
		if (!$update) {
			$objects = $mainObject->$methodNameMain();
			for ($i = 0; $i < count($objects); $i++) {
				$this->addRelation($objects[$i], $mainObject, $fields);
			}
		} else {
			$objectsUpdate = $mainObject->$methodNameMain();
			$objects = $this->$methodName($mainObject);

			for ($i = 0; $i < count($objects); $i++) {
				$object = $objects[$i];
				$found = false;
				for ($j = 0; $j < count($objectsUpdate); $j++) {
					$objectUpdate = $objectsUpdate[$j];
					if ($object == $objectUpdate) {
						$found = true;
						break;
					}
				}
				if (!$found) {
					$this->removeRelation($object, $mainObject);
				}
			}
			for ($i = 0; $i < count($objectsUpdate); $i++) {
				$objectUpdate = $objectsUpdate[$i];
				$found = false;
				for ($j = 0; $j < count($objects); $j++) {
					$object = $objects[$j];
					if ($objectUpdate == $object) {
						$found = true;
						break;
					}
				}
				if (!$found) {
					$this->addRelation($objectUpdate, $mainObject, $fields);
				}
			}
		}
	}

	protected function addRelation($object1, $object2, $fieldKeys)
	{
		$fields = array();
		for ($i = 0; $i < count($fieldKeys); $i++) {
			$key = $fieldKeys[$i];
			$method = $this->getter($key);
			$fields[$fieldKeys[$i]] = $object1->$method();
		}

		$name1 = strtolower(get_class($object1));
		$name2 = strtolower(get_class($object2));

		$relationTable = $name2 . '_' . $name1;

		$name1 = $name1 . '_id';
		$name2 = $name2 . '_id';

		$query = "
		SELECT count(1) as count
		FROM `$relationTable`
		WHERE
		`$name1` = :$name1
		AND `$name2` = :$name2
		";
		$handle = $this->db->prepare($query);
		$handle->bindParam(":$name1", $object1->getId(), Database::PARAM_INT);
		$handle->bindParam(":$name2", $object2->getId(), Database::PARAM_INT);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		if ($result[0]['count'] > 0) {
			if (empty($fieldKeys)) {
				return false;
			}
			$query = "UPDATE `$relationTable` SET ";
			$first = true;
			foreach ($fields as $name => $value) {
				if ($first) {
					$query .= "`$name` = :$name";
				} else {
					$query .= ", `$name` = :$name";
				}
			}
			$query .= " WHERE `$name1` = :$name1 AND `$name2` = :$name2";
		} else {
			$query1 = "INSERT INTO `$relationTable` (`$name1`, `$name2`";
			$query2 = ") VALUES (:$name1 , :$name2";
			foreach ($fields as $name => $value) {
				$query1 .= ", `$name`";
				$query2 .= ", :$name";
			}
			$query = "$query1$query2);";
		}
		
		$handle = $this->db->prepare($query);
		$handle->bindParam(":$name1", $object1->getId(), Database::PARAM_INT);
		$handle->bindParam(":$name2", $object2->getId(), Database::PARAM_INT);
		foreach ($fields as $name => $value) {
			$handle->bindParam(":$name", $value);
		}
		$handle->execute();
	}

	protected function removeRelation($object1, $object2)
	{
		$name1 = strtolower(get_class($object1));
		$name2 = strtolower(get_class($object2));

		$relationTable = $name2 . '_' . $name1;

		$name1 = $name1 . '_id';
		$name2 = $name2 . '_id';

		$query = "
		DELETE
		FROM `$relationTable`
		WHERE `$name1` = :$name1
		AND `$name2` = :$name2
		";
		$handle = $this->db->prepare($query);
		$handle->bindParam(":$name1", $object1->getId(), Database::PARAM_INT);
		$handle->bindParam(":$name2", $object2->getId(), Database::PARAM_INT);
		$handle->execute();
	}

	private function getter($key)
	{
		$firstLetter = strtoupper($key[0]);
		$key = substr($key, 1);
		$getter = 'get' . $firstLetter . $key;
		return $getter;
	}

}

?>
