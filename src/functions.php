<?php
namespace ZeroConfig\GeoDistance;

use Measurements\Measurement;
use Measurements\Units\UnitLength;
use ZeroConfig\GeoDistance\Sphere\CelestialBody\Earth;

// @codeCoverageIgnoreStart

/**
 * Create a position value object for the given coordinates.
 *
 * @param float $latitude
 * @param float $longitude
 *
 * @return PositionInterface
 */
function coordinates(float $latitude, float $longitude): PositionInterface
{
    return Position::create($latitude, $longitude);
}

/**
 * Calculate the metric distance between the given positions.
 *
 * @param PositionInterface $start
 * @param PositionInterface $end
 *
 * @return Measurement
 */
function distance(
    PositionInterface $start,
    PositionInterface $end
): Measurement {
    /** @var DistanceCalculatorInterface $calculator */
    static $calculator;

    if (!$calculator instanceof DistanceCalculatorInterface) {
        $calculator = new ConvertedDistanceCalculator(
            new DistanceCalculator(new Earth()),
            UnitLength::kilometers()
        );
    }

    return $calculator->calculate($start, $end);
}

// @codeCoverageIgnoreEnd
