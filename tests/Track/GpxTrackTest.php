<?php

declare(strict_types=1);

namespace MicheleBonacina\PhpGpxLib\Track;

use MicheleBonacina\PhpGpxLib\GpxFileUtility;
use PHPUnit\Framework\TestCase;

class GpxTrackTest extends TestCase
{

    /**
     * Data provider for testing duration.
     *
     * @return array test case
     */
    public function totalDurationProvider(): array
    {
        // load data from file
        $fileUtility = new GpxFileUtility();
        $gpx = $fileUtility->loadTrackFromFile("C:\\Temp\\test.gpx");
        // get track points
        $track = $gpx->listTracks()[0];
        // return test data
        return [
            [$track, 3278.0]
        ];
    }

    /**
     * Test distance function.
     *
     * @dataProvider totalDurationProvider
     */
    public function testTotalDuration(GpxTrack $track, float $expected): void
    {
        $this->assertEquals($expected, $track->duration(), "Wrong track duration");
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
        // return test data
        return [
            [$track, 561.4]
        ];
    }

    /**
     * Test distance function.
     *
     * @dataProvider totalAscentProvider
     */
    public function testTotalAscent(GpxTrack $track, float $expected): void
    {
        $this->assertEquals($expected, $track->totalAscent(), "Wrong track total ascent");
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
        // return test data
        return [
            [$track, 77.2]
        ];
    }

    /**
     * Test total descent function.
     *
     * @dataProvider totalDescentProvider
     */
    public function testTotalDescent(GpxTrack $track, float $expected): void
    {
        $this->assertEquals($expected, $track->totalDescent(), "Wrong track total descent");
    }
}
