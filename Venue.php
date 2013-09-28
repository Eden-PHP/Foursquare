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
 * Four square Venue
 *
 * @package Eden
 * @category four square
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Venue extends Base
{
    const URL_VENUE = 'https://api.foursquare.com/v2/venues/%s';
    const URL_VENUE_ADD = 'https://api.foursquare.com/v2/venues/add';
    const URL_VENUE_CATEGORY = 'https://api.foursquare.com/v2/venues/categories';
    const URL_VENUE_MANAGE = 'https://api.foursquare.com/v2/venues/managed';
    const URL_VENUE_TIME = 'https://api.foursquare.com/v2/venues/timeseries';
    const URL_VENUE_SEARCH = 'https://api.foursquare.com/v2/venues/search';
    const URL_VENUE_TRENDING = 'https://api.foursquare.com/v2/venues/trending';
    const URL_VENUE_EVENTS = 'https://api.foursquare.com/v2/venues/%s/events';
    const URL_VENUE_LIST = 'https://api.foursquare.com/v2/venues/%s/listed';
    const URL_VENUE_MENU = 'https://api.foursquare.com/v2/venues/%s/menu';
    const URL_VENUE_PHOTOS = 'https://api.foursquare.com/v2/venues/%s/photos';
    const URL_VENUE_SIMILAR = 'https://api.foursquare.com/v2/venues/%s/similar';
    const URL_VENUE_STATS = 'https://api.foursquare.com/v2/venues/%s/stats';
    const URL_VENUE_TIPS = 'https://api.foursquare.com/v2/venues/%s/tips';
    
    const URL_VENUE_EDIT = 'https://api.foursquare.com/v2/venues/%s/edit';
    const URL_VENUE_FLAG = 'https://api.foursquare.com/v2/venues/%s/flag';
    const URL_VENUE_MARK = 'https://api.foursquare.com/v2/venues/%s/marktodo';
    const URL_VENUE_PROPOSE_EDIT = 'https://api.foursquare.com/v2/venues/%s/proposeedit';
    
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
     * Set name of the venue 
     * 
     * @param string
     * @return Eden\Foursquare\Venue
     */
    public function setVenueName($venueName)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['name'] = $venueName;
        
        return $this;
    }
    
    /**
     * Set text of the tip
     * 
     * @param string
     * @return Eden\Foursquare\Venue
     */
    public function setText($text)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['text'] = $text;
        
        return $this;
    }
    
    /**
     * Set address of the venue 
     * 
     * @param string
     * @return Eden\Foursquare\Venue
     */
    public function setVenueAddress($venueAddress)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['address'] = $address;
        
        return $this;
    }
    
    /**
     * Set location by setting longtitide 
     * and latitude
     * 
     * @param int|float
     * @param int|float
     * @return Eden\Foursquare\Venue
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
     * Set twitter account
     * 
     * @param string
     * @return Eden\Foursquare\Venue
     */
    public function setTwitter($twitter)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['twitter'] = $twitter;
        
        return $this;
    }
    
    /**
     * Set category id
     * 
     * @param string
     * @return Eden\Foursquare\Venue
     */
    public function setCategoryId($categoryId)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['categoryId'] = $categoryId;
        
        return $this;
    }
    
    /**
     * The nearest intersecting street or streets. 
     * 
     * @param string
     * @return Eden\Foursquare\Venue
     */
    public function setCrossStreet($crossStreet)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['crossStreet'] = $crossStreet;
        
        return $this;
    }
    
    /**
     * The city name where this venue is.
     * 
     * @param string
     * @return Eden\Foursquare\Venue
     */
    public function setCity($city)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['city'] = $city;
        
        return $this;
    }
    
    /**
     * The nearest state or province to the venue.
     * 
     * @param string
     * @return Eden\Foursquare\Venue
     */
    public function setState($state)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['state'] = $state;
        
        return $this;
    }
    
    /**
     * The zip or postal code for the venue.
     * 
     * @param string
     * @return Eden\Foursquare\Venue
     */
    public function setZip($zip)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['zip'] = $zip;
        
        return $this;
    }
    
    /**
     * The phone number of the venue.
     * 
     * @param string
     * @return Eden\Foursquare\Venue
     */
    public function setPhone($phone)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['phone'] = $phone;
        
        return $this;
    }
    
    /**
     * The ID of the category to which you want to assign this venue.
     * 
     * @param string
     * @return Eden\Foursquare\Venue
     */
    public function setPrimaryCategoryId($primaryCategoryId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['primaryCategoryId'] = $primaryCategoryId;
        
        return $this;
    }
    
    /**
     * A freeform description of the venue, up to 300 characters.
     * 
     * @param string
     * @return Eden\Foursquare\Venue
     */
    public function setDescription($description)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['description'] = $description;
        
        return $this;
    }
    
    /**
     * The url of the homepage of the venue.
     * 
     * @param string
     * @return Eden\Foursquare\Venue
     */
    public function setUrl($url)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['url'] = $url;
        
        return $this;
    }
    
    /**
     * Number of results to return, up to 50.
     * 
     * @param integer
     * @return Eden\Foursquare\Venue
     */
    public function setLimit($limit)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'int');
        $this->query['limit'] = $limit;
        
        return $this;
    }
    
    /**
     * Radius in meters, up to approximately 2000 meters.
     * 
     * @param integer
     * @return Eden\Foursquare\Venue
     */
    public function setRadius($radius)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'int');
        $this->query['radius'] = $radius;
        
        return $this;
    }
    
    /**
     * The start of the time range to retrieve stats for 
     * (seconds since epoch). If omitted, all-time stats will be returned.
     * 
     * @param integer|integer 
     * @return Eden\Foursquare\Venue
     */
    public function setStartTime($startTime)
    {
        //argument 1 must be a string or integer
        Argument::i()->test(1, 'string', 'int');
        $this->query['startAt'] = $startTime;
        
        return $this;
    }
    
    /**
     * The end of the time range to retrieve stats for 
     * (seconds since epoch). If omitted, the current time is assumed.
     * 
     * @param integer|integer 
     * @return Eden\Foursquare\Venue
     */
    public function setEndTime($endTime)
    {
        //argument 1 must be a string or integer
        Argument::i()->test(1, 'string', 'int');
        $this->query['endAt'] = $endTime;
        
        return $this;
    }
    
    /**
     * A search term to be applied against venue names.
     * 
     * @param integer|integer 
     * @return Eden\Foursquare\Venue
     */
    public function setQuery($venueName)
    {
        //argument 1 must be a string or integer
        Argument::i()->test(1, 'string', 'int');
        $this->query['query'] = $venueName;
        
        return $this;
    }
    
    /**
     * Allows users to add a new venue. 
     * 
     * @param string
     * @param string|integer|float
     * @param string|integer|float
     * @return array
     */
    public function addVenue($venueName, $latitude, $longtitude)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            ->test(2, 'string', 'int', 'float')     //argument 2 must be a string or integer or float
            ->test(3, 'string', 'int', 'float');    //argument 3 must be a string or integer or float
        
        $this->query['name']    = $venueName;
        $this->query['ll']      = $latitude.','.$longtitude;
        
        return $this->post(self::URL_VENUE_ADD, $this->query);
    }
    
    /**
     * Returns a hierarchical list of categories applied to venues.
     * 
     * @return array
     */
    public function getVenueCategories()
    {
        return $this->getResponse(self::URL_VENUE_CATEGORY);
    }
    
    /**
     * Returns a list of venues the current user manages.
     * 
     * @return array
     */
    public function getManagedVenues()
    {
        return $this->getResponse(self::URL_VENUE_MANAGE);
    }
    
    /**
     * Returns a list of venues near the current location, 
     * optionally matching the search term. 
     * 
     * @param string|null Required unless longtitude and latitude is provided
     * @param string|integer|float|null Required unless near is provided
     * @param string|integer|float|null Required unless near is provided
     * @return array
     */
    public function search($near = null, $latitude = null, $longtitude = null)
    {
        //argument test
        Argument::i()
            ->test(1, 'string', 'null')                     //argument 1 must be a string or null
            ->test(2, 'string', 'int', 'float', 'null')     //argument 2 must be a string, integer, float or null
            ->test(3, 'string', 'int', 'float', 'null');    //argument 3 must be a string, integer, float or null
        
        $this->query['near']    = $near;
        $this->query['ll']      = $latitude.','.$longtitude;
        
        return $this->getResponse(self::URL_VENUE_SEARCH, $this->query);
    }
     
    /**
     * Get daily venue stats for a list of venues over a time range.
     * 
     * @param string|integer The start of the time range to retrieve stats. Example: YYYY-MM-DD
     * @param string 
     * @return array
     */
    public function getDailyVenueStats($startTime, $venueId)
    {
        //argument test
        Argument::i()
            ->test(1, 'string', 'int')  //argument 1 must be a string or integer
            //argument 2 must be a string
            ->test(2, 'string');
        
        $this->query['startAt'] = strtotime($startTime);
        $this->query['venueId'] = $venueId;
        
        return $this->getResponse(self::URL_VENUE_TIME, $this->query);
    }
    
    /**
     * Returns a list of venues near the current location with the most people currently checked in. 
     * 
     * @param string|integer|float
     * @param string|integer|float
     * @return array
     */
    public function getTrending($latitude, $longtitude)
    {
        //argument test
        Argument::i()
            ->test(1, 'string', 'int', 'float')     //argument 1 must be a string or integer or float
            ->test(2, 'string', 'int', 'float');    //argument 2 must be a string or integer or float
        
        $this->query['ll'] = $latitude.','.$longtitude;
        
        return $this->getResponse(self::URL_VENUE_TRENDING, $this->query);
    }
    
    /**
     * Allows you to access information about the current events at a place. 
     * 
     * @param string The venue id for which events are being requested.
     * @return array
     */
    public function getVenueEventInfo($venueId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
            
        return $this->getResponse(sprintf(self::URL_VENUE_EVENT, $venueId));
    }
    
    /**
     * The lists that this venue appears on 
     * 
     * @param string Identity of a venue to get lists for.
     * @return array
     */
    public function getVenueList($venueId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return $this->getResponse(sprintf(self::URL_VENUE_LIST, $venueId), $this->query);
    }
    
    /**
     * Returns menu information for a venue 
     * 
     * @param string The venue id for which menu is being requested.
     * @return array
     */
    public function getVenueMenu($venueId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
            
        return $this->getResponse(sprintf(self::URL_VENUE_MENU, $venueId));
    }
    
    /**
     * Returns menu information for a venue 
     * 
     * @param string The venue you want photos for.
     * @param string checkin or venue
     * @return array
     */
    public function getVenuePhoto($venueId, $group)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');
        
        //if the input value is not allowed
        if (!in_array($group, array('checkin', 'venue'))) {
            //throw error
            Argument::i()
                ->setMessage(Argument::INVALID_GROUPS)
                ->addVariable($group)
                ->trigger();
        }
        
        $this->query['group'] = $group;
        
        return $this->getResponse(sprintf(self::URL_VENUE_PHOTO, $venueId), $this->query);
    }
    
    /**
     * Returns a list of venues similar to the specified venue. 
     * 
     * @param string The venue you want similar venues for.
     * @return array
     */
    public function getSimilarVenues($venueId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
            
        return $this->getResponse(sprintf(self::URL_VENUE_SIMILAR, $venueId));
    }
    
    /**
     * Returns venue stats over a given time range.
     * 
     * @param string The venue you want similar venues for.
     * @return array
     */
    public function getVenueStats($venueId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
            
        return $this->getResponse(sprintf(self::URL_VENUE_STATS, $venueId), $this->query);
    }
    
    /**
     * Returns tips for a venue. 
     * 
     * @param string The venue you want tips for.
     * @return array
     */
    public function getVenueTips($venueId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
            
        return $this->getResponse(sprintf(self::URL_VENUE_STATS, $venueId), $this->query);
    }
    
    /**
     * Make changes to a venue
     * 
     * @param string The venue id to edit
     * @return array
     */
    public function editVenue($venueId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        $this->query['VENUE_ID'] = $venueId;
        
        return $this->post(sprintf(self::URL_VENUE_EDIT, $venueId), $this->query);
    }
    
    /**
     * Allows users to indicate a venue is incorrect in some way. 
     * 
     * @param string The venue id for which an edit is being proposed
     * @param string One of mislocated, closed, duplicate, inappropriate, doesnt_exist, event_over
     * @return array
     */
    public function flagVenue($venueId, $problem)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');
        
        //if the input value is not allowed
        if (!in_array($problem, array('mislocated', 'closed', 'duplicate', 'inappropriate', 'doesnt_exist', 'event_over'))) {
            //throw error
            Argument::i()
                ->setMessage(Argument::INVALID_PROBLEM)
                ->addVariable($problem)
                ->trigger();
        }
        
        $this->query['VENUE_ID']    = $venueId;
        $this->query['problem'] = $problem;
        
        return $this->post(sprintf(self::URL_VENUE_FLAG, $venueId), $this->query);
    }
    
    /**
     * Allows you to mark a venue to-do, with optional text.  
     * 
     * @param string The venue id for which an edit is being proposed
     * @param string One of mislocated, closed, duplicate, inappropriate, doesnt_exist, event_over
     * @return array
     */
    public function markVenue($venueId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        $this->query['VENUE_ID'] = $venueId;
        
        return $this->post(sprintf(self::URL_VENUE_MARK, $venueId), $this->query);
    }
    
    /**
     * Make changes to a venue
     * 
     * @param string The venue id to edit
     * @return array
     */
    public function proposeEdit($venueId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        $this->query['VENUE_ID'] = $venueId;
        
        return $this->post(sprintf(self::URL_VENUE_PROPOSE_EDIT, $venueId), $this->query);
    }
}
