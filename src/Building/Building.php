<?php

namespace Assura\Ogame\Building;

class Building 
{
	protected $_data;

	public function __construct($data)
	{
		$this->_data = $data;
	}

	public function __get($name)
	{
		if (isset($this->_data[$name])) {
			return $this->_data[$name];
		}

		return false;
	}

	public function __call($name, $args)
	{
		if (isset($this->_data[$name])) {
			return $this->_data[$name];
		}

		return false;
	}
}