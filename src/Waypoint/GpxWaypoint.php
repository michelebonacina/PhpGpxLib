<?php

namespace MicheleBonacina\PhpGpxLib\Waypoint;

use MicheleBonacina\PhpGpxLib\Point\GpxPoint;

/**
 * GPX Waypoint.
 */
class GpxWaypoint extends GpxPoint
{

    public $name;       // waypoint name

    /**
     * Creates a new waypoint.
     *
     * @param $latitude waypoint latitude
     * @param $longitude waypoint longitude
     * @param $altitude waypoint altitude
     * @param $name waypoint name
     */
    function __construct($latitude, $longitude, $altitude, $name)
    {
        parent::__construct($latitude, $longitude, $altitude);
        $this->name = $name;
    }
}
