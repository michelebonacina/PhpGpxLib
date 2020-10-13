<?php

namespace MicheleBonacina\PhpGpxLib;

use MicheleBonacina\PhpGpxLib\Track\GpxTrack;
use MicheleBonacina\PhpGpxLib\Waypoint\GpxWaypoint;

/**
 * GPX File.
 */
class GpxFile
{

    private $waypoints = [];        // waypoints list
    private $tracks = [];           // tracks list

    /**
     * Creates a new gps track
     */
    public function __construct()
    {
    }

    /**
     * Add a new waypoint to the gps file.
     *
     * @param GpxWaypoint $waypoint new waypoint to add
     */
    public function addWaypoint(GpxWaypoint $waypoint): void
    {
        // add waypoint to list
        array_push($this->waypoints, $waypoint);
    }

    /**
     * Add a new track to the gpx file.
     *
     * @param GpxTrack $track new track to add
     */
    public function addTrack(GpxTrack $track): void
    {
        // add track to list
        array_push($this->tracks, $track);
    }

    /**
     * Returns waypoints list.
     *
     * @return array waypoints list
     */
    public function listWaypoints(): array
    {
        return $this->waypoints;
    }

    /**
     * Returns tracks list.
     *
     * @return array tracks list
     */
    public function listTracks(): array
    {
        return $this->tracks;
    }
}
