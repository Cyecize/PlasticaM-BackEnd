<?php


namespace App\Utils;


use App\Constants\Config;
use DateTime;

class DateUtils
{

    public static function getNow(): DateTime
    {
        return new DateTime('now', new \DateTimeZone(Config::DEFAULT_TIMEZONE));
    }

    public static function diff(DateTime $dt1, DateTime $dt2): \DateInterval
    {
        $tz = new \DateTimeZone(Config::DEFAULT_TIMEZONE);

        $dt1 = new DateTime($dt1->format('Y-m-d H:i:s'), $tz);
        $dt2 = new DateTime($dt2->format('Y-m-d H:i:s'), $tz);

        return $dt1->diff($dt2, true);
    }
}