<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Foursquare;

/**
 * The base class for any class handling exceptions. Exceptions
 * allow an application to custom handle errors that would
 * normally let the system handle. This exception allows you to
 * specify error levels and error types. Also using this exception
 * outputs a trace (can be turned off) that shows where the problem
 * started to where the program stopped.
 *
 * @vendor Eden
 * @package Foursquare
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Exception extends CoreException
{
    const INVALID_PROBLEM           = 'Argument 2 was expecting mislocated, closed, duplicate, inappropriate, doesnt_exist, event_over. %s was given';
    const INVALID_GROUPS            = 'Argument 2 was expecting checkin, venue. %s was given';
    const INVALID_FIELDS            = 'Argument 1 was expecting totalCheckins, newCheckins, uniqueVisitors, sharing, genders, ages, hours. %s was given';
    const INVALID_BROADCAST         = 'Argument 2 was expecting private, public, facebook, twitter, followers. %s was given';
    const INVALID_BROADCAST_TIPS    = 'Argument 1 was expecting facebook, twitter, followers. %s was given';
    const INVALID_GROUP             = 'Argument 1 was expecting created, edited, followed, friends, other. %s was given';
    const INVALID_BROADCAST_LIST    = 'Argument 1 was expecting facebook, twitter. %s was given';
    const INVALID_STATUS            = 'Argument 1 was expecting pending, active, expired, all. %s was given';
    const INVALID_PROBLEM_SPECIAL   = 'Argument 1 was expecting not_redeemable, not_valuable. %s was given';
    
    const INVALID_FIELDS_PAGES      = 'Argument 1 was expecting totalCheckins, newCheckins, uniqueVisitors, sharing, genders, ages, hours. %s was given';
    const INVALID_CAMPAIGN_STATUS   = 'Argument 1 was expecting pending, scheduled, active, expired, depleted, stopped, notStarted, ended, all %s was given';
    const INVALID_SETTING           = 'Argument 1 was expecting sendToTwitter, sendMayorshipsToTwitter, sendBadgesToTwitter, sendToFacebook, sendMayorshipsToFacebook, sendBadgesToFacebook, receivePings, receiveCommentPings. %s was given';
    
    const INVALID_PAGEUPDATES_BROADCAST = 'Argument 1 was expecting facebook, twitter, private. %s was given';
    
     
    public static function i($message = null, $code = 0)
    {
        $class = __CLASS__;
        return new $class($message, $code);
    }
}
