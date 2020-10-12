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
        $this->assertTrue(sizeof($gpx->listWaypoints()) == 2);
    }
}
