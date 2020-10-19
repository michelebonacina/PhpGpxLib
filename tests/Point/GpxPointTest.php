<?php

declare(strict_types=1);

namespace MicheleBonacina\PhpGpxLib\Point;

use MicheleBonacina\PhpGpxLib\GpxFileUtility;
use PHPUnit\Framework\TestCase;

class GpxPointUtilityTest extends TestCase
{

    /**
     * Data provider for distance testing.
     *
     * @return array test case
     */
    public function distanceProvider(): array
    {
        // load data from file
        $fileUtility = new GpxFileUtility();
        $gpx = $fileUtility->loadTrackFromFile("C:\\Temp\\test.gpx");
        // get waypoint
        $waypoints = $gpx->listWaypoints();
        // get track points
        $trackPoints = $gpx->listTracks()[0]->listTrackSegments()[0]->listTrackPoints();
        // return test data
        return [
            [$waypoints[0], $waypoints[1], 3104.57],
            [$waypoints[0], $waypoints[2], 2310.64],
            [$waypoints[1], $waypoints[2], 4748.29],
            [$trackPoints[0], $trackPoints[sizeof($trackPoints) - 1], 3199.23]
        ];
    }

    /**
     * Test distance function.
     *
     * @dataProvider distanceProvider
     */
    public function testDistance(GpxPoint $point1, GpxPoint $point2, float $expected): void
    {
        $this->assertEquals($expected, $point1->distance($point2), "Wrong point distance");
    }

    /**
     * Data provider for ascent testing.
     *
     * @return array test case
     */
    public function ascentProvider(): array
    {
        // load data from file
        $fileUtility = new GpxFileUtility();
        $gpx = $fileUtility->loadTrackFromFile("C:\\Temp\\test.gpx");
        // get waypoint
        $waypoints = $gpx->listWaypoints();
        // get track points
        $trackPoints = $gpx->listTracks()[0]->listTrackSegments()[0]->listTrackPoints();
        // return test data
        return [
            [$waypoints[0], $waypoints[1], -477.7],
            [$waypoints[0], $waypoints[2], -55.6],
            [$waypoints[1], $waypoints[2], 422.1],
            [$trackPoints[0], $trackPoints[sizeof($trackPoints) - 1], 484.4]
        ];
    }

    /**
     * Test distance function.
     *
     * @dataProvider ascentProvider
     */
    public function testAscent(GpxPoint $point1, GpxPoint $point2, float $expected): void
    {
        $this->assertEquals($expected, $point1->ascent($point2), "Wrong point ascent");
    }

    /**
     * Data provider for percentage grade testing.
     *
     * @return array test case
     */
    public function percentageGradeProvider(): array
    {
        // load data from file
        $fileUtility = new GpxFileUtility();
        $gpx = $fileUtility->loadTrackFromFile("C:\\Temp\\test.gpx");
        // get waypoint
        $waypoints = $gpx->listWaypoints();
        // get track points
        $trackPoints = $gpx->listTracks()[0]->listTrackSegments()[0]->listTrackPoints();
        // return test data
        return [
            [$waypoints[0], $waypoints[1], -15.6],
            [$waypoints[0], $waypoints[2], -2.4],
            [$waypoints[1], $waypoints[2], 8.9],
            [$trackPoints[0], $trackPoints[sizeof($trackPoints) - 1], 15.3]
        ];
    }

    /**
     * Test percentage grade.
     *
     * @dataProvider percentageGradeProvider
     */
    public function testPercentageGrade(GpxPoint $point1, GpxPoint $point2, float $expected): void
    {
        $this->assertEquals($expected, $point1->percentageGrade($point2), "Wrong point percentage grade");
    }
}
