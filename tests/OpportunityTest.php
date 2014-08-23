<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Opportunity;

class OpportunityTest extends PHPUnit_Framework_TestCase {

  /** @var PhilipBrown\CapsuleCRM\Connection */
  private $connection;

  /** @var PhilipBrown\CapsuleCRM\Opportunity */
  private $opportunity;

  /** @var Guzzle\Http\Message\Response */
  private $message;

  public function setUp()
  {
    $this->connection = m::mock('PhilipBrown\CapsuleCRM\Connection');
    $this->opportunity = new Opportunity($this->connection);
    $this->message = m::mock('Guzzle\Http\Message\Response');
  }

  /** @test */
  public function should_require_connection()
  {
    $this->setExpectedException('Exception');

    $o = new Opportunity('');
  }

  /** @test */
  public function find_opportunity_by_id()
  {
    $response = file_get_contents(dirname(__FILE__).'/stubs/opportunity.json');
    $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
    $this->connection->shouldReceive('get')->andReturn($this->message);

    $opportunity = $this->opportunity->find(43);

    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Opportunity', $opportunity);
    $this->assertEquals('43', $opportunity->id);
    $this->assertEquals('Consulting', $opportunity->name);
    $this->assertEquals('Scope and design web site shopping cart', $opportunity->description);
    $this->assertEquals('2', $opportunity->party_id);
    $this->assertEquals('GBP', $opportunity->currency);
    $this->assertEquals('500.00', $opportunity->value);
    $this->assertEquals('DAY', $opportunity->duration_basis);
    $this->assertEquals('10', $opportunity->duration);
    $this->assertEquals('2012-09-30T00:00:00Z', $opportunity->expected_close_date);
    $this->assertEquals('2', $opportunity->milestone_id);
    $this->assertEquals('Bid', $opportunity->milestone);
    $this->assertEquals('50', $opportunity->probability);
    $this->assertEquals('a.user', $opportunity->owner);
    $this->assertEquals('2011-09-30T00:00:00Z', $opportunity->created_on);
    $this->assertEquals('2011-09-30T00:00:00Z', $opportunity->updated_on);
  }

  /** @test */
  public function find_all_opportunities()
  {
    $response = file_get_contents(dirname(__FILE__).'/stubs/opportunities.json');
    $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
    $this->connection->shouldReceive('get')->andReturn($this->message);

    $collection = $this->opportunity->all();

    $this->assertInstanceOf('Illuminate\Support\Collection', $collection);
    $this->assertTrue(count($collection) == 1);
  }

}
