<?php

/**
 * Description of ModifierRepository
 *
 * @author kuba
 */
class ModifierRepository extends Repository
{

	public function bindModifiers(&$object)
	{
		$class = get_class($object);
		$table = '';
		switch ($class) {
			case 'Race':
				$table = 'race_modifier';
				$column = 'race_id';
				break;
			case 'Edge':
				$table = 'edge_modifier';
				$column = 'edge_id';
				break;
			case 'Hindrance':
				$table = 'hindrance_modifier';
				$column = 'hindrance_id';
				break;
			default:
				throw new Exception("Can't get modifiers for $class");
				break;
		}
		$id = $object->getId();
		$query = "
		SELECT `modifier_id`
		FROM `$table`
		WHERE `$column` = :id
		";
		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $id, Database::PARAM_INT);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		
		$modifiers = array();
		for ($i = 0; $i < count($result); $i++) {
			$modifiers[] = $this->getById($result[$i]['modifier_id']);
		}
		$object->setModifiers($modifiers);
	}

	private function getById($id)
	{
		$query = "
		SELECT *
		FROM `modifier`
		WHERE `id` = :id
		";
		$handle = $this->db->prepare($query);
		$handle->bindParam(':id', $id, Database::PARAM_INT);
		$handle->execute();
		$result = $handle->fetchAll(Database::FETCH_ASSOC);
		if (count($result) == 0) {
			throw new Exception("Modifier $id not found");
		}
		$r = $result[0];
		if (!is_null($r['secondary'])) {
			$modifier = new SecondaryModifier($id, $r['modifier'], $r['secondary'], $r['dice']);
		} else if (!is_null($r['skill_id'])) {
			$modifier = new SkillModifier($id, $r['modifier'], $r['skill_id'], $r['dice']);
		} else if (!is_null($r['attribute_id'])) {
			$modifier = new AttributeModifier($id, $r['modifier'], $r['attribute_id'], $r['dice'], $r['attribute_starting']);
		} else if (!is_null($r['edge_id'])) {
			$edgeRepository = new EdgeRepository();
			$edge = $edgeRepository->getById($r['edge_id']);
			$edge->setFromModifier(true);
			$this->bindModifiers($edge);
			$modifier = new EdgeModifier($id, $edge);
		} else if (!is_null($r['hindrance_id'])) {
			$hindranceRepository = new HindranceRepository();
			$hindrance = $hindranceRepository->getById($r['hindrance_id']);
			$hindrance->setFromModifier(true);
			$this->bindModifiers($hindrance);
			$modifier = new HindranceModifier($id, $hindrance);
		} else {
			throw new Exception('Cant create Modifier for ' . $id);
		}
		return $modifier;
	}

}

?>
