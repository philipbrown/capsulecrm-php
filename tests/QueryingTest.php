<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Model;
use PhilipBrown\CapsuleCRM\Connection;
use PhilipBrown\CapsuleCRM\Querying\Findable;

class QueryingTest extends PHPUnit_Framework_TestCase {

  /** @var PhilipBrown\CapsuleCRM\Connection */
  private $connection;

  /** @var Guzzle\Http\Message\Response */
  private $message;

  /** @var PhilipBrown\CapsuleCRM\Model */
  private $model;

  public function setUp()
  {
    $this->connection = m::mock('PhilipBrown\CapsuleCRM\Connection');
    $this->message = m::mock('Guzzle\Http\Message\Response');
    $this->model = new QueryModelStub($this->connection);
  }

  /** @test */
  public function should_get_singular_queryable_name()
  {
    $this->assertEquals('querymodelstub', $this->model->queryableOptions()->singular());
  }

  /** @test */
  public function should_get_plural_queryable_name()
  {
    $this->assertEquals('the_plural_name', $this->model->queryableOptions()->plural());
  }

}

class QueryModelStub extends Model {

  use Findable;

  protected $queryableOptions = ['plural' => 'the_plural_name'];

  public function __construct(Connection $connection, $attributes = [])
  {
    $this->connection = $connection;

    $this->fill($attributes);
  }

}
