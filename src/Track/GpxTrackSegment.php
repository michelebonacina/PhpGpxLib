<?php

namespace MicheleBonacina\PhpGpxLib\Track;

/**
 * GPX Track segment.
 */
class GpxTrackSegment
{

    private $trackPoints = [];        // track points list

    /**
     * Creates a new gpx track segment.
     */
    function __construct()
    {
    }

    /**
     * Add a new track point to the track segment.
     *
     * @param GpxWaypoint $trackPointt track point to add
     */
    public function addTrackPoint(GpxTrackPoint $trackPoint)
    {
        // add track point to list
        array_push($this->trackPoints, $trackPoint);
    }

    /**
     * Returns track points list.
     *
     * @return track points list
     */
    public function listTrackPoints()
    {
        return $this->trackPoints;
    }
}
