<?php

declare(strict_types=1);

namespace MicheleBonacina\PhpGpxLib\Point;

use MicheleBonacina\PhpGpxLib\GpxFileUtility;
use PHPUnit\Framework\TestCase;

class GpxPointUtilityTest extends TestCase
{

    /**
     * Test distance function.
     *
     * @dataProvider distanceProvider
     */
    public function testDistance(GpxPoint $point1, GpxPoint $point2): void
    {
        $pointUtility = new GpxPointUtility();
        var_dump($pointUtility->distance($point1, $point2));
        $this->assertTrue(TRUE);
    }

    /**
     * Data provider for distance test.
     *
     * @return array test case
     */
    public function distanceProvider(): array
    {
        // load data from file
        $fileUtility = new GpxFileUtility();
        $gpx = $fileUtility->loadTrackFromFile("C:\\Temp\\test2.gpx");
        // get waypoint
        $waypoints = $gpx->listWaypoints();
        // get track points
        $trackPoints = $gpx->listTracks()[0]->listTrackSegments()[0]->listTrackPoints();
        // return test data
        return [
            [$waypoints[0], $waypoints[1]],
            [$trackPoints[0], $trackPoints[sizeof($trackPoints) - 1]]
        ];
    }
}
