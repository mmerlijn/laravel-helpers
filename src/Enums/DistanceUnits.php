<?php

namespace mmerlijn\laravelHelpers\Enums;

use mmerlijn\laravelHelpers\Exceptions\DistanceException;

enum DistanceUnits: int
{
    case KM = 1000;
    case HM = 100;
    case DAM = 10;
    case M = 1;

    public static function set(string $unit)
    {
        return match (strtolower($unit)) {
            "m" => self::M,
            "km" => self::KM,
            "hm" => self::HM,
            "dam" => self::DAM,
            default => throw new DistanceException("INVALID UNIT " . $unit . " only except: m,dam,hm, km")
        };
    }

    public function getUnit(): string
    {
        return match ($this) {
            self::KM => "km",
            self::M => "m",
            self::HM => "hm",
            self::DAM => "dam",
        };
    }
}