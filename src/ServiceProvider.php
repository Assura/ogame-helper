<?php

namespace Assura\Ogame;

use Pimple\ServiceProviderInterface;
use Pimple\Container;
use Assura\Ogame\Helper\FormulaHelper;
use Assura\Ogame\Helper\BuildingHelper;


class ServiceProvider implements ServiceProviderInterface
{
	public function register(Container $app)
	{

        $app['ogame.config'] = function ($app) {
			$content = file_get_contents($app['ogame.config.file']);

            return json_decode($content, true);
        };

		$app['ogame.formula'] = function($app) {
			return new FormulaHelper();
		};

		$app['ogame.building'] = function($app) {
			return new BuildingHelper(
				$app['ogame.config'], 
				$app['ogame.formula']
			);
		};
	}
}