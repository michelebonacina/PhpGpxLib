<?php

namespace MicheleBonacina\PhpGpxLib\Track;

/**
 * GPX Track segment.
 */
trait GpxTrackSegmentTrait
{

    /**
     * Calculates the total duration of the segment.
     * The total duration of the segment is the difference between the first and the last point of the segment.
     *
     * @return float duration in seconds
     */
    public function duration(): float
    {
        // calculate duration
        $trackPointList = $this->listTrackPoints();
        $duration = $trackPointList[sizeof($trackPointList) - 1]->getTime()->getTimestamp() - $trackPointList[0]->getTime()->getTimestamp();
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
        $trackPointList = $this->listTrackPoints();
        for ($i = 0; $i < sizeof($trackPointList) - 1; $i++) {
            if ($i > 0) {
                $drop = $trackPointList[$i - 1]->drop($trackPointList[$i]);
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
        $trackPointList = $this->listTrackPoints();
        for ($i = 0; $i < sizeof($trackPointList) - 1; $i++) {
            if ($i > 0) {
                $drop = $trackPointList[$i - 1]->drop($trackPointList[$i]);
                $totalDescent += $drop < 0 ? $drop : 0;
            }
        }
        // return total descent
        return round(-$totalDescent, 2);
    }
}
