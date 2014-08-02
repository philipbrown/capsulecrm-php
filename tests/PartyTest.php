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

}
