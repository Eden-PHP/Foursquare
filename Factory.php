<?php //-->
/*
 * This file is part of the Foursquare package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Foursquare;

/**
 * foursquare API factory. This is a factory class with 
 * methods that will load up different google classes.
 * Foursquare classes are organized as described on their 
 * developer site: campaign, checkins, events, list, pages
 * pageupdates, photos, settings, tips, updates, users, venue 
 * and venuegroups.
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Factory extends Base
{
    const INSTANCE = 1;

    /**
     * Returns foursquare oauth
     *
     * @param *string
     * @param *string
     * @param *string
     * @return Oauth
     */

    public function auth($clientId, $clientSecret, $redirect)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string')
            //Argument 3 must be a string
            ->test(3, 'string');
        
        return Oauth::i($clientId, $clientSecret, $redirect);
    }
    
    /**
     * Returns foursquare campaign
     *
     * @param *string
     * @return Campaign
     */
    public function campaign($token)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return Campaign::i($token);
    }
    
    /**
     * Returns foursquare campaign
     *
     * @param *string
     * @return Checkins
     */
    public function checkins($token)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return Checkins::i($token);
    }
    
    /**
     * Returns foursquare events
     *
     * @param *string
     * @return Events
     */
    public function events($token)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return Events::i($token);
    }
    
    /**
     * Returns foursquare list
     *
     * @param *string
     * @return List
     */
    public function lists($token)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return Lists::i($token);
    }
    
    /**
     * Returns foursquare pages
     *
     * @param *string
     * @return Pages
     */
    public function pages($token)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return Pages::i($token);
    }
    
    /**
     * Returns foursquare pageUpdates
     *
     * @param *string
     * @return Pageupdates
     */
    public function pageUpdates($token)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return Pageupdates::i($token);
    }
    
    /**
     * Returns foursquare photos
     *
     * @param *string
     * @return Photos
     */
    public function photos($token)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return Photos::i($token);
    }
    
    /**
     * Returns foursquare settings
     *
     * @param *string
     * @return Settings
     */
    public function settings($token)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return Settings::i($token);
    }
    
    /**
     * Returns foursquare specials
     *
     * @param *string
     * @return Specials
     */
    public function specials($token)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return Specials::i($token);
    }
    
    /**
     * Returns foursquare tips
     *
     * @param *string
     * @return Tips
     */
    public function tips($token)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return Tips::i($token);
    }
    
    /**
     * Returns foursquare updates
     *
     * @param *string
     * @return Updates
     */
    public function updates($token)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return Updates::i($token);
    }
    
    /**
     * Returns foursquare users
     *
     * @param *string
     * @return Users
     */
    public function users($token)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return Users::i($token);
    }
    
    /**
     * Returns foursquare venue
     *
     * @param *string
     * @return Venue
     */
    public function venue($token)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return Venue::i($token);
    }
    
    /**
     * Returns foursquare venueGroups
     *
     * @param *string
     * @return Venuegroups
     */
    public function venueGroups($token)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return Venuegroups::i($token);
    }
}
