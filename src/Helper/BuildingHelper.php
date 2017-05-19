<?php

namespace Assura\Ogame\Helper;

use Assura\Ogame\Helper\FormulaHelper;
use Assura\Ogame\Building\Building;
use Exception;

class BuildingHelper
{
	const BUILDING_TYPE_METAL_MINE = 'metal_mine';

	const BUILDING_TYPE_CRYSTAL_MINE = 'crystal_mine';

	const BUILDING_TYPE_DEUTERIUM_SYNTHETIZER = 'deuterium_synthetizer';

	const TYPE_METAL = 'metal';

	const TYPE_CRYSTAL = 'crystal';

	const TYPE_DEUTERIUM = 'deuterium';

	protected $_formula;

	protected $_data = array();

	public function __construct($data, FormulaHelper $formula)
	{
		if (isset($data['buildings'])) {
			foreach ($data['buildings'] as $building) {
				$this->_data[$building['code']] = $building;
			}
		}

		if (JSON_ERROR_NONE !== json_last_error()) {
			throw new Exception("Json config file is malformed");
		}

		$this->_formula = $formula;
	}

	public function getBuilding($code, $level) {
		if (self::BUILDING_TYPE_METAL_MINE == $code) {
			$buildingCode = self::BUILDING_TYPE_METAL_MINE;
		} else if (self::BUILDING_TYPE_CRYSTAL_MINE == $code) {
			$buildingCode = self::BUILDING_TYPE_CRYSTAL_MINE;
		} else {
			throw new Exception('This building code does not exist');
		}

		return new Building(array(
			'code'          => $buildingCode,
			'level'         => $level,
			'metalCost'     => $this->getCost($code, self::TYPE_METAL, $level),
			'crystalCost'   => $this->getCost($code, self::TYPE_CRYSTAL, $level),
			'deuteriumCost' => $this->getCost($code, self::TYPE_DEUTERIUM, $level),
			'production'    => $this->getProduction($code, $level),
		));
	}

	public function getCost($code, $type, $level)
	{
		if (!isset($this->_data[$code]['cost'][$type])) {
			return 0;
		}

		$data = $this->_data[$code]['cost'][$type];

		if (!isset($data['coef1']) || !isset($data['coef2'])) {
			return 0;
		}

		return $this->_formula->buildingCost(
			$level, 
			$data['coef1'],
			$data['coef2']
		);
	}

	public function getProduction($code, $level)
	{
		if (!isset($this->_data[$code]['production'])) {
			return 0;
		}

		$data = $this->_data[$code]['production'];

		if (!isset($data['coef1']) || !isset($data['coef2'])) {
			return 0;
		}

		return $this->_formula->buildingProduction(
			$level, 
			$data['coef1'],
			$data['coef2']
		);
	}
}