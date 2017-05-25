<?php

namespace ZeroConfig\GeoDistance;

use Measurements\Quantities\Angle;

interface PositionInterface
{
    /**
     * Get the latitude coordinate of the current location.
     *
     * @return Angle
     */
    public function getLatitude(): Angle;

    /**
     * Get the longitude coordinate of the current location.
     *
     * @return Angle
     */
    public function getLongitude(): Angle;
}
