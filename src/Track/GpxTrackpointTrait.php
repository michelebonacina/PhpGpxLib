<?php

namespace MicheleBonacina\PhpGpxLib\Track;

use MicheleBonacina\PhpGpxLib\Point\GpxPointTrait;

/**
 * GPX Track point.
 */
trait GpxTrackPointTrait
{

    use GpxPointTrait;

    /**
     * Calculates the duration between this point and another given one.
     * The duration is the time difference between two points in seconds.
     *
     * @param $point other point
     * @return float duration in seconds
     */
    public function duration($point): float
    {
        // calculate duration
        $duration = abs($point->getTime()->getTimestamp() - $this->getTime()->getTimestamp());
        // return duration
        return $duration;
    }

    /**
     * Calculates the difference between the temperature with another give point.
     * The delta is calculated between the other and this point.
     * If the delta is greater than zero the temperature increases, otherwise decreases.
     *
     * @param $point other point
     * @return float temperature difference
     */
    public function deltaTemperature($point): float
    {
        // calculate the delta temperature
        $delta = $point->getTemperature() - $this->getTemperature();
        // return delta
        return $delta;
    }
}
