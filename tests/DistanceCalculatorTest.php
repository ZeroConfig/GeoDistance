<?php

namespace ZeroConfig\GeoDistance\Tests;

use Measurements\Measurement;
use Measurements\Quantities\Length;
use Measurements\Units\UnitLength;
use ZeroConfig\GeoDistance\DistanceCalculator;
use PHPUnit\Framework\TestCase;
use ZeroConfig\GeoDistance\PositionInterface;
use ZeroConfig\GeoDistance\Sphere\SphereInterface;

/**
 * @coversDefaultClass \ZeroConfig\GeoDistance\DistanceCalculator
 */
class DistanceCalculatorTest extends TestCase
{
    /**
     * @return void
     * @covers ::calculate
     * @covers ::__construct
     */
    public function testCalculation()
    {
        /** @var SphereInterface|\PHPUnit_Framework_MockObject_MockObject $sphere */
        $sphere     = $this->createMock(SphereInterface::class);
        $calculator = new DistanceCalculator($sphere);

        $this->assertInstanceOf(DistanceCalculator::class, $calculator);

        /** @var PositionInterface $start */
        $start = $this->createMock(PositionInterface::class);

        /** @var PositionInterface $end */
        $end = $this->createMock(PositionInterface::class);

        /** @var Length|\PHPUnit_Framework_MockObject_MockObject $radius */
        $radius = $this->createMock(Length::class);

        $radius
            ->expects($this->once())
            ->method('unit')
            ->willReturn(
                UnitLength::meters()
            );

        $sphere
            ->expects($this->once())
            ->method('getRadius')
            ->willReturn($radius);

        $this->assertInstanceOf(
            Measurement::class,
            $calculator->calculate($start, $end)
        );
    }
}
