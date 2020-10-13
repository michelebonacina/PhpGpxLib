<?php

namespace MicheleBonacina\PhpGpxLib;

use Exception;
use MicheleBonacina\PhpGpxLib\Track\GpxTrack;
use MicheleBonacina\PhpGpxLib\Track\GpxTrackPoint;
use MicheleBonacina\PhpGpxLib\Track\GpxTrackSegment;
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
        // load tracks
        if (property_exists($gpxXml, "trk")) {
            foreach ($gpxXml->trk as $track) {
                // create a new track
                $gpxTrack = new GpxTrack((string)$track->name);
                if (property_exists($track, "trkseg")) {
                    foreach ($track->trkseg as $trackSegment) {
                        // create a new track segment
                        $gpxTrackSegment = new GpxTrackSegment();
                        if (property_exists($trackSegment, "trkpt")) {
                            foreach ($trackSegment->trkpt as $trackPoint) {
                                // create a new track point
                                // TODO manage hearth rate and cadence
                                $gpxTrackPoint = new GpxTrackPoint((float)$trackPoint->attributes()->lat, (float)$trackPoint->attributes()->lon, (float)$trackPoint->ele, (string)$trackPoint->time, null, null);
                                // add track point to segment
                                $gpxTrackSegment->addTrackPoint($gpxTrackPoint);
                            }
                        }
                        // add track segment to track
                        $gpxTrack->addTrackSegment($gpxTrackSegment);
                    }
                }
                // add track to file
                $gpxFile->addTrack($gpxTrack);
            }
        }
        // returns loaded track
        return $gpxFile;
    }
}
