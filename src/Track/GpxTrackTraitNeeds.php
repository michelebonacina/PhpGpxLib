<?php

namespace MicheleBonacina\PhpGpxLib\Track;

/**
 * GPX Track.
 */
interface GpxTrackTraitNeeds
{

    /**
     * Returns segments list.
     *
     * @return array segments list
     */
    public function listTrackSegments(): array;
}
