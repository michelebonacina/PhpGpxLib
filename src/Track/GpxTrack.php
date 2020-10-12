<?php

namespace MicheleBonacina\PhpGpxLib\Track;

use MicheleBonacina\PhpGpxLib\Waypoint\GpxWaypoint;

/**
 * GPX Track.
 */
class GpxTrack
{

    private $trackSegments = [];    // track segments list

    /**
     * Creates a new gpx track.
     */
    public function __construct()
    {
    }

    /**
     * Add a new segment to the track.
     *
     * @param GpxTrackSegment $trackSegment track segment to add
     */
    public function addTrackSegment(GpxTrackSegment $trackSegment)
    {
        // add track segment to list
        array_push($this->trackSegments, $trackSegment);
    }

    /**
     * Returns segments list.
     *
     * @return segments list
     */
    public function listTrackSegments()
    {
        return $this->trackSegments;
    }
}
