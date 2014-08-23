<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Task;

class TaskTest extends PHPUnit_Framework_TestCase {

  /** @var PhilipBrown\CapsuleCRM\Connection */
  private $connection;

  /** @var PhilipBrown\CapsuleCRM\Task */
  private $model;

  /** @var Guzzle\Http\Message\Response */
  private $message;

  public function setUp()
  {
    $this->connection = m::mock('PhilipBrown\CapsuleCRM\Connection');
    $this->model = new Task($this->connection);
    $this->message = m::mock('Guzzle\Http\Message\Response');
  }

  /** @test */
  public function should_require_connection()
  {
    $this->setExpectedException('Exception');

    $m = new Task('');
  }

  /** @test */
  public function find_task_by_id()
  {
    $response = file_get_contents(dirname(__FILE__).'/stubs/task.json');
    $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
    $this->connection->shouldReceive('get')->andReturn($this->message);

    $task = $this->model->find(100);

    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Task', $task);
    $this->assertEquals('100', $task->id);
    $this->assertEquals('Meet with customer', $task->description);
    $this->assertEquals('Meeting at Coffee shop', $task->detail);
    $this->assertEquals('Meeting', $task->category);
    $this->assertEquals('2012-02-24T00:00:00Z', $task->due_date);
    $this->assertEquals('a.user', $task->owner);
    $this->assertEquals('1', $task->party_id);
    $this->assertEquals('Eric Jones', $task->party_name);
    $this->assertEquals('OPEN', $task->status);
  }

  /** @test */
  public function find_all_cases()
  {
    $response = file_get_contents(dirname(__FILE__).'/stubs/tasks.json');
    $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
    $this->connection->shouldReceive('get')->andReturn($this->message);

    $collection = $this->model->all();

    $this->assertInstanceOf('Illuminate\Support\Collection', $collection);
    $this->assertTrue(count($collection) == 1);
    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Task', $collection[0]);
  }

}
