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
 * Four square photos
 *
 * @package Eden
 * @category four square
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Photos extends Base
{
    const URL_PHOTOS_GET = 'https://api.foursquare.com/v2/photos/%s';
    
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
     * Get details of a photo.
     * 
     * @param string The ID of the photo to retrieve additional information for.
     * @return array
     */
    public function getDetail($photoId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        return $this->getResponse(sprintf(self::URL_PHOTOS_GET, $photoId));
    }
}
