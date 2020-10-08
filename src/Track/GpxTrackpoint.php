<?php

namespace MicheleBonacina\PhpGpxLib\Trackpoint;

use MicheleBonacina\PhpGpxLib\Point\GpxPoint;

/**
 * GPX Trackpoint.
 */
class GpxTrackpoint extends GpxPoint
{

    public $timestamp;      // trackpoint timestamp
    public $heartRate;      // trackpoint heart rate
    public $cadence;        // trackpoint cadence

    /**
     * Creates a new trackpoint.
     *
     * @param $latitude waypoint latitude
     * @param $longitude waypoint longitude
     * @param $altitude waypoint altitude
     * @param $timestamp waypoint timestamp
     * @param $heartRate waypoint heart rate
     * @param $cadence waypoint cadence
     */
    function __construct($latitude, $longitude, $altitude, $timestamp, $heartRate, $cadence)
    {
        parent::__construct($latitude, $longitude, $altitude);
        $this->timestamp = $timestamp;
        $this->heartRate = $heartRate;
        $this->cadence = $cadence;
    }
}
