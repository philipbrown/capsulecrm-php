<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Kase;

class KaseTest extends PHPUnit_Framework_TestCase {

  /** @var PhilipBrown\CapsuleCRM\Connection */
  private $connection;

  /** @var PhilipBrown\CapsuleCRM\Kase */
  private $model;

  /** @var Guzzle\Http\Message\Response */
  private $message;

  public function setUp()
  {
    $this->connection = m::mock('PhilipBrown\CapsuleCRM\Connection');
    $this->model = new Kase($this->connection);
    $this->message = m::mock('Guzzle\Http\Message\Response');
  }

  /** @test */
  public function should_require_connection()
  {
    $this->setExpectedException('Exception');

    $m = new Kase('');
  }

  /** @test */
  public function find_case_by_id()
  {
    $response = file_get_contents(dirname(__FILE__).'/stubs/kase.json');
    $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
    $this->connection->shouldReceive('get')->andReturn($this->message);

    $case = $this->model->find(43);

    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Kase', $case);
    $this->assertEquals('43', $case->id);
    $this->assertEquals('OPEN', $case->status);
    $this->assertEquals('Consulting', $case->name);
    $this->assertEquals('Scope and design web site shopping cart', $case->description);
    $this->assertEquals('2', $case->party_id);
    $this->assertEquals('a.user', $case->owner);
    $this->assertEquals('2011-04-16T13:59:58Z', $case->created_on);
    $this->assertEquals('2011-05-11T16:54:23Z', $case->updated_on);
  }

  /** @test */
  public function find_all_cases()
  {
    $response = file_get_contents(dirname(__FILE__).'/stubs/kases.json');
    $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
    $this->connection->shouldReceive('get')->andReturn($this->message);

    $collection = $this->model->all();

    $this->assertInstanceOf('Illuminate\Support\Collection', $collection);
    $this->assertEquals(1, $collection->count());
    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Kase', $collection[0]);
  }

}
