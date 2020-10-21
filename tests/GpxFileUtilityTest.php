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
        $gpx = $fileUtility->loadTrackFromFile("C:\\Temp\\test.gpx");
        // test waypoints
        $this->assertEquals(3, sizeof($gpx->listWaypoints()), "Wrong waypoints count");
        // test tracks
        $track = $gpx->listTracks()[0];
        $this->assertEquals("Colle Gallo", $track->getName(), "Wrong track name");
        $this->assertEquals("road_biking", $track->getType(), "Wrong track type");
        $pointsCount = sizeof($track->listTrackSegments()[0]->listTrackPoints());
        $this->assertEquals(3234, $pointsCount, "Wrong track points count");
    }
}
