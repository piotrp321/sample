<?php

namespace AppBundle\Constants;

/**
 * Class Status
 * @package AppBundle\Constants
 */
class Status
{
    const ACTIVE = 'ACTIVE';
    const INACTIVE = 'INACTIVE';

    /**
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
        ];
    }
}