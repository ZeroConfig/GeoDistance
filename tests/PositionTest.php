<?php

namespace ZeroConfig\GeoDistance\Tests;

use Measurements\Quantities\Angle;
use ZeroConfig\GeoDistance\Position;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \ZeroConfig\GeoDistance\Position
 */
class PositionTest extends TestCase
{
    /**
     * @return Position
     * @covers ::create
     * @covers ::__construct
     */
    public function testCreate(): Position
    {
        $position = Position::create(50.0, 5.0);

        $this->assertInstanceOf(Position::class, $position);

        return $position;
    }

    /**
     * @depends testCreate
     *
     * @param Position $position
     *
     * @return void
     * @covers ::getLatitude
     */
    public function testGetLatitude(Position $position)
    {
        $this->assertInstanceOf(Angle::class, $position->getLatitude());
    }

    /**
     * @depends testCreate
     *
     * @param Position $position
     *
     * @return void
     * @covers ::getLongitude
     */
    public function testGetLongitude(Position $position)
    {
        $this->assertInstanceOf(Angle::class, $position->getLongitude());
    }
}
