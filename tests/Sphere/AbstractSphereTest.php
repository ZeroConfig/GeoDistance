<?php

namespace ZeroConfig\GeoDistance\Tests\Sphere;

use Measurements\Quantities\Length;
use ZeroConfig\GeoDistance\Sphere\AbstractSphere;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \ZeroConfig\GeoDistance\Sphere\AbstractSphere
 */
class AbstractSphereTest extends TestCase
{
    /**
     * @return void
     * @covers ::getRadius
     */
    public function testGetRadius()
    {
        /** @var AbstractSphere $sphere */
        $sphere = $this->getMockForAbstractClass(AbstractSphere::class);

        $this->assertInstanceOf(
            Length::class,
            $sphere->getRadius()
        );
    }
}
