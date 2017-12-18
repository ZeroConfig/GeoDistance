<?php

namespace ZeroConfig\GeoDistance\Tests;

use Measurements\Exceptions\UnitException;
use Measurements\Measurement;
use Measurements\Quantities\Angle;
use Measurements\Quantities\Length;
use Measurements\Units\UnitAngle;
use Measurements\Units\UnitLength;
use PHPUnit_Framework_MockObject_MockObject;
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
     * @covers ::calculateRadianLength
     * @covers ::getRadianValue
     * @covers ::calculateHaversineDistance
     * @throws UnitException When part of the angle is incalculable.
     */
    public function testCalculation()
    {
        /** @var SphereInterface|PHPUnit_Framework_MockObject_MockObject $sphere */
        $sphere     = $this->createMock(SphereInterface::class);
        $calculator = new DistanceCalculator($sphere);

        $this->assertInstanceOf(DistanceCalculator::class, $calculator);

        /** @var PositionInterface $start */
        $start = $this->createMock(PositionInterface::class);

        /** @var PositionInterface $end */
        $end = $this->createMock(PositionInterface::class);

        $angle = new Angle(1, UnitAngle::degrees());

        /** @var PositionInterface|PHPUnit_Framework_MockObject_MockObject $position */
        foreach ([$start, $end] as $position) {
            $position
                ->expects(self::any())
                ->method(
                    self::matchesRegularExpression(
                        '/^get(Lat|Lon)/'
                    )
                )
                ->willReturn($angle);
        }

        /** @var Length|PHPUnit_Framework_MockObject_MockObject $radius */
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
