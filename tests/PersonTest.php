<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Email;
use PhilipBrown\CapsuleCRM\Phone;
use PhilipBrown\CapsuleCRM\Person;
use PhilipBrown\CapsuleCRM\Address;
use PhilipBrown\CapsuleCRM\Website;
use PhilipBrown\CapsuleCRM\Contacts;

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

        $person->addContacts(
            new Contacts([
                'addresses' => [new Address([
                    'type' => 'Office',
                    'street' => '1600 Amphitheatre Parkway',
                    'city' => 'Mountain View',
                    'state' => 'CA',
                    'zip' => '94043',
                    'country' => 'United States'
                ])],
                'emails' => [new Email([
                    'type' => 'Home',
                    'email_address' => 'e.schmidt@google.com'
                ])],
                'phones' => [new Phone([
                    'type' => 'Mobile',
                    'phone_number' => '+1 888 555555'
                ])],
                'websites' => [new Website([
                    'type' => 'work',
                    'web_service' => 'URL',
                    'web_address' => 'www.google.com'
                ])]
            ])
        );

        $stub = json_decode(file_get_contents(dirname(__FILE__).'/stubs/post/person.json'), true);
        $person = json_decode($person->toJson(), true);

        ksort($stub['person']);
        ksort($person['person']);

        $this->assertEquals(json_encode($stub), json_encode($person));
    }
}

