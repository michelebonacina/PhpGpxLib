<?php

namespace MicheleBonacina\PhpGpxLib\Track;

use MicheleBonacina\PhpGpxLib\Waypoint\GpxWaypoint;

/**
 * GPX Track.
 */
class GpxTrack
{

    private $name;                  // track name
    private $type;                  // track type
    private $trackSegments = [];    // track segments list

    /**
     * Creates a new gpx track.
     *
     * @param string $name track name
     * @param string $type track type
     */
    public function __construct(string $name, string $type)
    {
        $this->name = $name;
        $this->type = $type;
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
     * Returns track type.
     *
     * @return string type
     */
    public function getType(): string
    {
        return $this->type;
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
     * @return array segments list
     */
    public function listTrackSegments(): array
    {
        return $this->trackSegments;
    }

    /**
     * Calculates the total duration of the track.
     * The total duration of the track is the sum of the duration of every single segment.
     *
     * @return float duration in seconds
     */
    public function duration(): float
    {
        // calculate duration
        $duration = 0;
        foreach($this->trackSegments as $segment)
        {
            $duration += $segment->duration();
        }
        // return duration
        return $duration;
    }

    /**
     * Calculates the total ascent of the track.
     * The track total ascent is the sum of the total ascent of every single segment.
     *
     * @return float total ascent
     */
    public function totalAscent(): float
    {
        // calculate total ascent
        $totalAscent = 0;
        foreach ($this->trackSegments as $trackSegment) {
            $totalAscent += $trackSegment->totalAscent();
        }
        // return total ascent
        return round($totalAscent, 2);
    }

    /**
     * Calculates the total descent of the track.
     * The track total descent is the sum of the total descent of every single segment.
     *
     * @return float total descent
     */
    public function totalDescent(): float
    {
        // calculate total descent
        $totalDescent = 0;
        foreach ($this->trackSegments as $trackSegment) {
            $totalDescent += $trackSegment->totalDescent();
        }
        // return total descent
        return round($totalDescent, 2);
    }
}
