<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Foursquare;

use Eden\Oauth\Oauth2\Client as Client;

/**
 *  Google oauth
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Oauth extends Client
{
    const REQUEST_URL = 'https://foursquare.com/oauth2/authorize';
    const ACCESS_URL = 'https://foursquare.com/oauth2/access_token';

    /**
     * Construct - Setting Authentication
     * 
     * @param int
     * @return void
     */
    public function __construct($clientId, $clientSecret, $redirect)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string')
            //Argument 4 must be a string
            ->test(3, 'string');

        parent::__construct($clientId, $clientSecret, $redirect, self::REQUEST_URL, self::ACCESS_URL);
    }
}
