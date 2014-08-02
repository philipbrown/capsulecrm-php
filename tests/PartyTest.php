<?php

use Mockery as m;

class PartyTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $this->connection = m::mock('PhilipBrown\CapsuleCRM\Connection');
    $this->party = new PhilipBrown\CapsuleCRM\Party($this->connection);
    $this->message = m::mock('Guzzle\Http\Message\Response');
  }

  /**
   * @expectedException Exception
   */
  public function testPartyRequiresConnection()
  {
    $p = new PhilipBrown\CapsuleCRM\Party('');
  }

  public function testFindPartyById()
  {
    $response = file_get_contents(dirname(__FILE__).'/stubs/party.json');
    $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
    $this->connection->shouldReceive('get')->andReturn($this->message);

    $party = $this->party->find(1);

    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Person', $party);
    $this->assertEquals('100', $party->id);
    $this->assertEquals('Eric', $party->first_name);
    $this->assertEquals('Schmidt', $party->last_name);
    $this->assertEquals('2011-09-14T15:22:01Z', $party->created_on);
    $this->assertEquals('2011-12-14T10:45:46Z', $party->updated_on);
  }

  public function testFindAllParties()
  {
    $response = file_get_contents(dirname(__FILE__).'/stubs/parties.json');
    $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
    $this->connection->shouldReceive('get')->andReturn($this->message);

    $collection = $this->party->all();

    $this->assertInstanceOf('Illuminate\Support\Collection', $collection);
    $this->assertTrue(count($collection) == 3);

    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Person', $collection[0]);
    $this->assertEquals('100', $collection[0]->id);
    $this->assertEquals('Eric', $collection[0]->first_name);
    $this->assertEquals('Schmidt', $collection[0]->last_name);
    $this->assertEquals('2011-09-14T15:22:01Z', $collection[0]->created_on);
    $this->assertEquals('2011-12-14T10:45:46Z', $collection[0]->updated_on);

    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Person', $collection[1]);
    $this->assertEquals('101', $collection[1]->id);
    $this->assertEquals('Larry', $collection[1]->first_name);
    $this->assertEquals('Page', $collection[1]->last_name);
    $this->assertEquals('2011-09-14T15:22:01Z', $collection[1]->created_on);
    $this->assertEquals('2011-11-15T10:50:48Z', $collection[1]->updated_on);

    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Organisation', $collection[2]);
    $this->assertEquals('50', $collection[2]->id);
    $this->assertEquals('Google Inc', $collection[2]->name);
    $this->assertEquals('2011-09-14T15:22:01Z', $collection[2]->created_on);
    $this->assertEquals('2011-12-14T10:45:46Z', $collection[2]->updated_on);
  }

}
