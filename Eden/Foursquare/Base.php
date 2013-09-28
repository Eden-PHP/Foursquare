<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Foursquare;

use Eden\Core\Base as CoreBase;
use Eden\Curl\Base as Curl;

/**
 * The base class for all classes wishing to integrate with Eden.
 * Extending this class will allow your methods to seemlessly be
 * overloaded and overrided as well as provide some basic class
 * loading patterns.
 *
 * @vendor Eden
 * @package Foursquare
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Base extends CoreBase
{
    const ACCESS_TOKEN = 'oauth_token';
    const KEY = 'key';
    const MAX_RESULTS = 'maxResults';
    const FORM_HEADER = 'application/x-www-form-urlencoded';
    const CONTENT_TYPE = 'Content-Type: application/json';
    const SELF = 'self';
    const VERIFY = 'v';
    protected $token = null;
    protected $maxResult = null;
    protected $headers = array(self::FORM_HEADER, self::CONTENT_TYPE);
    protected $query = array();
    protected $meta = array();
        
    /**
     * Returns the meta of the last call
     *
     * @return array
     */
    public function getMeta($key = null)
    {
        Argument::i()->test(1, 'string', 'null');
        
        if (isset($this->meta[$key])) {
            return $this->meta[$key];
        }
        
        return $this->meta;
    }
    
    /**
     * Set Maximum results of query
     *
     * @param int
     * @return array
     */
    public function setMaxResult($maxResult)
    {
        Argument::i()->test(1, 'int');
        $this->maxResult = $maxResult;
        
        return $this;
    }

    /**
     * Reset Variables
     *
     * @return array
     */
    protected function reset()
    {
        //foreach this as key => value
        foreach ($this as $key => $value) {
            //if the value of key is not array
            if (!is_array($this->$key)) {
                //if key name starts at underscore, probably it is protected variable
                if (preg_match('/^_/', $key)) {
                    //if the protected variable is not equal to token
                    //we dont want to unset the access token
                    if ($key != '_token') {
                        //reset all protected variables that currently use
                        $this->$key = null;
                    }
                }
            }
        }
        
        return $this;
    }
    
    /**
     * Access Keys
     *
     * @param array
     * @return array
     */
    protected function accessKey($array)
    {
        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $array[$key] = $this->accessKey($val);
            }
            
            if ($val == false || $val == null || empty($val)) {
                unset($array[$key]);
            }
        }
        
        return $array;
    }
    
    /**
     * Get Response
     *
     * @param array
     * @return array
     */
    protected function getResponse($url, array $query = array())
    {
        //add access token to query
        $query[self::ACCESS_TOKEN] = $this->token;
        //add current date for verification
        $query[self::VERIFY] = date('Ymd', time());
        //prevent sending fields with no value
        $query = $this->accessKey($query);
        //build url query
        $url .= '?'.http_build_query($query);
        //reset variables
        unset($this->query);
        //set curl
        $curl =  Curl::i()
            ->setUrl($url)
            ->verifyHost(false)
            ->verifyPeer(false)
            ->setTimeout(60);
            
        //get the response
        $response = $curl->getJsonResponse();
        
        $this->meta = $curl->getMeta();
        $this->meta['url'] = $url;
        $this->meta['query'] = $query;
        
        return $response;
    }
    
    /**
     * Post
     *
     * @param array
     * @return array
     */
    protected function post($url, array $query = array())
    {
        //add access token to query
        $url = $url.'?'.self::ACCESS_TOKEN.'='.$this->token;
        //prevent sending fields with no value
        $query = $this->accessKey($query);
        //add current date for verification
        $query[self::VERIFY] = date('Ymd', time());
        //build a to string query
        $query = http_build_query($query);
        //reset variables
        unset($this->query);

        //set curl
        $curl = Curl::i()
            ->verifyHost(false)
            ->verifyPeer(false)
            ->setUrl($url)
            ->setPostFields($query);
        
        //get the response
        $response = $curl->getJsonResponse();
        
        $this->meta = $curl->getMeta();
        $this->meta['url'] = $url;
        $this->meta['query'] = $query;
        
        return $response;
    }
}
