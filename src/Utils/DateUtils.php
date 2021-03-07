<?php


namespace App\Utils;


use App\Constants\Config;

class DateUtils
{

    public static function getNow(): \DateTime
    {
        return new \DateTime('now', new \DateTimeZone(Config::DEFAULT_TIMEZONE));
    }
}