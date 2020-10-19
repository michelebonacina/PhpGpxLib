<?php

declare(strict_types=1);

namespace MicheleBonacina\PhpGpxLib\Track;

use MicheleBonacina\PhpGpxLib\GpxFileUtility;
use PHPUnit\Framework\TestCase;

class GpxTrackPointTest extends TestCase
{

    /**
     * Data provider for testing duration.
     *
     * @return array test case
     */
    public function durationProvider(): array
    {
        // load data from file
        $fileUtility = new GpxFileUtility();
        $gpx = $fileUtility->loadTrackFromFile("C:\\Temp\\test.gpx");
        // get track points
        $trackPoints = $gpx->listTracks()[0]->listTrackSegments()[0]->listTrackPoints();
        // return test data
        return [
            [$trackPoints[0], $trackPoints[sizeof($trackPoints) - 1], 3278.0]
        ];
    }

    /**
     * Test distance function.
     *
     * @dataProvider durationProvider
     */
    public function testDuration(GpxTrackPoint $point1, GpxTrackPoint $point2, float $expected): void
    {
        $this->assertEquals($expected, $point1->duration($point2), "Wrong point duration");
    }

    /**
     * Data provider for testing delta temperature.
     *
     * @return array test case
     */
    public function deltaTemperatureProvider(): array
    {
        // load data from file
        $fileUtility = new GpxFileUtility();
        $gpx = $fileUtility->loadTrackFromFile("C:\\Temp\\test.gpx");
        // get track points
        $trackPoints = $gpx->listTracks()[0]->listTrackSegments()[0]->listTrackPoints();
        // return test data
        return [
            [$trackPoints[0], $trackPoints[sizeof($trackPoints) - 1], 2.0]
        ];
    }

    /**
     * Test distance function.
     *
     * @dataProvider deltaTemperatureProvider
     */
    public function testDeltaTemperature(GpxTrackPoint $point1, GpxTrackPoint $point2, float $expected): void
    {
        $this->assertEquals($expected, $point1->deltaTemperature($point2), "Wrong delta temperature");
    }
}
