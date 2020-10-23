<?php

namespace MicheleBonacina\PhpGpxLib\Track;

use DateTime;
use MicheleBonacina\PhpGpxLib\Point\GpxPoint;

/**
 * GPX Track point.
 */
class GpxTrackPoint extends GpxPoint implements GpxTrackPointTraitNeeds
{

    use GpxTrackPointTrait;

    private $time;           // trackpoint time
    private $heartRate;      // trackpoint heart rate
    private $cadence;        // trackpoint cadence
    private $temperature;    // trackpoint temperature

    /**
     * Creates a new trackpoint.
     *
     * @param float $latitude track point latitude
     * @param float $longitude track point longitude
     * @param float $altitude track point altitude
     * @param DateTime $time track point time
     * @param int $heartRate track point heart rate
     * @param int $cadence track point cadence
     * @param float $temperature track point temperature
     */
    function __construct(float $latitude, float $longitude, float $altitude, DateTime $time, int $heartRate, int $cadence, float $temperature)
    {
        parent::__construct($latitude, $longitude, $altitude);
        $this->time = $time;
        $this->heartRate = $heartRate;
        $this->cadence = $cadence;
        $this->temperature = round($temperature, 1);
    }

    /**
     * Returns track point time.
     *
     * @return DateTime time
     */
    public function getTime(): DateTime
    {
        return $this->time;
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
