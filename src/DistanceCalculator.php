<?php

namespace ZeroConfig\GeoDistance;

use Measurements\Exceptions\UnitException;
use Measurements\Measurement;
use Measurements\Quantities\Angle;
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
     * @throws UnitException UnitException When part of the distance is
     *   incalculable.
     */
    public function calculate(
        PositionInterface $start,
        PositionInterface $end
    ): Measurement {
        return (new Length(
            $this->calculateRadianLength($start, $end),
            UnitLength::meters()
        ))->multiplyBy($this->sphere->getRadius());
    }

    /**
     * Calculate the radian length between start and end.
     *
     * @param PositionInterface $start
     * @param PositionInterface $end
     *
     * @return float
     * @throws UnitException UnitException When part of the length is
     *  incalculable.
     */
    private function calculateRadianLength(
        PositionInterface $start,
        PositionInterface $end
    ): float {
        $startLatitude  = $this->getRadianValue($start->getLatitude());
        $endLatitude    = $this->getRadianValue($end->getLatitude());
        $deltaLatitude  = $this->getRadianValue(
            $start
                ->getLatitude()
                ->subtract($end->getLatitude())
        );
        $deltaLongitude = $this->getRadianValue(
            $start
                ->getLongitude()
                ->subtract($end->getLongitude())
        );

        return asin(
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
        ) * 2;
    }

    /**
     * Get the radion value for the supplied angle.
     *
     * @param Measurement $angle
     *
     * @return float
     * @throws UnitException UnitException When part of the angle is
     *   incalculable.
     */
    private function getRadianValue(Measurement $angle): float
    {
        return $angle->convertTo(UnitAngle::radians())->value();
    }
}
