<?php

namespace MicheleBonacina\PhpGpxLib\Waypoint;

use MicheleBonacina\PhpGpxLib\Point\GpxPoint;

/**
 * GPX Waypoint.
 */
class GpxWaypoint extends GpxPoint
{

    private $name;      // waypoint name
    private $symbol;    // waypoint symbol

    /**
     * Creates a new waypoint.
     *
     * @param $latitude waypoint latitude
     * @param $longitude waypoint longitude
     * @param $altitude waypoint altitude
     * @param $name waypoint name
     * @param $symbol waypoint symbol path
     */
    function __construct($latitude, $longitude, $altitude, $name, $symbol)
    {
        parent::__construct($latitude, $longitude, $altitude);
        $this->name = $name;
        $this->symbol = $symbol;
    }

    /**
     * Returns waypoint name.
     *
     * @return string name
     */
    public function getName(): string
    {
        return $this->name;
    }
}
