<?php //-->
/*
 * This file is part of the Mail package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

class Eden_Foursquare_Tests_Foursquare_FactoryTest extends \PHPUnit_Framework_TestCase
{
    protected $_clientId = 'PFSS1CBHP0K0Y4YUJL00ILSAMNRW2UUAREDJD2A3BCE1UOAL';
    protected $_clientSecret = 'JWQF3KW0QJ5DE5CHIP3CEAAFMOLRQ04VYH02N2NMT1PWJHUH';
    protected $_redirect = 'http://www.galleon.ph/login';
    protected $_token = '';

    public function testAuth()
    {
        $class = eden('foursquare')->auth($this->_clientId, $this->_clientSecret, $this->_redirect);

        print_r($class);
        $this->assertInstanceOf('Eden\\Foursquare\\Oauth', $class);
    }

    public function testCampaign()
    {
        $token = $this->_token;

        $class = eden('foursquare')->campaign($token);
        $this->assertInstanceOf('Eden\\Foursquare\\Campaign', $class);
    }
    
    // public function testCheckins()
    // {
    //     $this->assertInstanceOf('Eden\\Foursquare\\Checkins', $class);
    // }

    // public function testEvents()
    // {
    //     $this->assertInstanceOf('Eden\\Foursquare\\Events', $class);
    // }

    // public function testLists()
    // {
    //     $this->assertInstanceOf('Eden\\Foursquare\\Lists', $class);
    // }

    // public function testOauth()
    // {
    //     $this->assertInstanceOf('Eden\\Foursquare\\Oauth', $class);
    // }

    // public function testPages()
    // {
    //     $this->assertInstanceOf('Eden\\Foursquare\\Pages', $class);
    // }

    // public function testPageupdates()
    // {
    //     $this->assertInstanceOf('Eden\\Foursquare\\Pageupdates', $class);
    // }

    // public function testPhotos()
    // {
    //     $this->assertInstanceOf('Eden\\Foursquare\\Photos', $class);
    // }

    // public function testSettings()
    // {
    //     $this->assertInstanceOf('Eden\\Foursquare\\Settings', $class);
    // }

    // public function testSpecials()
    // {
    //     $this->assertInstanceOf('Eden\\Foursquare\\Specials', $class);
    // }

    // public function testTips()
    // {
    //     $this->assertInstanceOf('Eden\\Foursquare\\Tips', $class);
    // }

    // public function testUpdates()
    // {
    //     $this->assertInstanceOf('Eden\\Foursquare\\Updates', $class);
    // }

    // public function testUsers()
    // {
    //     $this->assertInstanceOf('Eden\\Foursquare\\Users', $class);
    // }

    // public function testVenue()
    // {
    //     $this->assertInstanceOf('Eden\\Foursquare\\Venue', $class);
    // }

    // public function testVenuegroups()
    // {
    //     $this->assertInstanceOf('Eden\\Foursquare\\Venuegroups', $class);
    // }
}
