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
 * Four square pages
 *
 * @package Eden
 * @category four square
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Pages extends Base
{
    const URL_PAGES_SEARCH = 'https://api.foursquare.com/v2/pages/search';
    const URL_PAGES_TIMESERIES = 'https://api.foursquare.com/v2/pages/%s/timeseries';
    const URL_PAGES_VENUES = 'https://api.foursquare.com/v2/pages/%s/venues';
    
    /**
     * Construct - Storing Tokens
     * 
     * @param string
     * @return void
     */
    public function __construct($token)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->token = $token;
    }
    
    /**
     * Set twitter account
     * 
     * @param string
     * @return Eden\Foursquare\Pages
     */
    public function setTwitter($twitter)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['twitter'] = $twitter;
        
        return $this;
    }
    
    /**
     * Set twitter account
     * 
     * @param string
     * @return Eden\Foursquare\Pages
     */
    public function setFacebookId($fbId)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['fbid'] = $fbId;
        
        return $this;
    }
    
    /**
     * Specifies which fields to return. May be one or more of 
     * totalCheckins, newCheckins, uniqueVisitors, sharing, 
     * genders, ages, hours, 
     * 
     * @param string
     * @return Eden\Foursquare\Pages
     */
    public function setFields($fields)
    {
        //argument test
        Argument::i()->test(1, 'string');
        
        //if the input value is not allowed
        if (!in_array($fields, array('totalCheckins', 'newCheckins', 'uniqueVisitors', 'sharing', 'genders', 'ages', 'hours'))) {
            //throw error
            Argument::i()
                ->setMessage(Argument::INVALID_FIELDS_PAGES)
                ->addVariable($fields)
                ->trigger();
        }
        
        $this->query['fields'] = $fields;
        
        return $this;
    }
    
    /**
     * The end of the time range to retrieve stats for (seconds since epoch).
     * If omitted, the current time is assumed.
     * 
     * @param string YYYY-MM-DD
     * @return Eden\Foursquare\Pages
     */
    public function setEndTime($endTime)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['endAt'] = strtotime($endTime);
        
        return $this;
    }
    
    /**
     * Set location by setting longtitide 
     * and latitude
     * 
     * @param int|float
     * @param int|float
     * @return Eden\Foursquare\Pages
     */
    public function setLocation($longtitude, $latitude)
    {
        //argument test
        Argument::i()
            ->test(1, 'int', 'float')   //argument 1 must be an integer or float
            ->test(2, 'int', 'float');  //argument 2 must be an integer or float
            
        $this->query['ll'] = $longtitude.', '.$latitude;
        
        return $this;
    }
    
    /**
     * Radius in meters, up to approximately 2000 meters.
     * 
     * @param integer
     * @return Eden\Foursquare\Pages
     */
    public function setRadius($radius)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'int');
        $this->query['radius'] = $radius;
        
        return $this;
    }
    
    /**
     * The number of venues to return. Defaults to 20, max of 100.
     * 
     * @param integer
     * @return Eden\Foursquare\Pages
     */
    public function setLimit($limit)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'int');
        $this->query['limit'] = $limit;
        
        return $this;
    }
    
    /**
     * The offset of which venues to return. Defaults to 0.
     * 
     * @param integer
     * @return Eden\Foursquare\Pages
     */
    public function setOffset($offset)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'int');
        $this->query['offset'] = $offset;
        
        return $this;
    }
    
    /**
     * Returns a list of pages matching the search term.  
     *  
     * @param string A search term to be applied against page names.
     * @return array
     */
    public function search($name)
    {
        //argument test
        Argument::i()->test(1, 'string');
        
        $this->query['name'] = $name;
        
        return $this->getResponse(self::URL_PAGES_SEARCH, $this->query);
    }
    
    /**
     * Get daily venue stats for venues managed by a page over a time range.
     *  
     * @param string The page whose venues to get timeseries data for
     * @param string The start of the time range to retrieve stats for
     * @return array
     */
    public function getTimeSeries($pageId, $startAt)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');
        
        $this->query['startAt'] = strtotime($startAt);
        
        return $this->getResponse(sprintf(self::URL_PAGES_TIMESERIES, $pageId), $this->query);
    }
    
    /**
     * Allows you to get the page's venues.
     *  
     * @param string The page id for which venues are being requested.
     * @return array
     */
    public function getVenue($pageId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return $this->getResponse(sprintf(self::URL_PAGES_VENUES, $pageId), $this->query);
    }
}
