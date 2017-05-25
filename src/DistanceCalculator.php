<?php

namespace ZeroConfig\GeoDistance;

use Measurements\Measurement;
use Measurements\Quantities\Length;
use Measurements\Units\UnitAngle;
use Measurements\Units\UnitLength;
use ZeroConfig\GeoDistance\Sphere\SphereInterface;

/**
 * @see https://en.wikipedia.org/wiki/Haversine_formula
 */
class DistanceCalculator implements DistanceCalculatorInterface
{
    /** @var SphereInterface */
    private $sphere;

    /**
     * Constructor.
     *
     * @param SphereInterface $sphere
     */
    public function __construct(SphereInterface $sphere)
    {
        $this->sphere = $sphere;
    }

    /**
     * Calculate the distance between two positions.
     *
     * @param PositionInterface $start
     * @param PositionInterface $end
     *
     * @return Measurement
     */
    public function calculate(
        PositionInterface $start,
        PositionInterface $end
    ): Measurement {
        $radians        = UnitAngle::radians();

        $startLatitude  = $start->getLatitude()->convertTo($radians)->value();
        $endLatitude    = $end->getLatitude()->convertTo($radians)->value();

        $deltaLatitude  = $start
            ->getLatitude()
            ->subtract($end->getLatitude())
            ->convertTo($radians)
            ->value();

        $deltaLongitude = $start
            ->getLongitude()
            ->subtract($end->getLongitude())
            ->convertTo($radians)
            ->value();

        return (new Length(
            asin(
                sqrt(
                    pow(
                        sin($deltaLatitude * 0.5),
                        2
                    )
                    + cos($startLatitude)
                    * cos($endLatitude)
                    * pow(
                        sin($deltaLongitude * 0.5),
                        2
                    )
                )
            ) * 2,
            UnitLength::meters()
        ))->multiplyBy($this->sphere->getRadius());
    }
}
