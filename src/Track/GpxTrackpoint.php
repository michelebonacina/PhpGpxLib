<?php

namespace MicheleBonacina\PhpGpxLib\Track;

use DateTime;
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
     * @param DateTime $timestamp track point timestamp
     * @param int $heartRate track point heart rate
     * @param int $cadence track point cadence
     * @param float $temperature track point temperature
     */
    function __construct(float $latitude, float $longitude, float $altitude, DateTime $timestamp, int $heartRate, int $cadence, float $temperature)
    {
        parent::__construct($latitude, $longitude, $altitude);
        $this->timestamp = $timestamp;
        $this->heartRate = $heartRate;
        $this->cadence = $cadence;
        $this->temperature = round($temperature, 1);
    }

    /**
     * Returns track point timestamp.
     *
     * @return DateTime timestamp
     */
    public function getTimestamp(): DateTime
    {
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


    /**
     * Calculates the duration between this point and another given one.
     * The duration is the time difference between two points in seconds.
     *
     * @param GpxPoint $point other point
     * @return float duration in seconds
     */
    public function duration(GpxTrackPoint $point): float
    {
        // calculate duration
        $duration = abs($point->getTimestamp()->getTimestamp() - $this->getTimestamp()->getTimestamp());
        // return duration
        return $duration;
    }

    /**
     * Calculates the difference between the temperature with another give point.
     * The delta is calculated between the other and this point.
     * If the delta is greater than zero the temperature increases, otherwise decreases.
     *
     * @param GpxPoint $point other point
     * @return float temperature difference
     */
    public function deltaTemperature(GpxTrackPoint $point): float
    {
        // calculate the delta temperature
        $delta = $point->getTemperature() - $this->getTemperature();
        // return delta
        return $delta;
    }
}
