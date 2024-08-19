<?php

namespace App;

use InvalidArgumentException;

class Helpers
{
    /**
     * getJson
     * 
     * @param string $file file name 
     * @param int $flags 
     * @return mixed
     */
    public static function getJson(
        $file,
        $flags = JSON_THROW_ON_ERROR
    ): mixed {
        return json_decode(file_get_contents($file), true, 512, $flags);
    }

    /**
     * metresToFeet
     *
     * @param int|float $m
     * @param int $round defualt 2
     * @return int|float feet
     */
    public static function metresToFeet($m, $round = 2): int|float
    {
        return round($m * 3.28084, $round);
    }

    /**
     * feetToMetres
     *
     * @param int|float $ft
     * @param int $round defualt 2
     * @return int|float metres
     */
    public static function feetToMetres($ft, $round = 2): int|float
    {
        return round($ft / 3.28084, $round);
    }

    /**
     * milesToKilometres
     *
     * @param int|float $mi
     * @param int $round defualt 2
     * @return int|float
     */
    public static function milesToKilometres($mi, $round = 2): int|float
    {
        return round($mi * 1.609, $round);
    }

    /**
     * KilometresToMiles
     *
     * @param int|float $km
     * @param int $round defualt 2
     * @return int|float
     */    
    public static function KilometresToMiles($km, $round = 2): int|float
    {
        return round($km / 1.609, $round);
    }


    /**
     * ddToDMS
     * 
     * Converts number in decimal degress to D° M′ S″
     *
     * @param double $coordinate        
     * @return string
     */
    public static function ddToDMS($dd): string
    {
        $absolute = abs($dd);
        $degrees = floor($absolute);
        $minutesNotTruncated = ($absolute - $degrees) * 60;
        $minutes = floor($minutesNotTruncated);
        $seconds = floor(($minutesNotTruncated - $minutes) * 60);

        return "{$degrees}\u{00B0} {$minutes}\u{2032} {$seconds}\u{2033}";
    }

    /**
     * coordinateToDMS
     * 
     * Converts a coordinate in [lng, lat] format to array in the format.
     * [
     *      'lat' => "D° M′ S″ N|S",
     *      'lng' => "D° M′ S″ E|W"
     * ]
     *
     * @param array $coordinate
     * @return array{'lat': string, 'lng': string}
     * @throws InvalidArgumentException
     */
    public static function coordinateToDMS($coordinate): array
    {
        if (count($coordinate) < 2) {
            throw new InvalidArgumentException('$coordinate should have at least 2 elements');
        }

        return [
            'lat' => static::ddToDMS($coordinate[1]) . ($coordinate[1] >= 0 ? ' N' : ' S'),
            'lng' => static::ddToDMS($coordinate[0]) . ($coordinate[0] >= 0 ? ' E' : ' W')
        ];
    }
}
