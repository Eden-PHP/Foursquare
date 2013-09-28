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
 * Four square page updates
 *
 * @package Eden
 * @category four square
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Pageupdates extends Base
{
    const URL_PAGEUPDATES_ADD = 'https://api.foursquare.com/v2/pageupdates/add';
    const URL_PAGEUPDATES_LIST = 'https://api.foursquare.com/v2/pageupdates/list';
    const URL_PAGEUPDATES_DELETE = 'https://api.foursquare.com/v2/pageupdates/%s/delete';
    const URL_PAGEUPDATES_LIKE = 'https://api.foursquare.com/v2/pageupdates/%s/like';
    
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
     * The page to associate the with broadcast.
     * 
     * @param string
     * @return Eden\Foursquare\Pageupdates
     */
    public function setPageId($pageId)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['pageId'] = $pageId;
        
        return $this;
    }
    
    /**
     * The venue group from which to broadcast an update.
     * 
     * @param string
     * @return Eden\Foursquare\Pageupdates
     */
    public function setGroupId($groupId)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['groupId'] = $groupId;
        
        return $this;
    }
    
    /**
     * Venue ID indicated which venues to broadcast from.
     * 
     * @param string
     * @return Eden\Foursquare\Pageupdates
     */
    public function setVenueId($venueId)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['venueId'] = $venueId;
        
        return $this;
    }
    
    /**
     * Text associated with the broadcast. 160 characters max.
     * 
     * @param string
     * @return Eden\Foursquare\Pageupdates
     */
    public function setShout($shout)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['shout'] = $shout;
        
        return $this;
    }
    
    /**
     * An optional special to attach to the broadcast.
     * 
     * @param string
     * @return Eden\Foursquare\Pageupdates
     */
    public function setCampaignId($campaignId)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['campaignId'] = $campaignId;
        
        return $this;
    }
    
    /**
     * An optional special to attach to the broadcast.
     * 
     * @param string
     * @return Eden\Foursquare\Pageupdates
     */
    public function setPhotoId($photoId)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['photoId'] = $photoId;
        
        return $this;
    }
    
    /**
     * Additional places to send the broadcast to. 
     * Accepts list of values: 
     * facebook - share on facebook
     * twitter  - share on twitter
     * private  - just create the update without broadcasting to anyone
     * 
     * @param string
     * @return Eden\Foursquare\Pageupdates
     */
    public function setBroadcast($broadcast)
    {
        //argument test
        Argument::i()->test(1, 'string');
        
        //if the input value is not allowed
        if (!in_array($broadcast, array('facebook', 'twitter', 'private'))) {
            //throw error
            Argument::i()
                ->setMessage(Argument::INVALID_PAGEUPDATES_BROADCAST)
                ->addVariable($broadcast)
                ->trigger();
        }
         
        $this->query['broadcast'] = $broadcast;
        
        return $this;
    }
    
    /**
     * Allows you to add the page's venues.
     *  
     * @return array
     */
    public function addPage()
    {
        return $this->post(self::URL_PAGEUPDATES_ADD, $this->query);
    }
    
    /**
     * Returns a list of page updates created by the current user.
     *  
     * @return array
     */
    public function getList()
    {
            
        return $this->getResponse(self::URL_PAGEUPDATES_LIST);
    }
    
    /**
     * Delete a page update created by the current user.
     *  
     * @param string The ID of the update to delete.
     * @return array
     */
    public function delete($pageId)
    {
        //argument test
        Argument::i()->test(1, 'string');
            
        return $this->getResponse(sprintf(self::URL_PAGEUPDATES_DELETE, $pageId));
    }
    
    /**
     * Causes the current user to 'like' a page update. 
     * If there is a campaign associated with the update, 
     * the like will propagate to the special as well.
     *  
     * @param string The ID of the update to like.
     * @return array
     */
    public function like($pageId)
    {
        //argument test
        Argument::i()->test(1, 'string');
            
        return $this->getResponse(sprintf(self::URL_PAGEUPDATES_LIKE, $pageId));
    }
}
