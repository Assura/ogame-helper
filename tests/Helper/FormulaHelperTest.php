<?php

namespace Assura\Ogame\Tests\Helper;

use Assura\Ogame\Helper\FormulaHelper;

class FormulaHelperTest extends \PHPUnit_Framework_TestCase
{
	/**
	  * @dataProvider buildingCostProvider
	  */
	public function testBuildingCost($level, $coef1, $coef2, $expected)
	{
		$formula = new FormulaHelper();

		$total = $formula->buildingCost($level, $coef1, $coef2);

    	$this->assertEquals($expected, $total);
	}

	public function buildingCostProvider()
	{
		return [
			[10, 60, 1.5, 2306],
			[25, 60, 1.5, 1010046],
			[28, 60, 1.5, 3408907],
			[20, 24, 1.6, 181338],
		];
	}

	/**
	  * @dataProvider totalEnergyConsumptionProvider
	  */
	public function testTotalEnergyConsumption($level, $expected)
	{
		$formula = new FormulaHelper();

		$total = $formula->totalEnergyConsumption($level);

    	$this->assertEquals($expected, $total);
	}

	public function totalEnergyConsumptionProvider()
	{
		return [
			[19, 1163],
			[23, 2060],
			[27, 3540],
			[31, 5951],
		];
	}

	/**
	  * @dataProvider energyConsumptionProvider
	  */
	public function testEnergyConsumption($level, $expected)
	{
		$formula = new FormulaHelper();

		$total = $formula->energyConsumption($level);

    	$this->assertEquals($expected, $total);
	}

	public function energyConsumptionProvider()
	{
		return [
			[19, 162],
			[23, 269],
			[27, 441],
			[31, 716],
		];
	}

	/**
	  * @dataProvider buildingProductionProvider
	  */
	public function testBuildingProduction($level, $coef1, $coef2, $expected)
	{
		$formula = new FormulaHelper();
		$total = $formula->buildingProduction($level, $coef1, $coef2);

    	$this->assertEquals($expected, $total);
	}

	public function buildingProductionProvider()
	{
		return [
			[26, 30, 1.1, 9296],
			[27, 30, 1.1, 10619],
			[28, 30, 1.1, 12113],
			[29, 30, 1.1, 13800],
			[30, 30, 1.1, 15704],
			/*
			[23, 20, 1.1, 8236],
			[24, 20, 1.1, 9454],
			[25, 20, 1.1, 10834],
			[26, 20, 1.1, 12394],
			[27, 20, 1.1, 14158],
			*/
		];
	}
}