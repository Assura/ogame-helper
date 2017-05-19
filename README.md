# Ogame Helper

Cette librairie permet de connaître les différentes informations d'un bâtiment.

## Installation with Composer

```
require assura/ogame-helper
```
## Usage

```
use Assura\Ogame\Helper\BuildingHelper;

$building = $app['ogame.building']->getBuilding(BuildingHelper::BUILDING_TYPE_METAL_MINE, 20);

echo $building->getProduction();
```