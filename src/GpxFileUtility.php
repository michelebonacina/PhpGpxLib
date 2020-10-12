<?php

namespace MicheleBonacina\PhpGpxLib;

use Exception;
use MicheleBonacina\PhpGpxLib\Waypoint\GpxWaypoint;

/**
 * Utility for GPX file management.
 */
class GpxFileUtility
{

    /**
     * Load data from a gpx file.
     *
     * @param [string] $gpxFilePath full gpx file path
     * @return GpxFile loaded gpx file
     */
    public function loadTrackFromFile(string $gpxFilePath): GpxFile
    {
        if (!file_exists($gpxFilePath)) {
            // file not found
            throw new Exception("GPX File not founded");
        }
        // create new track
        $gpxFile = new GpxFile();
        // load gpx xml file
        $gpxXml = simplexml_load_file($gpxFilePath);
        // load waypoints
        if (property_exists($gpxXml, "wpt")) {
            foreach ($gpxXml->wpt as $waypoint) {
                // create new waypoint
                $gpxWaypoint = new GpxWaypoint((float)$waypoint->attributes()->lat, (float) $waypoint->attributes()->lon, (float)$waypoint->ele, (string)$waypoint->name, (string)$waypoint->sym);
                // add waypoint to track
                $gpxFile->addWaypoint($gpxWaypoint);
            }
        }
        // returns loaded track
        return $gpxFile;
    }
}
