<?php

namespace MicheleBonacina\PhpGpxLib\Point;

/**
 * Utility for Point management.
 */
class GpxPointUtility
{

    const EARTH_RADIUS = 6371000;   // earth radius in meters

    /**
     * Calculates the distance in meters between two points.
     * The distance consider geodetic distance, calculated using points latitue
     * and longitude coordinates, and altitude difference (ascent).
     * Distance is always returned as an absolute value.
     *
     * @param GpxPoint $point1 first point
     * @param GpxPoint $point2 second point
     * @return float distance in meters
     */
    public function distance(GpxPoint $point1, GpxPoint $point2): float
    {
        // convert from degreese to radiant
        $radLatitude1 = deg2rad($point1->getLatitude());
        $radLongitude1 = deg2rad($point1->getLongitude());
        $radLatitude2 = deg2rad($point2->getLatitude());
        $radLongitude2 = deg2rad($point2->getLongitude());
        // calculate angle between the points
        $angle = abs($radLongitude1 - $radLongitude2);
        // calculate arc length
        $arc = acos(sin($radLatitude2) * sin($radLatitude1) +
            cos($radLatitude2) * cos($radLatitude1) * cos($angle));
        // calculate geodetic distance
        $geodeticDistance = $arc * GpxPointUtility::EARTH_RADIUS;
        // calculate distance
        $distance = sqrt(pow($geodeticDistance, 2) + pow($this->ascent($point1, $point2), 2));
        // return disance
        return $distance;
    }

    /**
     * Calculates the ascent in meters between two points.
     * The ascent is the difference between the second point altitude and
     * the first point altitude. If greater then zero, the second point is
     * higher than first, the opposite if lower then zero.
     *
     * @param GpxPoint $point1 first point
     * @param GpxPoint $point2 second point
     * @return float ascent in meters
     */
    public function ascent(GpxPoint $point1, GpxPoint $point2): float
    {
        // calculate ascent
        $ascent = $point2->getAltitude() - $point1->getAltitude();
        // return ascent
        return $ascent;
    }

    /**
     * Calculates the perncentage grade between two points.
     * When horizontal and vertical distance between two points are the same
     * the inclination is 45 degrees and the percentage grade is 100%.
     * If greater then zero, the second point is higher than first, the opposite
     * if lower then zero.
     *
     * @param GpxPoint $point1 first point
     * @param GpxPoint $point2 second point
     * @return float percentage grade
     */
    public function percentageGrade(GpxPoint $point1, GpxPoint $point2): float
    {
        // calculate ascent
        $rise = $this->ascent($point1, $point2);
        $run = sqrt(pow($this->distance($point1, $point2), 2) - pow($rise, 2));
        $ascent = $rise / $run * 100;
        // return ascent
        return $ascent;
    }
}
