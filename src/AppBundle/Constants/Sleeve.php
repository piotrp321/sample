<?php

namespace AppBundle\Constants;

/**
 * Class Sleeve
 * @package AppBundle\Constants
 */
class Sleeve
{
    const LONG = 'LONG';
    const SHORT = 'SHORT';

    /**
     * @return array
     */
    public static function getSleeves()
    {
        return [
            self::LONG => 'Long',
            self::SHORT => 'Short',
        ];
    }
}