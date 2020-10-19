<?php

namespace MicheleBonacina\PhpGpxLib\Point;

/**
 * GPX Point.
 * This is the base point for other points type.
 * It can't be used standalone.
 */
abstract class GpxPoint
{

    const EARTH_RADIUS = 6371000;   // earth radius in meters

    private $latitude;      // point latitude
    private $longitude;     // point longitude
    private $altitude;      // point altitude

    /**
     * Creates a new point.
     *
     * @param float $latitude point latitude
     * @param float $longitude point longitude
     * @param float $altitude point altitude
     */
    public function __construct(float $latitude, float $longitude, float $altitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->altitude = round($altitude, 1);
    }

    /**
     * Returns point latitude.
     *
     * @return float latitude
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * Returns point longitude.
     *
     * @return float longitude
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * Returns point altitude.
     *
     * @return float altitude
     */
    public function getAltitude(): float
    {
        return $this->altitude;
    }

    /**
     * Calculates the distance in meters from this point to another given one.
     * The distance consider geodetic distance, calculated using points latitue
     * and longitude coordinates, and altitude difference (ascent).
     * Distance is always returned as an absolute value.
     *
     * @param GpxPoint $point the other point
     * @return float distance in meters
     */
    public function distance(GpxPoint $point): float
    {
        // convert from degreese to radiant
        $radLatitude1 = deg2rad($this->getLatitude());
        $radLongitude1 = deg2rad($this->getLongitude());
        $radLatitude2 = deg2rad($point->getLatitude());
        $radLongitude2 = deg2rad($point->getLongitude());
        // calculate angle between the points
        $angle = abs($radLongitude2 - $radLongitude1);
        // calculate arc length
        $arc = acos(sin($radLatitude2) * sin($radLatitude1) +
            cos($radLatitude2) * cos($radLatitude1) * cos($angle));
        // calculate geodetic distance
        $geodeticDistance = $arc * GpxPoint::EARTH_RADIUS;
        // calculate distance
        $distance = round(sqrt(pow($geodeticDistance, 2) + pow($this->ascent($point), 2)), 2);
        // return disance
        return $distance;
    }

    /**
     * Calculates the ascent in meters between this point and anothergiven one.
     * The ascent is the difference between the other point altitude and
     * the this point altitude. If greater then zero, the other point is
     * higher than this one, the opposite if lower then zero.
     *
     * @param GpxPoint $point the other point
     * @return float ascent in meters
     */
    public function ascent(GpxPoint $point): float
    {
        // calculate ascent
        $ascent = round($point->getAltitude() - $this->getAltitude(), 1);
        // return ascent
        return $ascent;
    }

    /**
     * Calculates the perncentage grade between this point and another given one.
     * When horizontal and vertical distance between two points are the same
     * the inclination is 45 degrees and the percentage grade is 100%.
     * If greater then zero, the other point is higher than this one, the opposite
     * if lower then zero.
     *
     * @param GpxPoint $point1 first point
     * @param GpxPoint $point2 second point
     * @return float percentage grade
     */
    public function percentageGrade(GpxPoint $point): float
    {
        // calculate ascent
        $rise = $this->ascent($point);
        $run = sqrt(pow($this->distance($point), 2) - pow($rise, 2));
        $ascent = round($rise / $run * 100, 1);
        // return ascent
        return $ascent;
    }

}
