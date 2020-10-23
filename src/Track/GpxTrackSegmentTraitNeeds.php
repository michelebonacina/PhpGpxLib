<?php

namespace MicheleBonacina\PhpGpxLib\Track;

/**
 * GPX Track segment.
 */
interface GpxTrackSegmentTraitNeeds
{

    /**
     * Returns track points list.
     *
     * @return array track points list
     */
    public function listTrackPoints(): array;
}
