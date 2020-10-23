# PhpGpxLib

<!-- [![Latest Version on Packagist][ico-version]][link-packagist] -->
[![Software License][ico-license]](LICENSE.md)
<!-- [![Build Status][ico-travis]][link-travis] -->
<!-- [![Coverage Status][ico-scrutinizer]][link-scrutinizer] -->
<!-- [![Quality Score][ico-code-quality]][link-code-quality] -->
<!-- [![Total Downloads][ico-downloads]][link-downloads] -->


Another PHP library for [GPX files](https://en.wikipedia.org/wiki/GPS_Exchange_Format) management: import from standard file, manage data e get additional informations.

This library is structured to be used inside a persistence framework, like Laravel Eloquent. See Laravel section for details.

**This library is still in develompment!!**

## Feature

### File management

- Import from Standard GPX file: waypoints, tracks, segments and trackpoints
- Read some data form [Garmin Trackpoint Extension](https://www8.garmin.com/xmlschemas/TrackPointExtensionv1.xsd): temperature, heartrate and cadence

### Data calculation
- Two points operations
    - Distance in meters, considering latitude, longitude and altitude difference 
    - Drop in meters
    - Percentage grade
    - Time difference in seconds
    - Temperature difference
- Track operations
    - Total duration in seconds

## Install

Via Composer

``` bash
$ composer require michelebonacina/PhpGpxLib
```

## Data structure

The library uses simple objects for GPX data management and utility classes for operations and data calculations. The simple objects reflect the standard GPX file format and has a main constructor, with all properties, and a single getter for each property.

### Simple objects

Every file is mapped over a **GpxFile** which contains a list of **GpxWaypoint** and a list of **GpxTrack**. Every **GpxTrack** contains a list of **GpxTrackSegment** which contains a list of **GpxTrackPoint**.

**GpxTrack** properties are *name* and *type*.

**GpxTrackSegments** has no properties.

**GpxWaypoint** and **GpxTrackPoints** extends **GpxPoint**, the simplest point: its properies are *latitude*, *longitude* and *altitude*.

**GpsWaypoint** adds *name* and *symbol* to **GpxPoint**.

**GpsTrackPoint** adds a *timestamp*, *heartrate*, *cadence* and *temperature* to **GpxPoint**.

### Utility classes

**GpxFileUtility** is used for GPX file manipulation, like loading data from file.

## Usage

### Load from GPX file and gets data
``` php
<?php

    use MicheleBonacina\PhpGpxLib\GpxFileUtility;

    // load data from file
    $fileUtility = new GpxFileUtility();
    $gpx = $fileUtility->loadTrackFromFile("example.gpx");  // GpxFile
    // get data
    $waypoints = $gpx->listWaypoints();                     // array of GpxWaypoint
    $tracks = $gpx->listTracks();                           // array of GpxTrack
    $trackSegments = $tracks[0]->listTrackSegments();       // array of GpxTrackSegment
    $trackPoints = $trackSegments[0]->listTrackPoints();    // array of GpxTrackPoints

```

## Laravel integration
The classes are structured to be use with a persistent framework, like Laravel Eloquent.

In Eloquent developers must define a Migration class, for describing database table structure, and a model class, for managing persistent operation.

### Laravel standard implementation
As example consider in Laravel a standard implementation of the TrackPoint class.

Migration Class
``` php
class CreateTrackPointsTable extends Migration
{
    public function up()
    {
        Schema::create('track_points', function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude', 32, 28);
            $table->decimal('longitude', 32, 28);
            $table->integer('altitude')->nullable();
            $table->dateTimeTz('time', 0)->nullable();
            $table->decimal('temperature', 6, 2)->nullable();
            $table->integer('heart_rate')->nullable();
            $table->integer('cadence')->nullable();
            $table->bigInteger('track_segment_id')->unsigned();
            $table->foreign('track_segment_id')->on('track_segments')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('track_points');
    }
}
```

Model Class
``` php
class TrackPoint extends Model
{
    public function trackSegment()
    {
        return $this->belongsTo(TrackSegment::class);
    }
}
```

### Laravel PhpGpxLib integration

It's useful to reuse *GpxTrackPoint* functionalities inside the Laravel *TrackPoint* model class without rewrite them, but GpxTrackPoint doesn't extends Eloquent Model class.

The solution is to use *GpxTrackPointTrait* in TrackPoint class which has also to implement the *GpxTrackPointTraitNeeds* interface, like this.

``` php
class TrackPoint extends Model implements GpxTrackPointTraitNeeds
{
    use GpxTrackPointTrait;

    public function trackSegment()
    {
        return $this->belongsTo(TrackSegment::class);
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getAltitude(): float
    {
        return $this->altitude;
    }

    public function getTime(): DateTime
    {
        return new DateTime($this->time);
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }
}
```

Simply using *GpxTrackPointTrait* gives to *TrackPoint* Laravel class the possibility to call *duration()*, *deltaTemperature()*, *distance()*, *drop()*, *percentageGrade()*, etc methods, without implementing them. But this methods needs some other methods of *GpxTrackPoint*, so they are declared inside the *GpxTrackPointTraitNeeds* interface. Laravel *TrackPoint* class must to implements this interface and all the methods in it declared (*getLatitude()*, *getLongitude()*, *getAltitude()*, *getTime()* and *getTemperature()*, etc), according with the Laravel *TrackPoint* definition.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email michele.bonacina@gmail.com instead of using the issue tracker.

## Credits

- [Michele Bonacina][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/michelebonacina/PhpGpxLib.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/michelebonacina/PhpGpxLib/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/michelebonacina/PhpGpxLib.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/michelebonacina/PhpGpxLib.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/michelebonacina/PhpGpxLib.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/michelebonacina/PhpGpxLib
[link-travis]: https://travis-ci.org/michelebonacina/PhpGpxLib
[link-scrutinizer]: https://scrutinizer-ci.com/g/michelebonacina/PhpGpxLib/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/michelebonacina/PhpGpxLib
[link-downloads]: https://packagist.org/packages/michelebonacina/PhpGpxLib
[link-author]: https://github.com/michelebonacina
[link-contributors]: ../../contributors
