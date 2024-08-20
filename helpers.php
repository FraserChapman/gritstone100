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
        string $file,
        int $flags = JSON_THROW_ON_ERROR
    ): mixed {
        try {
            $fileObject = new \SplFileObject($file);
            $contents = $fileObject->fread($fileObject->getSize());
    
            return json_decode($contents, true, 512, $flags);
        } catch (\RuntimeException $e) {
            throw new \RuntimeException("Failed to read file: " . $e->getMessage(), 0, $e);
        } catch (\JsonException $e) {
            throw new \JsonException("Failed to decode JSON: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * metresToFeet
     *
     * @param int|float $mmetres
     * @param int $round defualt 2
     * @return int|float feet
     */
    public static function metresToFeet($metres, $round = 2): int|float
    {
        return round($metres * 3.28084, $round);
    }

    /**
     * feetToMetres
     *
     * @param int|float $feet
     * @param int $round defualt 2
     * @return int|float metres
     */
    public static function feetToMetres($feet, $round = 2): int|float
    {
        return round($feet / 3.28084, $round);
    }

    /**
     * milesToKilometres
     *
     * @param int|float $miles
     * @param int $round defualt 2
     * @return int|float
     */
    public static function milesToKilometres($miles, $round = 2): int|float
    {
        return round($miles * 1.609, $round);
    }

    /**
     * kilometresToMiles
     *
     * @param int|float $kilometres
     * @param int $round defualt 2
     * @return int|float
     */    
    public static function kilometresToMiles($kilometres, $round = 2): int|float
    {
        return round($kilometres / 1.609, $round);
    }


    /**
     * ddToDMS
     * 
     * Converts number in decimal degress to D° M′ S″
     *
     * @param double $coordinate        
     * @return string
     */
    public static function ddToDMS($coordinate): string
    {
        $absolute = abs($coordinate);
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
     *      "lat" => "D° M′ S″ N|S",
     *      "lng" => "D° M′ S″ E|W"
     * ]
     *
     * @param array $coordinate
     * @return array{"lat": string, "lng": string}
     * @throws InvalidArgumentException
     */
    public static function coordinateToDMS($coordinate): array
    {
        if (count($coordinate) < 2) {
            throw new InvalidArgumentException("$coordinate should have at least 2 elements");
        }

        return [
            "lat" => static::ddToDMS($coordinate[1]) . ($coordinate[1] >= 0 ? " N" : " S"),
            "lng" => static::ddToDMS($coordinate[0]) . ($coordinate[0] >= 0 ? " E" : " W")
        ];
    }
}
