<?php

/**
 * Description of ModifierCalculator
 *
 * @author kuba
 */
class ModifierCalculator
{

	public function calculate(Sheet &$sheet)
	{
		// toughness
		$vigor = $sheet->getAttribute(4);
		$toughness = floor($vigor->getValue() / 2) + 2;
		$sheet->setToughness($toughness);

		// parry
		$fight = $sheet->getSkill(1);
		if ($fight && method_exists($fight, 'getValue')) {
			$fightValue = $fight->getValue();
		} else {
			$fightValue = 0;
		}
		$parry = floor($fightValue / 2) + 2;
		$sheet->setParry($parry);

		$edges = $sheet->getEdges();
		for ($i = 0; $i < count($edges); $i++) {
			$edge = $edges[$i];
			$modifiers = $edge->getModifiers();
			for ($j = 0; $j < count($modifiers); $j++) {
				$this->calculateModifier($modifiers[$j], $sheet);
			}
		}

		$hindrances = $sheet->getHindrances();
		for ($i = 0; $i < count($hindrances); $i++) {
			$hindrance = $hindrances[$i];
			$modifiers = $hindrance->getModifiers();
			for ($j = 0; $j < count($modifiers); $j++) {
				$this->calculateModifier($modifiers[$j], $sheet);
			}
		}

		$race = $sheet->getRace();
		$modifiers = $race->getModifiers();
		for ($i = 0; $i < count($modifiers); $i++) {
			$this->calculateModifier($modifiers[$i], $sheet);
		}
	}

	private function calculateModifier(Modifier $modifier, Sheet &$sheet)
	{
		$class = get_class($modifier);
		if ($class == 'EdgeModifier') {
			$edge = $modifier->getEdge();
			$modifiers = $edge->getModifiers();
			for ($i = 0; $i < count($modifiers); $i++) {
				$this->calculateModifier($modifiers[$i], $sheet);
			}
			$sheet->addEdge($edge);
		} else if ($class == 'HindranceModifier') {
			$hindrance = $modifier->getHindrance();
			$modifiers = $hindrance->getModifiers();
			for ($i = 0; $i < count($modifiers); $i++) {
				$this->calculateModifier($modifiers[$i], $sheet);
			}
			$sheet->addHindrance($hindrance);
		} else if ($class == 'AttributeModifier') {
			$attributes = $sheet->getAttributes();
			for ($i = 0; $i < count($attributes); $i++) {
				if ($attributes[$i]->getId() == $modifier->getAttributeId()) {
					$dice = $modifier->getDice();
					if ($dice) {
						$value = $attributes[$i]->getValue();
						$value = $this->addDices($value, $modifier->getModifier());
						$attributes[$i]->setValue($value);
						$attributes[$i]->setDiceModifier($attributes[$i]->getDiceModifier() + $modifier->getModifier());
						if ($modifier->getStarting()) {
							$starting = $this->addDices($attributes[$i]->getStarting(), $modifier->getModifier());
							$attributes[$i]->setStarting($starting);
						}
					} else {
						$attributes[$i]->setModifier($attributes[$i]->getModifier() + $modifier->getModifier());
					}
				}
			}
			$sheet->setAttributes($attributes);
		} else if ($class == 'SkillModifier') {
			$skills = $sheet->getSkills();
			for ($i = 0; $i < count($skills); $i++) {
				if ($skills[$i]->getId() == $modifier->getSkillId()) {
					$dice = $modifier->getDice();
					if ($dice) {
						$value = $skills[$i]->getValue();
						$value = $this->addDices($value, $modifier->getModifier());
						$skills[$i]->setValue($value);
						$skills[$i]->setDiceModifier($skills[$i]->getDiceModifier() + $modifier->getModifier());
					} else {
						$skills[$i]->setModifier($skills[$i]->getModifier() + $modifier->getModifier());
					}
				}
			}
			$sheet->setSkills($skills);
		} else if ($class == 'SecondaryModifier') {
			$secondary = $modifier->getSecondary();
			$secondary[0] = strtoupper($secondary);
			$getter = "get$secondary";
			$value = $sheet->$getter();
			$value += $modifier->getModifier();
			$setter = "set$secondary";
			$sheet->$setter($value);
		} else {
			throw new Exception("Unknown Modifier: $class");
		}
	}

	private function addDices($value, $dices)
	{
		for ($i = 0; $i < $dices; $i++) {
			if ($value < 12) {
				$value += 2;
			} else {
				$value += 1;
			}
		}
		return $value;
	}

}

?>
