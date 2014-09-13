<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Organisation;

class OrganisationTest extends PHPUnit_Framework_TestCase
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
        $organisation = new Organisation($this->connection, [
            'name' => 'Google Inc',
            'about' => 'A comment here'
        ]);

        $stub = json_decode(file_get_contents(dirname(__FILE__).'/stubs/post/organisation.json'), true);
        unset($stub['organisation']['contacts']);

        $this->assertEquals(json_encode($stub), $organisation->toJson());
    }
}
