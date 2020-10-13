<?php

declare(strict_types=1);

namespace MicheleBonacina\PhpGpxLib;

class GpxFileUtilityTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test loadTrackFromFile function.
     */
    public function testLoadTrackFromFile()
    {
        $utility = new GpxFileUtility();
        $gpx = $utility->loadTrackFromFile("C:\\Temp\\test2.gpx");
        // test waypoints
        $this->assertTrue(sizeof($gpx->listWaypoints()) == 2);
        // test tracks
        $track = $gpx->listTracks()[0];
        $this->assertEquals("Gironzo", $track->getName(), "Wrong track name");
        $this->assertEquals("road_biking", $track->getType(), "Wrong track type");
        $this->assertTrue(sizeof($track->listTrackSegments()[0]->listTrackPoints()) == 207, "Wrong track points count");
    }
}
