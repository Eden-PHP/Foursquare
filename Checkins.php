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
 * Four square checkins
 *
 * @package Eden
 * @category four square
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Checkins extends Base
{
    const URL_CHECKINS_CREATE = 'https://api.foursquare.com/v2/checkins/add';
    const URL_CHECKINS_RECENT = 'https://api.foursquare.com/v2/checkins/recent';
    const URL_CHECKINS_ADD_COMMENT = 'https://api.foursquare.com/v2/checkins/%s/addcomment';
    const URL_CHECKINS_ADD_POST = 'https://api.foursquare.com/v2/checkins/%s/addpost';
    const URL_CHECKINS_DELETE_COMMENT = 'https://api.foursquare.com/v2/checkins/%s/deletecomment';
    const URL_CHECKINS_REPLY = 'https://api.foursquare.com/v2/checkins/%s/reply';
    
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
     * The event the user is checking in to.
     * 
     * @param string
     * @return Eden\Foursquare\Checkins
     */
    public function setEventId($eventId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['eventId'] = $eventId;
        
        return $this;
    }
    
    /**
     * Set shout
     * 
     * @param string
     * @return Eden\Foursquare\Checkins
     */
    public function setShout($shout)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['shout'] = $shout;
        
        return $this;
    }
    
    /**
     * Number of results to return, up to 50.
     * 
     * @param integer
     * @return Eden\Foursquare\Checkins
     */
    public function setLimit($limit)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'int');
        $this->query['limit'] = $limit;
        
        return $this;
    }
    
    /**
     * The url of the homepage of the venue.
     * 
     * @param string
     * @return Eden\Foursquare\Checkins
     */
    public function setUrl($url)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['url'] = $url;
        
        return $this;
    }
    
    /**
     * Set Content id.
     * 
     * @param string
     * @return Eden\Foursquare\Checkins
     */
    public function setContentId($contentId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['contentId'] = $contentId;
        
        return $this;
    }
    
    /**
     * Check in to a place. 
     * 
     * @param string The venue where the user is checking in
     * @param string Who to broadcast this check-in to
     * @return array
     */
    public function checkin($venueId, $broadcast)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');
        
        //if the input value is not allowed
        if (!in_array($broadcast, array('private', 'public', 'facebook', 'twitter', 'followers'))) {
            //throw error
            Argument::i()
                ->setMessage(Argument::INVALID_BROADCAST)
                ->addVariable($broadcast)
                ->trigger();
        }
        
        $this->query['venueId'] = $venueId;
        $this->query['broadcast'] = $broadcast;
        
        return $this->post(self::URL_CHECKINS_CREATE, $this->query);
    }
    
    /**
     * Returns a list of recent checkins from friends.
     * 
     * @return array
     */
    public function getRecentCheckins()
    {
        return $this->getResponse(self::URL_CHECKINS_CHECKINS, $this->query);
    }
    
    /**
     * Comment on a checkin-in
     * 
     * @param string The ID of the checkin to add a comment to.
     * @param string The text of the comment, up to 200 characters.
     * @return array
     */
    public function addComment($checkinId, $text)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');
            
        $this->query['text'] = $text;
        
        return $this->post(sprintf(self::URL_CHECKINS_ADD_COMMENT, $checkinId), $this->query);
    }
    
    /**
     * Post user generated content from an external app to a check-in. 
     * This post will be accessible to anyone who can view the details of the check-in. 
     * 
     * @param string The ID of the checkin to add a comment to.
     * @param string The text of the comment, up to 200 characters.
     * @return array
     */
    public function addPost($checkinId, $text)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');
        
        $this->query['text'] = $text;
        
        return $this->post(sprintf(self::URL_CHECKINS_ADD_POST, $checkinId), $this->query);
    }
    
    /**
     * Remove a comment from a checkin, if the acting user is the author or the owner of the checkin.
     * 
     * @param string The ID of the checkin to remove a comment from.
     * @param string The id of the comment to remove.
     * @return array
     */
    public function deleteComment($checkinId, $commentId)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');
        
        $this->query['commentId'] = $commentId;
        
        return $this->post(sprintf(self::URL_CHECKINS_DELETE_COMMENT, $checkinId), $this->query);
    }
    
    /**
     * Reply to a user about their check-in. This reply will only be visible to the owner of the check-in.  
     * 
     * @param string The ID of the checkin to remove a comment from.
     * @param string The id of the comment to remove.
     * @return array
     */
    public function replyToCheckin($checkinId, $text)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');
        
        $this->query['text'] = $text;
        
        return $this->post(sprintf(self::URL_CHECKINS_REPLY, $checkinId), $this->query);
    }
}
