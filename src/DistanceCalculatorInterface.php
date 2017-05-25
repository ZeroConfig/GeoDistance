<?php

namespace ZeroConfig\GeoDistance;

use Measurements\Measurement;

interface DistanceCalculatorInterface
{
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
    ): Measurement;
}
