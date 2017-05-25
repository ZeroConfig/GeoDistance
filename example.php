<?php
require_once __DIR__ . '/vendor/autoload.php';

use function ZeroConfig\GeoDistance\coordinates;
use function ZeroConfig\GeoDistance\distance;
use ZeroConfig\GeoDistance\ConvertedDistanceCalculator;
use ZeroConfig\GeoDistance\DistanceCalculator;
use ZeroConfig\GeoDistance\Position;
use ZeroConfig\GeoDistance\Sphere\CelestialBody\Mars;
use Measurements\Units\UnitLength;

// Returns a distance of approximately 361 kilometers.
// The distance function uses the distance calculator under the hood.
// It assumes earth as base sphere for calculations.
echo distance(
    coordinates(50.0, 5.0),
    coordinates(53.0, 3.0)
) . PHP_EOL;

$marsDistanceCalculator = new ConvertedDistanceCalculator(
    new DistanceCalculator(new Mars()),
    UnitLength::kilometers()
);

// On Mars, the same coordinates give a distance of only 192 kilometers.
echo $marsDistanceCalculator->calculate(
    Position::create(50.0, 5.0),
    Position::create(53.0, 3.0)
) . PHP_EOL;
