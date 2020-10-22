<?php

namespace MicheleBonacina\PhpGpxLib\Point;

/**
 * GPX Point.
 * This is the base point for other points type.
 * It can't be used standalone.
 */
abstract class GpxPoint
{

    use GpxPointTrait;

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
}
