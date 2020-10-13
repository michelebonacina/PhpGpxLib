<?php

namespace MicheleBonacina\PhpGpxLib\Track;

use MicheleBonacina\PhpGpxLib\Waypoint\GpxWaypoint;

/**
 * GPX Track.
 */
class GpxTrack
{

    private $name;                  // track name
    private $trackSegments = [];    // track segments list

    /**
     * Creates a new gpx track.
     *
     * @param string $name track name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Returns track name.
     *
     * @return string name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Add a new segment to the track.
     *
     * @param GpxTrackSegment $trackSegment track segment to add
     */
    public function addTrackSegment(GpxTrackSegment $trackSegment): void
    {
        // add track segment to list
        array_push($this->trackSegments, $trackSegment);
    }

    /**
     * Returns segments list.
     *
     * @return segments list
     */
    public function listTrackSegments(): array
    {
        return $this->trackSegments;
    }
}
