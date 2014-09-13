<?php

use PhilipBrown\CapsuleCRM\Phone;

class PhoneTest extends PHPUnit_Framework_TestCase
{
    /** @var Phone */
    private $phone;

    public function setUp()
    {
        $this->phone = new Phone([
            'type' => 'Home',
            'phone_number' => '0191 123 456',
        ]);
    }

    /** @test */
    public function should_create_new_phone()
    {
        $this->assertEquals('Home', $this->phone->type);
        $this->assertEquals('0191 123 456', $this->phone->phone_number);
    }

    /** @test */
    public function should_serialize()
    {
        $this->assertTrue(is_object(json_decode($this->phone->toJson())));
    }
}
