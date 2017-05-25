<?php

namespace ZeroConfig\GeoDistance\Sphere;

use Measurements\Quantities\Length;
use Measurements\Units\UnitLength;

abstract class AbstractSphere implements SphereInterface
{
    const RADIUS = .0;

    /**
     * Get the radius of the sphere in meters.
     *
     * @return Length
     */
    public function getRadius(): Length
    {
        return new Length(
            static::RADIUS,
            UnitLength::meters()
        );
    }
}
