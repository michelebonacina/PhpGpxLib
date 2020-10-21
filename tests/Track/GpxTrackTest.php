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
}
