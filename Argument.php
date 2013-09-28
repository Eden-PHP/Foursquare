<?php //-->
/*
 * This file is part of the Tumblr package of the Eden PHP Library.
 * (coffee) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Foursquare;

use Eden\Core\Argument as CoreArgument;

/**
 * The base class for any class handling exceptions. Exceptions
 * allow an application to custom handle errors that would
 * normally let the system handle. This exception allows you to
 * specify error levels and error types. Also using this exception
 * outputs a trace (can be turned off) that shows where the problem
 * started to where the program stopped.
 *
 * @vendor Eden
 * @package Twitter
 * @author Federico A. Maglayon rmaglayon@gmail.com
 */
class Argument extends CoreArgument
{

    /**
     * Validates an argument given the type.
     *
     * @param *string
     * @param *mixed
     * @return bool
     */
    protected function isValid($type, $data)
    {
        $valid = Validation::i();

        switch($type) {
            case 'location':
                return $valid->isLocation($data);
            case 'utc':
                return $valid->isUtc($data);
            case 'abbr':
                return $valid->isAbbr($data);
            default: break;
        }

        return parent::isValid($type, $data);
    }

}