<?php

namespace ZeroConfig\GeoDistance\Tests;

use Measurements\Dimension;
use Measurements\Measurement;
use PHPUnit_Framework_MockObject_MockObject;
use ZeroConfig\GeoDistance\ConvertedDistanceCalculator;
use PHPUnit\Framework\TestCase;
use ZeroConfig\GeoDistance\DistanceCalculatorInterface;
use ZeroConfig\GeoDistance\PositionInterface;

/**
 * @coversDefaultClass \ZeroConfig\GeoDistance\ConvertedDistanceCalculator
 */
class ConvertedDistanceCalculatorTest extends TestCase
{
    /**
     * @return void
     * @covers ::__construct
     * @covers ::calculate
     */
    public function testCalculation()
    {
        /** @var DistanceCalculatorInterface|PHPUnit_Framework_MockObject_MockObject $calculator */
        $calculator = $this->createMock(
            DistanceCalculatorInterface::class
        );

        /** @var Dimension $dimension */
        $dimension = $this->createMock(Dimension::class);

        $converter = new ConvertedDistanceCalculator($calculator, $dimension);

        /** @var Measurement|PHPUnit_Framework_MockObject_MockObject $measurement */
        $measurement = $this->createMock(Measurement::class);

        $calculator
            ->expects($this->once())
            ->method('calculate')
            ->with(
                $this->isInstanceOf(PositionInterface::class),
                $this->isInstanceOf(PositionInterface::class)
            )
            ->willReturn($measurement);

        $measurement
            ->expects($this->once())
            ->method('convertTo')
            ->with($dimension)
            ->willReturnSelf();

        /** @noinspection PhpParamsInspection */
        $this->assertInstanceOf(
            Measurement::class,
            $converter->calculate(
                $this->createMock(PositionInterface::class),
                $this->createMock(PositionInterface::class)
            )
        );
    }
}
