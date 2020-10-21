<?php

namespace MicheleBonacina\PhpGpxLib;

use DateTime;
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
     * @param string $gpxFilePath full gpx file path
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
        // get garmin extensione namespace prefix
        $gpxNamespaces = $gpxXml->getNamespaces(TRUE);
        $gpxNamespaceExtensionsPrefix = null;
        foreach($gpxNamespaces as $gpxNamespace)
        {
            if (strpos($gpxNamespace, "TrackPointExtension"))
            {
                $gpxNamespaceExtensionsPrefix = array_search($gpxNamespace, $gpxNamespaces);
            }
        }
        // load waypoints
        if (property_exists($gpxXml, "wpt")) {
            foreach ($gpxXml->wpt as $waypoint) {
                // get waypoint data
                $latitude = (float)$waypoint->attributes()->lat;
                $longitude = (float)$waypoint->attributes()->lon;
                $altitude = (float)$waypoint->ele;
                $name = (string)$waypoint->name;
                $symbol = (string)$waypoint->sym;
                // create new waypoint
                $gpxWaypoint = new GpxWaypoint($latitude, $longitude, $altitude, $name, $symbol);
                // add waypoint to track
                $gpxFile->addWaypoint($gpxWaypoint);
            }
        }
        // load tracks
        if (property_exists($gpxXml, "trk")) {
            foreach ($gpxXml->trk as $track) {
                // get track data
                $name = (string)$track->name;
                $type = (string)$track->type;
                // create a new track
                $gpxTrack = new GpxTrack($name, $type);
                if (property_exists($track, "trkseg")) {
                    foreach ($track->trkseg as $trackSegment) {
                        // create a new track segment
                        $gpxTrackSegment = new GpxTrackSegment();
                        if (property_exists($trackSegment, "trkpt")) {
                            foreach ($trackSegment->trkpt as $trackPoint) {
                                // get trackpint data
                                $latitude = (float)$trackPoint->attributes()->lat;
                                $longitude = (float)$trackPoint->attributes()->lon;
                                $altitude = (float)$trackPoint->ele;
                                $timestamp = new DateTime((string)$trackPoint->time);
                                $heartRate = null;
                                $cadence = null;
                                $temperature = null;
                                if (property_exists($trackPoint, "extensions"))
                                {
                                    $extensions = $trackPoint->extensions->children($gpxNamespaceExtensionsPrefix, TRUE);
                                    $heartRate = (int) $extensions->TrackPointExtension->hr;
                                    $cadence = (int) $extensions->TrackPointExtension->cad;
                                    $temperature = (float) $extensions->TrackPointExtension->atemp;
                                }
                                // create a new track point
                                $gpxTrackPoint = new GpxTrackPoint($latitude, $longitude, $altitude, $timestamp, $heartRate, $cadence, $temperature);
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
