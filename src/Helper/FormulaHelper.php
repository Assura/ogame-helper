<?php

namespace Assura\Ogame\Helper;


class FormulaHelper
{
	public function buildingCost($level, $coefficient1, $coefficient2)
	{
		return (int)floor($coefficient1 * pow($coefficient2, $level - 1));
	}

	public function energyConsumption($level)
	{
		return $this->totalEnergyConsumption($level) - $this->totalEnergyConsumption($level - 1);
	}

	public function totalEnergyConsumption($level)
	{
		$total  = 10 * $level * pow(1.1, $level);
		$result = floor($total); 

		if ($total > $result) {
			$result += 1;
		}

		return (int)$result;
	}

	public function buildingProduction($level, $coefficient1, $coefficient2)
	{
		$total = $coefficient1 * $level * pow($coefficient2, $level);
		$result = floor($total);

		return (int)$result;
	}
}