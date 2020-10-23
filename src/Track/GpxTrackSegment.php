<?php

namespace MicheleBonacina\PhpGpxLib\Track;

/**
 * GPX Track segment.
 */
class GpxTrackSegment implements GpxTrackSegmentTraitNeeds
{

    use GpxTrackSegmentTrait;

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
}
