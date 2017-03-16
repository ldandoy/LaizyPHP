<?php

define('FORMAT_DATE', '%d/%m/%Y');
define('FORMAT_TIME', '%H:%M:%S');
define('FORMAT_DATETIME', '%d/%m/%Y %H:%M:%S');
define('FORMAT_DATE_LONG', '%e %b %Y');
define('FORMAT_DATE_LONGLONG', '%A %e %b %Y');

namespace Lcxlib\Utils;

class DateTime
{
    const ONE_MINUTE = 60;

    const ONE_HOUR = 60*60;

    const ONE_DAY = 24*60*60;

    const DATETIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * Convert a DateTime Object to an Unix timestamp
     * @param DateTime $dateTime
     * @return int (Unix timestamp)
     */
    static function DateTimeToTimestamp($dateTime)
    {
        return $dateTime->getTimestamp();
    }

    /**
     * Convert an Unix timestamp to a DateTime Object
     * @param int $timestamp (Unix timestamp)
     * @return DateTime
     */
    static function TimestampToDateTime($timestamp)
    {
        $dt = new \DateTime();
        return $dt->setTimestamp($timestamp);
    }

    /**
     * Convert a string to an Unix timestamp
     * @param string $dateTime
     * @param string $format
     * @return int (Unix timestamp)
     */
    public static function StringToTimestamp($dateTime, $format = DateTime::DATETIME_FORMAT)
    {
        $dt = \DateTime::createFromFormat($format, $dateTime);
        return $dt->getTimestamp();
    }

    /**
     * Convert an Unix timestamp to a string
     * @param int $timestamp (Unix timestamp)
     * @param string $format
     * @return string
     */
    public static function TimestampToString($timestamp, $format = DateTime::DATETIME_FORMAT)
    {
        return date($format, $timestamp);
    }

    /**
     * Format a datetime
     * @param string|DateTime $dateTime
     * @param string $format FORMAT_*
     * @return string
     */
    public static function format($dateTime, $format = FORMAT_DATETIME)
    {
        if (is_string($datetime)) {
            $ts = DateTime::StringToTimestamp($datetime);
        } else {
            $ts = DateTime::DateTimeToTimestamp($datetime);
        }
        return strftime($format, $ts);
    }
}
