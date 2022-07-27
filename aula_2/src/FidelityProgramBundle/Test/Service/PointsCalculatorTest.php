<?php

namespace FidelityProgramBundle\Test\Service;

use FidelityProgramBundle\Service\PointsCalculator;
use PHPUnit\Framework\TestCase;

class PointsCalculatorTest extends TestCase
{
    /**
     * @dataProvider valueDataProvider
     * @param $value
     * @param $expectedPoints
     * @return void
     */
    public function testPointsToReceive($value, $expectedPoints)
    {
        $pointsCalculator = new PointsCalculator();

        $points = $pointsCalculator->calculatePointsToReceive($value);

        $this->assertEquals($expectedPoints, $points);
    }

    /**
     * @return int[][]
     */
    public function valueDataProvider(): array
    {
        return [
            [30, 0],
            [55, 1100],
            [75, 2250],
            [105, 5250],
        ];
    }
}
