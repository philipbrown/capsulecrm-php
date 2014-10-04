<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Address;
use PhilipBrown\CapsuleCRM\Contacts;
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

        $organisation->addContacts(
            new Contacts([
                'addresses' => [new Address([
                    'type' => 'Office',
                    'street' => '1600 Amphitheatre Parkway',
                    'city' => 'Mountain View',
                    'state' => 'CA',
                    'zip' => '94043',
                    'country' => 'United States'
                ])]
            ])
        );

        $stub = json_decode(file_get_contents(dirname(__FILE__).'/stubs/post/organisation.json'), true);
        $organisation = json_decode($organisation->toJson(), true);

        ksort($stub['organisation']);
        ksort($organisation['organisation']);

        $this->assertEquals(json_encode($stub), json_encode($organisation));
    }
}
