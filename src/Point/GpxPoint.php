<?php

namespace MicheleBonacina\PhpGpxLib\Point;

/**
 * GPX Point.
 * This is the base point for other points type.
 * It can't be used standalone.
 */
abstract class GpxPoint
{

    public $latitude;       // point latitude
    public $longitude;      // point longitude
    public $altitude;       // point altitude

    /**
     * Creates a new point.
     *
     * @param $latitude point latitude
     * @param $longitude point longitude
     * @param $altitude point altitude
     */
    function __construct($latitude, $longitude, $altitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->altitude = $altitude;
    }
}
