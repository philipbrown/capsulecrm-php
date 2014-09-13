<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Person;

class PersonTest extends PHPUnit_Framework_TestCase
{
    /** @var Connection */
    private $connection;

    public function setUp()
    {
        $this->connection = m::mock('PhilipBrown\CapsuleCRM\Connection');
    }

    /** @test */
    public function should_serialize_model()
    {
        $person = new Person($this->connection, [
            'title' => 'Mr',
            'first_name' => 'Eric',
            'last_name' => 'Schmidt',
            'job_title' => 'Chairman',
            'organisation_name' => 'Google Inc',
            'about' => 'A comment here'
        ]);

        $stub = json_decode(file_get_contents(dirname(__FILE__).'/stubs/post/person.json'), true);
        unset($stub['person']['contacts']);

        $this->assertEquals(json_encode($stub), $person->toJson());
    }
}
