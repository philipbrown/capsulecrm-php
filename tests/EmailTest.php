<?php

use PhilipBrown\CapsuleCRM\Email;

class EmailTest extends PHPUnit_Framework_TestCase
{
    /** @var Email */
    private $email;

    public function setUp()
    {
        $this->email = new Email([
            'type' => 'Home',
            'email_address' => 'name@domain.com',
        ]);
    }

    /** @test */
    public function should_create_new_email()
    {
        $this->assertEquals('Home', $this->email->type);
        $this->assertEquals('name@domain.com', $this->email->email_address);
    }

    /** @test */
    public function should_serialize()
    {
        $this->assertTrue(is_object(json_decode($this->email->toJson())));
    }
}
