<?php

use Mockery as m;

class QueryingTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $this->connection = m::mock('PhilipBrown\CapsuleCRM\Connection');
    $this->message = m::mock('Guzzle\Http\Message\Response');
    $this->model = new ModelStub($this->connection);
  }

  public function testTheSingularQueryableName()
  {
    $this->assertEquals('modelstub', $this->model->queryableOptions()->singular());
  }

  public function testThePluralQueryableName()
  {
    $this->assertEquals('the_plural_name', $this->model->queryableOptions()->plural());
  }

  public function testFindOneReturnsOneEntity()
  {
    $stub = file_get_contents(dirname(__FILE__).'/stubs/stub.json');
    $this->message->shouldReceive('json')->andReturn(json_decode($stub, true));
    $this->connection->shouldReceive('get')->andReturn($this->message);

    $response = $this->model->find(1);

    $this->assertTrue(isset($response['stub']));
  }

  public function testFindAllReturnsAllEntities()
  {
    $stub = file_get_contents(dirname(__FILE__).'/stubs/stubs.json');
    $this->message->shouldReceive('json')->andReturn(json_decode($stub, true));
    $this->connection->shouldReceive('get')->andReturn($this->message);

    $response = $this->model->all();

    $this->assertTrue(isset($response['stubs']));
  }

}


