<?php

declare(strict_types=1);

namespace MicheleBonacina\PhpGpxLib;

use PHPUnit\Framework\TestCase;

class GpxFileUtilityTest extends TestCase
{

    /**
     * Test loadTrackFromFile function.
     */
    public function testLoadTrackFromFile()
    {
        // load data from file
        $fileUtility = new GpxFileUtility();
        $gpx = $fileUtility->loadTrackFromFile("C:\\Temp\\test2.gpx");
        // test waypoints
        $this->assertTrue(sizeof($gpx->listWaypoints()) == 2);
        // test tracks
        $track = $gpx->listTracks()[0];
        $this->assertEquals("Gironzo", $track->getName(), "Wrong track name");
        $this->assertEquals("road_biking", $track->getType(), "Wrong track type");
        $pointsCount = sizeof($track->listTrackSegments()[0]->listTrackPoints());
        $this->assertTrue($pointsCount == 207, "Wrong track points count");
    }
}
