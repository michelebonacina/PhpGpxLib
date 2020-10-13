<?php

namespace MicheleBonacina\PhpGpxLib\Track;

use MicheleBonacina\PhpGpxLib\Point\GpxPoint;

/**
 * GPX Track point.
 */
class GpxTrackPoint extends GpxPoint
{

    private $timestamp;      // trackpoint timestamp
    private $heartRate;      // trackpoint heart rate
    private $cadence;        // trackpoint cadence
    private $temperature;    // trackpoint temperature

    /**
     * Creates a new trackpoint.
     *
     * @param float $latitude track point latitude
     * @param float $longitude track point longitude
     * @param float $altitude track point altitude
     * @param string $timestamp track point timestamp
     * @param int $heartRate track point heart rate
     * @param int $cadence track point cadence
     * @param float $temperature track point temperature
     */
    function __construct(float $latitude, float $longitude, float $altitude, string $timestamp, int $heartRate, int $cadence, float $temperature)
    {
        parent::__construct($latitude, $longitude, $altitude);
        $this->timestamp = $timestamp;
        $this->heartRate = $heartRate;
        $this->cadence = $cadence;
        $this->temperature = $temperature;
    }

    /**
     * Returns track point timestamp.
     *
     * @return string timestamp
     */
    public function getTimestamp(): string
    {
        // TODO change timestamp type
        return $this->timestamp;
    }

    /**
     * Returns track point heart rate.
     *
     * @return int heart rate
     */
    public function getHeartRate(): int
    {
        return $this->heartRate;
    }

    /**
     * Returns track cadence.
     *
     * @return int cadence
     */
    public function getCadence(): int
    {
        return $this->cadence;
    }

    /**
     * Returns track point temperature.
     *
     * @return float temperature
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }
}
