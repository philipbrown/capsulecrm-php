<?php

use PhilipBrown\CapsuleCRM\Address;

class AddressTest extends PHPUnit_Framework_TestCase
{
    /** @var Address */
    private $address;

    public function setUp()
    {
        $this->address = new Address([
            'type' => 'Office',
            'street' => '101 Blah Blah Lane',
            'city' => 'London',
            'zip' => 'E20 123',
            'country' => 'England'
        ]);
    }

    /** @test */
    public function should_create_new_address()
    {
        $this->assertEquals('Office', $this->address->type);
        $this->assertEquals('101 Blah Blah Lane', $this->address->street);
        $this->assertEquals('London', $this->address->city);
        $this->assertEquals('E20 123', $this->address->zip);
        $this->assertEquals('England', $this->address->country);
    }

    /** @test */
    public function should_serialize()
    {
        $this->assertTrue(is_object(json_decode($this->address->toJson())));
    }
}
