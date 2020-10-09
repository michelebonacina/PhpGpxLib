<?php

namespace MicheleBonacina\PhpGpxLib\Track;

use Exception;
use MicheleBonacina\PhpGpxLib\Point\GpxPointUtility;
use MicheleBonacina\PhpGpxLib\Waypoint\GpxWaypoint;

/**
 * Utility for Waypoint management.
 */
class GpxTrackUtility extends GpxPointUtility
{

    /**
     * Load a track from a gpx file.
     *
     * @param [string] $trackFilePath full track file path
     * @return GpxTrack loaded track
     */
    public function loadTrackFromFile(string $trackFilePath): GpxTrack
    {
        if (!file_exists($trackFilePath)) {
            // file not found
            throw new Exception("GPX File not founded");
        }
        // create new track
        $gpxTrack = new GpxTrack();
        // load gpx xml file
        $gpxXml = simplexml_load_file($trackFilePath);
        // load waypoints
        if (property_exists($gpxXml, "wpt")) {
            foreach ($gpxXml->wpt as $waypoint) {
                // create new waypoint
                $gpxWaypoint = new GpxWaypoint((float)$waypoint->attributes()->lat, (float) $waypoint->attributes()->lon, (float)$waypoint->ele, (string)$waypoint->name, (string)$waypoint->sym);
                // add waypoint to track
                $gpxTrack->addWaypoint($gpxWaypoint);
            }
        }
        // returns loaded track
        return $gpxTrack;
    }
}
