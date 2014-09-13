<?php

use PhilipBrown\CapsuleCRM\Website;

class WebsiteTest extends PHPUnit_Framework_TestCase
{
    /** @var Website */
    private $website;

    public function setUp()
    {
        $this->website = new Website([
            'type' => 'Home',
            'web_service' => 'TWITTER',
            'web_address' => 'philipbrown'
        ]);
    }

    /** @test */
    public function should_create_new_website()
    {
        $this->assertEquals('Home', $this->website->type);
        $this->assertEquals('TWITTER', $this->website->web_service);
        $this->assertEquals('philipbrown', $this->website->web_address);
    }

    /** @test */
    public function should_serialize()
    {
        $this->assertTrue(is_object(json_decode($this->website->toJson())));
    }
}
