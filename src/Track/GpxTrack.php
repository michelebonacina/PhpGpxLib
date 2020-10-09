<?php

namespace MicheleBonacina\PhpGpxLib\Track;

use MicheleBonacina\PhpGpxLib\Waypoint\GpxWaypoint;

/**
 * GPX Track.
 */
class GpxTrack
{

    private $waypoints = [];        // waypoints list

    /**
     * Creates a new gps track
     */
    public function __construct()
    {
    }

    /**
     * Add a new waypoint to the waypoints list.
     *
     * @param GpxWaypoint $waypoint waypoint to add
     */
    public function addWaypoint(GpxWaypoint $waypoint)
    {
        // add waypoint to list
        array_push($this->waypoints, $waypoint);
    }

    /**
     * Returns waypoints list.
     *
     * @return waypoints list
     */
    public function listWaypoints()
    {
        return $this->waypoints;
    }
}
