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
 * Four square special
 *
 * @package Eden
 * @category four square
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Specials extends Base
{
    const URL_SPECIAL_ADD = 'https://api.foursquare.com/v2/specials/add';
    const URL_SPECIAL_GET = 'https://api.foursquare.com/v2/specials/list';
    const URL_SPECIAL_SEARCH = 'https://api.foursquare.com/v2/specials/search';
    const URL_SPECIAL_GET_DETAIL = 'https://api.foursquare.com/v2/specials/%s/configuration';
    const URL_SPECIAL_FLAG = 'https://api.foursquare.com/v2/specials/%s/flag';
    const URL_SPECIAL_RETIRE = 'https://api.foursquare.com/v2/specials/%s/retire';
    
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
     * Set venue Id
     * 
     * @param string
     * @return Eden\Foursquare\Specials
     */
    public function setVenueId($venueId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['venueId'] = $venueId;
        
        return $this;
    }
    
    /**
     * Set specials to return: pending, active, expired, all
     * 
     * @param string
     * @return Eden\Foursquare\Specials
     */
    public function setStatus($status)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        //if the input value is not allowed
        if (!in_array($status, array('pending', 'active', 'expired', 'all'))) {
            //throw error
            Argument::i()
                ->setMessage(Argument::INVALID_STATUS)
                ->addVariable($status)
                ->trigger();
        }
        
        $this->query['status'] = $status;
        
        return $this;
    }
    
    /**
     * A name for the special.
     * 
     * @param string
     * @return Eden\Foursquare\Specials
     */
    public function setName($name)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['name'] = $name;
        
        return $this;
    }
    
    /**
     * Additional text about why the user has flagged this special
     * 
     * @param string
     * @return Eden\Foursquare\Specials
     */
    public function setText($text)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['text'] = $text;
        
        return $this;
    }
    
    /**
     * Maximum length of 200 characters. Fine print, 
     * shown in small type on the special detail page.
     * 
     * @param string
     * @return Eden\Foursquare\Specials
     */
    public function setFinePrint($finePrint)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['finePrint'] = $finePrint;
        
        return $this;
    }
    
    /**
     * Count for frequency, count, regular, swarm, friends, and flash specials
     * 
     * @param integer
     * @return Eden\Foursquare\Specials
     */
    public function count1($count1)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'int');
        $this->query['count1'] = $count1;
        
        return $this;
    }
    
    /**
     * Secondary count for regular, flash specials
     * 
     * @param integer
     * @return Eden\Foursquare\Specials
     */
    public function count2($count2)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'int');
        $this->query['count2'] = $count2;
        
        return $this;
    }
    
    /**
     * Tertiary count for flash specials
     * 
     * @param integer
     * @return Eden\Foursquare\Specials
     */
    public function count3($count3)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'int');
        $this->query['count3'] = $count3;
        
        return $this;
    }
    
    /**
     * Maximum length of 16 characters.
     * Internal id in your 3rd party system.
     * 
     * @param integer 
     * @return Eden\Foursquare\Specials
     */
    public function setOfferId($offerId)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'int');
        $this->query['offerId'] = $offerId;
        
        return $this;
    }
    
    /**
     * The amount of money the user must spend to use this 
     * special in dollars and cents. For example, 5.50 meaning 5 dollars and 50 cents.
     * 
     * @param integer|float
     * @return Eden\Foursquare\Specials
     */
    public function setCost($cost)
    {
        //argument 1 must be a integer or float
        Argument::i()->test(1, 'int', 'float');
        $this->query['cost'] = $cost;
        
        return $this;
    }
    
    /**
     * The type of special to mayor
     * unlocked only for the mayor
     * 
     * @param string
     * @return Eden\Foursquare\Specials
     */
    public function setTypeToMayor()
    {
        $this->query['type'] = 'mayor';
        
        return $this;
    }
    
    /**
     * The type of special to frequency
     * unlocked every count1 check-ins
     * 
     * @param string
     * @return Eden\Foursquare\Specials
     */
    public function setTypeToFrequency()
    {
        $this->query['type'] = 'frequency';
        
        return $this;
    }
    
    /**
     * The type of special to count
     * unlocked on the count1th check-in (all-time)
     * 
     * @param string
     * @return Eden\Foursquare\Specials
     */
    public function setTypeToCount()
    {
        $this->query['type'] = 'count';
        
        return $this;
    }
    
    /**
     * The type of special to regular
     * unlocked if you have checked in at least count1 times in the last count2 days
     * 
     * @param string
     * @return Eden\Foursquare\Specials
     */
    public function setTypeToRegular()
    {
        $this->query['type'] = 'regular';
        
        return $this;
    }
    
    /**
     * The type of special to swarm
     * unlocked if there are count1 people here right now (but only for the first count1 people)
     * 
     * @param string
     * @return Eden\Foursquare\Specials
     */
    public function setTypeToSwarm()
    {
        $this->query['type'] = 'swarm';
        
        return $this;
    }
    
    /**
     * The type of special to swarm
     * unlocked if at least count1 friends check in together.
     * 
     * @param string
     * @return Eden\Foursquare\Specials
     */
    public function setTypeToFriends()
    {
        $this->query['type'] = 'friends';
        
        return $this;
    }
    
    /**
     * The type of special to flash
     * first-come first-serve; unlocked for the first count1 
     * people to check in between count2 and count3 (given in 
     * minutes since midnight, local time) each day. In all cases, 
     * the user must be at the venue (checked in within the last 3 hours, 
     * and not having checked in anywhere else since then) to unlock a special.
     * 
     * @param string
     * @return Eden\Foursquare\Specials
     */
    public function setTypeToFlash()
    {
        $this->query['type'] = 'flash';
        
        return $this;
    }
    
    /**
     * Allows you to create a new special.
     *  
     * @param string Maximum length of 200 characters.
     * @param string Maximum length of 200 characters. Special text that is shown when the user has unlocked the special.
     * @return array
     */
    public function createSpecial($text, $unlockedText)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');
        
        $this->query['text']            = $text;
        $this->query['unlockedText']    = $unlockedText;
        
        return $this->post(self::URL_SPECIAL_ADD, $this->query);
    }
    
    /**
     * List available specials.
     *  
     * @return array
     */
    public function getSpecial()
    {
        return $this->getResponse(self::URL_SPECIAL_GET, $this->query);
    }
     
    /**
     * Returns a list of specials near the current location. 
     *  
     * @param string|integer|float Longtitude
     * @param string|integer|float Latitude
     * @return array
     */
    public function search($longtitude, $latitude)
    {
        //argument test
        Argument::i()
            ->test(1, 'string', 'int', 'float')     //argument 1 must be a string, integer or float
            ->test(2, 'string', 'int', 'float');    //argument 2 must be a string, integer or float
        
        $this->query['ll'] = $longtitude.','.$latitude;
        
        return $this->getResponse(self::URL_SPECIAL_SEARCH, $this->query);
    }
    
    /**
     * Get special configuration details.
     *  
     * @param string The ID of the special to retrieve configuration details for.
     * @return array
     */
    public function getSpecialDetail($specialId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return $this->getResponse(sprintf(self::URL_SPECIAL_GET_DETAIL, $specialId));
    }
    
    /**
     * Allows users to indicate a Special is improper in some way. 
     *  
     * @param string The ID of the special being flagged
     * @param string The id of the venue running the special.
     * @param string One of not_redeemable, not_valuable, other
     * @return array
     */
    public function flag($specialId, $venueId, $problem)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string')
            //argument 3 must be a string
            ->test(3, 'string');
        
        //if the input value is not allowed
        if (!in_array($problem, array('not_redeemable', 'not_valuable', 'other'))) {
            //throw error
            Argument::i()
                ->setMessage(Argument::INVALID_PROBLEM_SPECIAL)
                ->addVariable($problem)
                ->trigger();
        }
        
        $this->query['venueId'] = $venueId;
        $this->query['problem'] = $problem;
        
        return $this->post(sprintf(self::URL_SPECIAL_FLAG, $specialId), $this->query);
    }
    
    /**
     * Retire a special. Retired specials will not show up in the list 
     * of specials and cannot be assigned to a group. Also ends any 
     * active campaigns associated with the special.
     *  
     * @param string The ID of the special to retire
     * @return array
     */
    public function retire($specialId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return $this->post(sprintf(self::URL_SPECIAL_RETIRE, $specialId));
    }
}
