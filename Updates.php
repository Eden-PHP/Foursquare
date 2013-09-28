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
 * Four square updates detail
 *
 * @package Eden
 * @category four square
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Updates extends Base
{
    const URL_UPDATES_NOTIFICATION = 'https://api.foursquare.com/v2/updates/notifications';
    const URL_UPDATES_MARK_AS_READ = 'https://api.foursquare.com/v2/updates/marknotificationsread';
    
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
     * Maximum number of results to return, up to 99. 
     * Notifications are grouped over time, so there will 
     * usually be fewer than 99 results available at any given 
     * time. offset 0 Used to page through results. Only the 99 most 
     * recent notifications are visible, so offset must be no more 
     * than 99 - limit.
     * 
     * @param integer
     * @return Eden\Foursquare\Updates
     */
    public function setLimit($limit)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'int');
        $this->query['limit'] = $limit;
        
        return $this;
    }
    
    /**
     * Retrieve a user's notification tray notifications
     * 
     * @return array
     */
    public function getNotification()
    {
        return $this->getResponse(self::URL_UPDATES_NOTIFICATION, $this->query);
    }
    
    /**
     * Mark notification tray notifications as read up, to a certain timestamp.
     * 
     * @param string|integer|null The timestamp of the most recent notification that the user viewed.
     * @return array
     */
    public function markAsRead($highWatermark)
    {
        //argument 1 must be a string, integer or null
        Argument::i()->test(1, 'string', 'int', 'null');
        
        $this->query['highWatermark'] = strtotime($highWatermark);
        
        return $this->post(self::URL_UPDATES_MARK_AS_READ, $this->query);
    }
}
