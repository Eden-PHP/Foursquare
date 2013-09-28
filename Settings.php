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
 * Four square setting
 *
 * @package Eden
 * @category four square
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Settings extends Base
{
    const URL_SETTINGS_LIST = 'https://api.foursquare.com/v2/settings/all';
    const URL_SETTINGS_CHANGE = 'https://api.foursquare.com/v2/settings/%s/set';
    
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
     * Returns the settings of the acting user.
     *  
     * @return Eden\Foursquare\Settings
     */
    public function getSettings()
    {
        return $this->getResponse(self::URL_SETTINGS_LIST);
    }
    
    /**
     * Change a setting for the given user.
     * 
     * @param string Name of setting to change, sendToTwitter,  
     * sendMayorshipsToTwitter, sendBadgesToTwitter, sendToFacebook, 
     * sendMayorshipsToFacebook, sendBadgesToFacebook, receivePings, receiveCommentPings.
     * @param integer 1 for true, and 0 for false.
     * @return array
     */
    public function changeSettings($settingId, $value)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a integer
            ->test(2, 'int');
        
        //if the input value is not allowed
        if (!in_array($settingId, array('sendToTwitter', 'sendMayorshipsToTwitter', 'sendBadgesToTwitter', 'sendToFacebook',
            'sendMayorshipsToFacebook', 'sendBadgesToFacebook', 'receivePings', 'receiveCommentPings'))) {
            //throw error
            Argument::i()
                ->setMessage(Argument::INVALID_SETTING)
                ->addVariable($settingId)
                ->trigger();
        }
        
        $this->query['value'] = $value;
        $this->query['SETTING_ID'] = $settingId;
        
        return $this->post(sprintf(self::URL_SETTINGS_CHANGE, $settingId), $this->query);
    }
}
