<?php

namespace MicheleBonacina\PhpGpxLib\Track;

/**
 * GPX Track.
 */
class GpxTrack implements GpxTrackTraitNeeds
{

    use GpxTrackTrait;

    private $name;                  // track name
    private $type;                  // track type
    private $trackSegments = [];    // track segments list

    /**
     * Creates a new gpx track.
     *
     * @param string $name track name
     * @param string $type track type
     */
    public function __construct(string $name, string $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * Returns track name.
     *
     * @return string name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns track type.
     *
     * @return string type
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Add a new segment to the track.
     *
     * @param GpxTrackSegment $trackSegment track segment to add
     */
    public function addTrackSegment(GpxTrackSegment $trackSegment): void
    {
        // add track segment to list
        array_push($this->trackSegments, $trackSegment);
    }

    /**
     * Returns segments list.
     *
     * @return array segments list
     */
    public function listTrackSegments(): array
    {
        return $this->trackSegments;
    }
}
