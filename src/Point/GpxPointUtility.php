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
     *
     * @param GpxPoint $point1 forst point
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
        $distance = sqrt(pow($geodeticDistance, 2) + pow($point1->getAltitude() - $point2->getAltitude(), 2));
        // return disance
        return $distance;
    }
}
