<?php

namespace ZeroConfig\GeoDistance\Sphere;

use Measurements\Quantities\Length;

interface SphereInterface
{
    /**
     * Get the radius of the sphere in meters.
     *
     * @return Length
     */
    public function getRadius(): Length;
}
