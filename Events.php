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
 * Four square events
 *
 * @package Eden
 * @category four square
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Events extends Base
{
    const URL_EVENTS_LIST = 'https://api.foursquare.com/v2/events/categories';
    
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
     * Returns a hierarchical list of categories applied to events. 
     *  
     * @return array
     */
    public function getList()
    {
        return $this->getResponse(self::URL_EVENTS_LIST);
    }

}
