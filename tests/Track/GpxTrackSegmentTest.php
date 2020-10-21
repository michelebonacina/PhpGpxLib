<?php

declare(strict_types=1);

namespace MicheleBonacina\PhpGpxLib\Track;

use MicheleBonacina\PhpGpxLib\GpxFileUtility;
use PHPUnit\Framework\TestCase;

class GpxTrackSegmentTest extends TestCase
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
        $track = $gpx->listTracks()[0];
        $segment = $track->listTrackSegments()[0];
        // return test data
        return [
            [$segment, 3278.0]
        ];
    }

    /**
     * Test distance function.
     *
     * @dataProvider durationProvider
     */
    public function testDuration(GpxTrackSegment $trackSegment, float $expected): void
    {
        $this->assertEquals($expected, $trackSegment->duration(), "Wrong segment duration");
    }

    /**
     * Data provider for testing total ascent.
     *
     * @return array test case
     */
    public function totalAscentProvider(): array
    {
        // load data from file
        $fileUtility = new GpxFileUtility();
        $gpx = $fileUtility->loadTrackFromFile("C:\\Temp\\test.gpx");
        // get track points
        $track = $gpx->listTracks()[0];
        $segment = $track->listTrackSegments()[0];
        // return test data
        return [
            [$segment, 561.4]
        ];
    }

    /**
     * Test distance function.
     *
     * @dataProvider totalAscentProvider
     */
    public function testTotalAscent(GpxTrackSegment $trackSegment, float $expected): void
    {
        $this->assertEquals($expected, $trackSegment->totalAscent(), "Wrong segment total ascent");
    }

    /**
     * Data provider for testing total descnt.
     *
     * @return array test case
     */
    public function totalDescentProvider(): array
    {
        // load data from file
        $fileUtility = new GpxFileUtility();
        $gpx = $fileUtility->loadTrackFromFile("C:\\Temp\\test.gpx");
        // get track points
        $track = $gpx->listTracks()[0];
        $segment = $track->listTrackSegments()[0];
        // return test data
        return [
            [$segment, 77.2]
        ];
    }

    /**
     * Test total descent function.
     *
     * @dataProvider totalDescentProvider
     */
    public function testTotalDescent(GpxTrackSegment $trackSegment, float $expected): void
    {
        $this->assertEquals($expected, $trackSegment->totalDescent(), "Wrong segment total descent");
    }
}
