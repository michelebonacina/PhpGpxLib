<?php

namespace MicheleBonacina\PhpGpxLib\Point;

/**
 * GPX Point.
 * This is the base point for other points type.
 * It can't be used standalone.
 */
interface GpxPointTraitNeeds
{

    /**
     * Returns point latitude.
     *
     * @return float latitude
     */
    public function getLatitude(): float;

    /**
     * Returns point longitude.
     *
     * @return float longitude
     */
    public function getLongitude(): float;

    /**
     * Returns point altitude.
     *
     * @return float altitude
     */
    public function getAltitude(): float;
}
