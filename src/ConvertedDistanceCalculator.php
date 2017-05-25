<?php

namespace ZeroConfig\GeoDistance;

use Measurements\Dimension;
use Measurements\Measurement;

class ConvertedDistanceCalculator implements DistanceCalculatorInterface
{
    /** @var DistanceCalculatorInterface */
    private $calculator;

    /** @var Dimension */
    private $dimension;

    /**
     * Constructor.
     *
     * @param DistanceCalculatorInterface $calculator
     * @param Dimension                   $dimension
     */
    public function __construct(
        DistanceCalculatorInterface $calculator,
        Dimension $dimension
    ) {
        $this->calculator = $calculator;
        $this->dimension  = $dimension;
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
        return $this
            ->calculator
            ->calculate($start, $end)
            ->convertTo($this->dimension);
    }
}
