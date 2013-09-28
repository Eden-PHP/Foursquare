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
 * Four square tips
 *
 * @package Eden
 * @category four square
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Tips extends Base
{
    const URL_TIPS_ADD = 'https://api.foursquare.com/v2/tips/add';
    const URL_TIPS_SEARCH = 'https://api.foursquare.com/v2/tips/search';
    const URL_TIPS_GET = 'https://api.foursquare.com/v2/tips/%s/done';
    const URL_TIPS_LIST = 'https://api.foursquare.com/v2/tips/%s/listed';
    const URL_TIPS_MARK_DONE = 'https://api.foursquare.com/v2/tips/%s/markdone';
    const URL_TIPS_MARK_TODO = 'https://api.foursquare.com/v2/tips/%s/marktodo';
    const URL_TIPS_UNMARK = 'https://api.foursquare.com/v2/tips/%s/unmark';
    
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
     * The url of the homepage of the venue.
     * 
     * @param string
     * @return Eden\Foursquare\Tips
     */
    public function setUrl($url)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['url'] = $url;
        
        return $this;
    }
    
    /**
     * Set location by setting longtitide 
     * and latitude
     * 
     * @param int|float
     * @param int|float
     * @return Eden\Foursquare\Tips
     */
    public function setLocation($longtitude, $latitude)
    {
        //argument test
        Argument::i()
            ->test(1, 'int', 'float')   //argument 1 must be an integer or float
            ->test(2, 'int', 'float');  //argument 2 must be an integer or float
            
        $this->query['ll'] =$longtitude.', '.$latitude;
        
        return $this;
    }
    
    /**
     * Number of results to return, up to 50.
     * 
     * @param integer
     * @return Eden\Foursquare\Tips
     */
    public function setLimit($limit)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'int');
        $this->query['limit'] = $limit;
        
        return $this;
    }
    
    /**
     * If set to friends, only show nearby tips from friends.
     * 
     * @param string
     * @return Eden\Foursquare\Tips
     */
    public function setFilter($filter)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['filter'] = $filter;
        
        return $this;
    }
    
    /**
     * Only find tips matching the given term, cannot be used in 
     * conjunction with friends filter.
     * 
     * @param string
     * @return Eden\Foursquare\Tips
     */
    public function setQuery($query)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['query'] = $query;
        
        return $this;
    }
    
    /**
     * Whether to broadcast this tip. Send twitter if you want to 
     * send to twitter, facebook if you want to send to facebook, 
     * or twitter,facebook if you want to send to both.
     * 
     * @param string
     * @return Eden\Foursquare\Tips
     */
    public function broadcast($broadcast)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        //if the input value is not allowed
        if (!in_array($broadcast, array('facebook', 'twitter', 'followers'))) {
            //throw error
            Argument::i()
                ->setMessage(Argument::INVALID_BROADCAST_TIPS)
                ->addVariable($broadcast)
                ->trigger();
        }
        
        $this->query['broadcast'] = $broadcast;
        
        return $this;
    }
    
    /**
     * Can be created, edited, followed, friends, other. If no 
     * acting user is present, only other is supported.
     * 
     * @param string
     * @return Eden\Foursquare\Tips
     */
    public function setGroup($group)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        //if the input value is not allowed
        if (!in_array($group, array('created', 'edited', 'followed', 'friends', 'other'))) {
            //throw error
            Argument::i()
                ->setMessage(Argument::INVALID_GROUP)
                ->addVariable($broadcast)
                ->trigger();
        }
        
        $this->query['group'] = $group;
        
        return $this;
    }
    
    /**
     * Check in to a place. 
     * 
     * @param string The venue where the user is checking in
     * @param string The text of the tip, up to 200 characters.
     * @return array
     */
    public function checkin($venueId, $text)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');
        
        $this->query['text']        = $text;
        $this->query['venueId'] = $venueId;
        
        return $this->post(self::URL_TIPS_ADD, $this->query);
    }

    /**
     * Returns a list of tips near the area specified. 
     * 
     * @param string The venue where the user is checking in
     * @return array
     */
    public function search($near)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
                
        $this->query['near'] = $near;
        
        return $this->post(self::URL_TIPS_SEARCH, $this->query);
    }
    
    /**
     * Returns an array of users have done this tip.
     * 
     * @param string Identity of a tip to get users who have marked the tip as done.
     * @return array
     */
    public function getTips($tipId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return $this->post(sprintf(self::URL_TIPS_GET, $tipId), $this->query);
    }
    
    /**
     * Returns lists that this tip appears on
     * 
     * @param string Identity of a tip to get lists for.
     * @return array
     */
    public function getTipsList($tipId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        $this->query['_group'] = $group;
        
        return $this->post(sprintf(self::URL_TIPS_LIST, $tipId), $this->query);
    }
    
    /**
     * Allows the acting user to mark a tip done.
     * 
     * @param string The tip you want to mark done.
     * @return array
     */
    public function markDone($tipId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
            
        return $this->post(sprintf(self::URL_TIPS_MARK_DONE, $tipId));
    }
    
    /**
     * Allows you to mark a tip to-do. 
     * 
     * @param string The tip you want to mark done.
     * @return array
     */
    public function markToDo($tipId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
            
        return $this->post(sprintf(self::URL_TIPS_MARK_TODO, $tipId));
    }
    
    /**
     * Allows you to remove a tip from your to-do list or done list. 
     * 
     * @param string The tip you want to mark done.
     * @return array
     */
    public function unmark($tipId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
            
        return $this->post(sprintf(self::URL_TIPS_UNMARK, $tipId));
    }
}
