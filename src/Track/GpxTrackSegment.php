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
        $duration = $this->trackPoints[sizeof($this->trackPoints) - 1]->getTimestamp()->getTimestamp() - $this->trackPoints[0]->getTimestamp()->getTimestamp();
        // return duration
        return $duration;
    }

    /**
     * Calculates the total ascent of the segment.
     * The total ascent is the sum of the drop between each point and its next point only if
     * this drop is greater than zero.
     *
     * @return float total ascent
     */
    public function totalAscent(): float
    {
        // calculate total ascent
        $totalAscent = 0;
        for ($i = 0; $i < sizeof($this->trackPoints) - 1; $i++) {
            if ($i > 0) {
                $drop = $this->trackPoints[$i - 1]->drop($this->trackPoints[$i]);
                $totalAscent += $drop > 0 ? $drop : 0;
            }
        }
        // return total ascent
        return round($totalAscent, 2);
    }

    /**
     * Calculates the total descent of the segment.
     * The total descent is the sum of the drop between each point and its next point only if
     * this drop is lower than zero.
     *
     * @return float total descent
     */
    public function totalDescent(): float
    {
        // calculate total descent
        $totalDescent = 0;
        for ($i = 0; $i < sizeof($this->trackPoints) - 1; $i++) {
            if ($i > 0) {
                $drop = $this->trackPoints[$i - 1]->drop($this->trackPoints[$i]);
                $totalDescent += $drop < 0 ? $drop : 0;
            }
        }
        // return total descent
        return round(-$totalDescent, 2);
    }
}
