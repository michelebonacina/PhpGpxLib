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
     * @param float $latitude waypoint latitude
     * @param float $longitude waypoint longitude
     * @param float $altitude waypoint altitude
     * @param string $name waypoint name
     * @param string $symbol waypoint symbol path
     */
    function __construct(float $latitude, float $longitude, float $altitude, string $name, string $symbol)
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

    /**
     * Returns waypoint symbol.
     *
     * @return string symbol
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }
}
