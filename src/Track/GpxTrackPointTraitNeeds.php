<?php

namespace MicheleBonacina\PhpGpxLib\Track;

use DateTime;
use MicheleBonacina\PhpGpxLib\Point\GpxPointTraitNeeds;

/**
 * GPX Track point.
 */
interface GpxTrackPointTraitNeeds extends GpxPointTraitNeeds
{

    /**
     * Returns track point time.
     *
     * @return DateTime time
     */
    public function getTime(): DateTime;

    /**
     * Returns track point temperature.
     *
     * @return float temperature
     */
    public function getTemperature(): float;
}
