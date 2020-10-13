<?php

namespace MicheleBonacina\PhpGpxLib\Track;

use MicheleBonacina\PhpGpxLib\Point\GpxPointUtility;

/**
 * Utility for Waypoint management.
 */
class GpxTrackUtility extends GpxPointUtility
{

    /**
     * Calculates the duration between two points.
     * The duration is the time difference between two points in seconds.
     *
     * @param GpxPoint $point1 first point
     * @param GpxPoint $point2 second point
     * @return float duration in seconds
     */
    public function duration(GpxTrackPoint $point1, GpxTrackPoint $point2): float
    {
        // calculate duration
        $duration = $point2->getTimestamp()->getTimestamp() - $point1->getTimestamp()->getTimestamp();
        // return duration
        return $duration;
    }

    /**
     * Calculates the difference between the temperature of two points.
     * The delta is calculated between the second and the first point.
     * If the delta i greater than zero the temperature increases,
     * otherwise decreases.
     *
     * @param GpxPoint $point1 first point
     * @param GpxPoint $point2 second point
     * @return float temperature difference
     */
    public function deltaTemperature(GpxTrackPoint $point1, GpxTrackPoint $point2): float
    {
        // calculate the delta temperature
        $delta = $point2->getTemperature() - $point1->getTemperature();
        // return delta
        return $delta;
    }
}
