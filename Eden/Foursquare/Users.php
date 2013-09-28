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
 *  Four square users
 *
 * @package Eden
 * @category four square
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Users extends Base
{
    const URL_USERS = 'https://api.foursquare.com/v2/users/self';
    const URL_USERS_LEADERBOARD = 'https://api.foursquare.com/v2/users/leaderboard';
    const URL_USERS_PENDING = 'https://api.foursquare.com/v2/users/requests';
    const URL_USERS_SEARCH = 'https://api.foursquare.com/v2/users/search';
    const URL_USERS_BADGES = 'https://api.foursquare.com/v2/users/self/badges';
    const URL_USERS_CHECKINS = 'https://api.foursquare.com/v2/users/self/checkins';
    const URL_USERS_FRIENDS = 'https://api.foursquare.com/v2/users/self/friends';
    const URL_USERS_LIST = 'https://api.foursquare.com/v2/users/self/lists';
    const URL_USERS_MAYORSHIPS = 'https://api.foursquare.com/v2/users/self/mayorships';
    const URL_USERS_PHOTOS = 'https://api.foursquare.com/v2/users/self/photos';
    const URL_USERS_TIPS = 'https://api.foursquare.com/v2/users/self/tips';
    const URL_USERS_TODOS = 'https://api.foursquare.com/v2/users/self/todos';
    const URL_USERS_VENUE = 'https://api.foursquare.com/v2/users/self/venuehistory';
    
    const URL_USERS_UPDATE_PHOTO = 'https://api.foursquare.com/v2/users/self/update';
    const URL_USERS_UNFRIEND = 'https://api.foursquare.com/v2/users/self/unfriend';
    const URL_USERS_SETPINGS = 'https://api.foursquare.com/v2/users/self/setpings';
    const URL_USERS_SEND_REQUEST = 'https://api.foursquare.com/v2/users/self/request';
    const URL_USERS_DENY_REQUEST = 'https://api.foursquare.com/v2/users/self/deny';
    const URL_USERS_APPROVE_REQUEST = 'https://api.foursquare.com/v2/users/self/approve';
    
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
     * Set phone
     * 
     * @param string
     * @return Eden\Foursquare\Users
     */
    public function setPhone($phone)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['phone'] = $phone;
        
        return $this;
    }
    
    /**
     * Set email
     * 
     * @param string
     * @return Eden\Foursquare\Users
     */
    public function setEmail($email)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['email'] = $email;
        
        return $this;
    }
    
    /**
     * Set twitter account
     * 
     * @param string
     * @return Eden\Foursquare\Users
     */
    public function setTwitter($twitter)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['twitter'] = $twitter;
        
        return $this;
    }
    
    /**
     * Set twitter account id
     * 
     * @param string
     * @return Eden\Foursquare\Users
     */
    public function setTwitterSource($twitterSource)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['twitterSource'] = $twitterSource;
        
        return $this;
    }
    
    /**
     * Set facebook account
     * 
     * @param string
     * @return Eden\Foursquare\Users
     */
    public function setFacebookId($facebookId)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['fbid'] = $facebookId;
        
        return $this;
    }
    
    /**
     * Set name
     * 
     * @param string
     * @return Eden\Foursquare\Users
     */
    public function setName($name)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['name'] = $name;
        
        return $this;
    }
    
    /**
     * Set limits
     * 
     * @param integer
     * @return Eden\Foursquare\Users
     */
    public function setLimit($limit)
    {
        //argument test
        Argument::i()->test(1, 'int');
        $this->query['limit'] = $limit;
        
        return $this;
    }
    
    /**
     * Set to get a results after
     * timestamp
     * 
     * @return Eden\Foursquare\Users
     */
    public function setAfterTimeStamp()
    {
        $this->query['afterTimestamp'] = time();
        
        return $this;
    }
    
    /**
     * Set to get a results before
     * timestamp
     * 
     * @return Eden\Foursquare\Users
     */
    public function setBeforeTimeStamp()
    {
        $this->query['beforeTimestamp'] = time();
        
        return $this;
    }
    
    /**
     * Set offset for the results
     * timestamp
     * 
     * @param integer
     * @return Eden\Foursquare\Users
     */
    public function setOffset($offset)
    {
        //argument test
        Argument::i()->test(1, 'int');
        $this->query['offset'] = $offset;
        
        return $this;
    }
    
    /**
     * Set groups
     * 
     * @param string
     * @return Eden\Foursquare\Users
     */
    public function setGroup($group)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->query['group'] = $group;
        
        return $this;
    }

    /**
     * Set location by setting longtitide 
     * and latitude
     * 
     * @param int|float
     * @param int|float
     * @return Eden\Foursquare\Users
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
     * Returns users informations
     * 
     * @return array
     */
    public function getList()
    {
        
        return $this->getResponse(self::URL_USERS);
    }
    
    /**
     * Returns users leader board
     * 
     * @param string
     * @return array
     */
    public function getLeaderBoard()
    {
        return $this->getResponse(self::URL_USERS_LEADERBOARD);
    }
    
    /**
     * Returns users all pending request
     * 
     * @return array
     */
    public function getPendingRequest()
    {
        return $this->getResponse(self::URL_USERS_PENDING);
    }
    
    /**
     * Returns users search
     * 
     * @return array
     */
    public function search()
    {
        return $this->getResponse(self::URL_USERS_SEARCH, $this->query);
    }
    
    /**
     * Returns users badges
     * 
     * @return array
     */
    public function getBadget()
    {
        return $this->getResponse(self::URL_USERS_BADGES);
    }
    
    /**
     * Returns users checkins
     * 
     * @return array
     */
    public function getCheckins()
    {
        return $this->getResponse(self::URL_USERS_CHECKINS, $this->query);
    }
    
    /**
     * Returns users friends
     * 
     * @param string
     * @return array
     */
    public function getFriends()
    {
        return $this->getResponse(self::URL_USERS_FRIENDS, $this->query);
    }
    
    /**
     * Returns users list
     * 
     * @return array
     */
    public function getUsersList()
    {
        return $this->getResponse(self::URL_USERS_LIST, $this->query);
    }
    
    /**
     * Returns users mayor ships
     * 
     * @return array
     */
    public function getMayorships()
    {
        return $this->getResponse(self::URL_USERS_MAYORSHIPS);
    }
    
    /**
     * Returns users photos
     * 
     * @return array
     */
    public function getPhotos()
    {
        return $this->getResponse(self::URL_USERS_PHOTOS, $this->query);
    }
    
    /**
     * Returns users catagory history
     * 
     * @return array
     */
    public function getVenuehistory()
    {
        return $this->getResponse(self::URL_USERS_VENUE, $this->query);
    }
    
    /**
     * Updates the user's profile photo. 
     * 
     * @param string Photo under 100KB in multipart MIME encoding with content type image/jpeg, image/gif, or image/png.
     * @return array
     */
    public function updatePhoto($photo)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        $this->query['photo'] = $photo;
        
        return $this->post(self::URL_USERS_UPDATE_PHOTO, $this->query);
    }
    
    /**
     * Cancels any relationship between the 
     * acting user and the specified user. 
     * 
     * @param string Identity of the user to unfriend.
     * @return array
     */
    public function unFriend($userId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
            
        $this->query['USER_ID'] = $userId;
        
        return $this->post(self::URL_USERS_UNFRIEND, $this->query);
    }
    
    /**
     * Changes whether the acting user will receive pings
     * when the specified user checks in.
     * 
     * @param string The user ID of a friend.
     * @param boolean
     * @return array
     */
    public function setPings($userId, $value)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a boolean
            ->test(2, 'bool');
            
        $this->query['USER_ID'] = $userId;
        $this->query['value']       = $value;
        
        return $this->post(self::URL_USERS_SETPINGS, $this->query);
    }
    
    /**
     * Sends a friend request to another user.
     * 
     * @param string The user ID to which a request will be sent.
     * @return array
     */
    public function sendRequest($userId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->query['USER_ID'] = $userId;
        
        return $this->post(self::URL_USERS_SEND_REQUEST, $this->query);
    }
    
    /**
     * Denies a pending friend request from another user. 
     * 
     * @param string The user ID of a pending friend.
     * @return array
     */
    public function denyRequest($userId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        $this->query['USER_ID'] = $userId;
        
        return $this->post(self::URL_USERS_DENY_REQUEST, $this->query);
    }
    
    /**
     * Approves a pending friend request from another user. 
     * 
     * @param string The user ID of a pending friend.
     * @return array
     */
    public function approveRequest($userId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->query['USER_ID'] = $userId;
        
        return $this->post(self::URL_USERS_APPROVE_REQUEST, $this->query);
    }
}
