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
    public function addTrackPoint(GpxTrackPoint $trackPoint): void
    {
        // add track point to list
        array_push($this->trackPoints, $trackPoint);
    }

    /**
     * Returns track points list.
     *
     * @return array track points list
     */
    public function listTrackPoints(): array
    {
        return $this->trackPoints;
    }

    /**
     * Calculates the total duration of the segment.
     * The total duration of the segment is the difference between the first and the last point of the segment.
     *
     * @return float duration in seconds
     */
    public function duration(): float
    {
        // calculate duration
        $duration = $this->trackPoints[sizeof($this->trackPoints)-1]->getTimestamp()->getTimestamp() - $this->trackPoints[0]->getTimestamp()->getTimestamp();
        // return duration
        return $duration;
    }
}
