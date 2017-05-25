<?php

namespace ZeroConfig\GeoDistance;

use Measurements\Quantities\Angle;
use Measurements\Units\UnitAngle;

class Position implements PositionInterface
{
    /** @var Angle */
    private $latitude;

    /** @var Angle */
    private $longitude;

    /**
     * Constructor.
     *
     * @param Angle $latitude
     * @param Angle $longitude
     */
    public function __construct(
        Angle $latitude,
        Angle $longitude
    ) {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * Create a position using the numerical representations of latitude and
     * longitude.
     *
     * @param float $latitude
     * @param float $longitude
     *
     * @return Position
     */
    public static function create(float $latitude, float $longitude): Position
    {
        return new static(
            new Angle($latitude, UnitAngle::degrees()),
            new Angle($longitude, UnitAngle::degrees())
        );
    }

    /**
     * Get the latitude coordinate of the current location.
     *
     * @return Angle
     */
    public function getLatitude(): Angle
    {
        return $this->latitude;
    }

    /**
     * Get the longitude coordinate of the current location.
     *
     * @return Angle
     */
    public function getLongitude(): Angle
    {
        return $this->longitude;
    }
}
