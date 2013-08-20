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
	}

}

?>
